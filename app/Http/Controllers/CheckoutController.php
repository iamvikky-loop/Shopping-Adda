<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Address;
use App\Models\ShippingSetting;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $cartItems = $cart->items;

        $addresses = Address::where('user_id', Auth::id())
            ->latest()
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $shippingCharge = 0;

        $shipping = ShippingSetting::first();

        if ($shipping && $shipping->status) {

            if ($subtotal < $shipping->free_shipping_above) {

                $shippingCharge = $shipping->shipping_charge;

            }

        }

        $discount = 0;

        $total = $subtotal + $shippingCharge - $discount;

        return view('checkout.index', compact(
            'cart',
            'cartItems',
            'addresses',
            'subtotal',
            'shippingCharge',
            'discount',
            'total'
        ));
    }
}