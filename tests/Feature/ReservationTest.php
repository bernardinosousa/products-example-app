<?php
use App\Models\Product;
use App\Models\User;

test('check non authenticated user can book product', function () {

    $response = $this->post(route('reservations.store'), [
        'product_id' => 1,
        'quantity' => 1,
    ]);

    $response->assertStatus(302);
});

test('check authenticated user can book product', function () {

    $user = User::factory()->create();

    $product = Product::factory()->create();

    $response = $this->actingAs($user)->post(route('reservations.store'), [
        'product_id' => $product->id,
        'quantity' => $product->quantity,
    ]);

    $response->assertRedirect(route('products.index'));
    $response->assertSessionHas('success');
});

test('check authenticated user cannot book excedding product quantity', function () {

    $user = User::factory()->create();

    $product = Product::factory()->create();

    $response = $this->actingAs($user)->post(route('reservations.store'), [
        'product_id' => $product->id,
        'quantity' => $product->quantity * 2,
    ]);

    $response->assertSessionHasErrors(['quantity']);
});