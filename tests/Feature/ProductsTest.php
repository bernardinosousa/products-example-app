<?php

use App\Models\Product;
use App\Models\User;

test('check products page returns ok', function () {
    $response = $this->get(route('homepage'));

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/products');

    $response->assertStatus(200);
});

test('check product page returns ok', function () {
    $product = Product::factory()->create();

    $response = $this->get(route('products.show', ['product' => $product->id]));

    $response->assertStatus(200);
});

test('check product page returns not found', function () {
    $product = Product::factory()->create();

    $response = $this->get(route('products.show', ['product' => 9999]));

    $response->assertStatus(404);
});
