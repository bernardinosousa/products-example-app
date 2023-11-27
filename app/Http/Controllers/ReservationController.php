<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStoreRequest;
use App\Mail\NewReservationAdministrator;
use App\Mail\NewReservationUser;
use App\Models\Product;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function index()
    {
        //TODO
    }

    public function store(ReservationStoreRequest $request)
    {
        $user = auth()->user();

        $product = Product::findOrFail($request->product_id);

        $reservation = Reservation::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);

        $product->quantity = $product->quantity - $request->quantity;
        $product->save();

        $reservation = Reservation::with(['product', 'user'])->find($reservation->id);

        Mail::to($user->email)->send(new NewReservationUser($reservation));

        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new NewReservationAdministrator($reservation));

        $productName = $reservation->product->name;

        return redirect()->route('products.index')->with("success", "Booked $productName with success!");
    }
}
