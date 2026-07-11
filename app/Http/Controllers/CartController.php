<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ShippingSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display Cart
     */
    public function index()
    {
        $cart = Cart::with([
            'items.product.images',
            'items.product.brand',
            'items.variant',
        ])->firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        // Recommended Products
        $recommendedProducts = Product::where('status', 1)
            ->where('stock', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        // Shipping Settings
        $shipping = ShippingSetting::first();

        // Cart Total
        $subtotal = $cart->total();

        // Shipping Charge
        $shippingCharge = 0;

        if ($shipping && $shipping->enabled) {

            if ($subtotal < $shipping->free_shipping_limit) {

                $shippingCharge = $shipping->shipping_charge;
            }
        }

        // Grand Total
        $grandTotal = $subtotal + $shippingCharge;

        return view('cart.index', compact(
            'cart',
            'recommendedProducts',
            'shipping',
            'subtotal',
            'shippingCharge',
            'grandTotal'
        ));
    }

    /**
     * Add Product To Cart
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_variant_id' => 'nullable|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $product = Product::findOrFail($request->product_id);

        $variant = null;

        $price = $product->sale_price ?: $product->price;

        if ($request->filled('product_variant_id')) {

            $variant = ProductVariant::findOrFail($request->product_variant_id);

            $price = $variant->sale_price ?: $variant->price;
        }

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->where('product_variant_id', $request->product_variant_id)
            ->first();

        if ($cartItem) {

            $cartItem->quantity += $request->quantity;
            $cartItem->price = $price;
            $cartItem->save();

        } else {

            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'product_variant_id' => $request->product_variant_id,
                'quantity' => $request->quantity,
                'price' => $price,
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Product added to cart successfully.');
    }

    /**
     * Update Cart Quantity
     */
    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return back()->with(
            'success',
            'Cart updated successfully.'
        );
    }

    /**
     * Remove Item From Cart
     */
    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();

        return back()->with(
            'success',
            'Item removed from cart.'
        );
    }

    /**
     * Clear Entire Cart
     */
    public function clear()
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        if ($cart) {
            $cart->items()->delete();
        }

        return back()->with(
            'success',
            'Cart cleared successfully.'
        );
    }
}