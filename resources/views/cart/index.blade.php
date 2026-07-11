@extends('home.layouts.app')

@section('title','Shopping Cart')

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="row">

    {{-- LEFT SIDE --}}
    <div class="col-lg-8">

        <h2 class="fw-bold mb-4">
            Shopping Cart
        </h2>

        @forelse($cart->items as $item)

        <div class="card border-0 shadow rounded-4 mb-4">

            <div class="card-body p-4">

                <div class="row align-items-center">

                    {{-- PRODUCT IMAGE --}}
                    <div class="col-md-3 text-center">

                        @if($item->product->thumbnail)

                        <img
                            src="{{ asset('uploads/products/'.$item->product->thumbnail) }}"
                            class="img-fluid rounded"
                            style="height:180px;object-fit:contain;">

                        @else

                        <img
                            src="https://via.placeholder.com/250"
                            class="img-fluid rounded">

                        @endif

                    </div>

                    {{-- PRODUCT DETAILS --}}
                    <div class="col-md-6">

                        <h3 class="fw-bold mb-2">

                            {{ $item->product->name }}

                        </h3>

                        <div class="text-success fw-semibold mb-2">

                            In Stock

                        </div>

                        @if($item->variant)

                        <div class="mb-2">

                            @foreach($item->variant->variantAttributes as $attribute)

                            <span class="badge bg-dark me-1">

                                {{ $attribute->attribute->name }}

                                :

                                {{ $attribute->value->value }}

                            </span>

                            @endforeach

                        </div>

                        @endif

                        <h3 class="text-danger fw-bold">

                            ₹{{ number_format($item->price,2) }}

                        </h3>

                    </div>

                    {{-- QUANTITY --}}
                    <div class="col-md-3">

                        <form
                            action="{{ route('cart.update',$item->id) }}"
                            method="POST">

                            @csrf

                            @method('PUT')

                            <label class="form-label">

                                Quantity

                            </label>

                            <input
                                type="number"
                                name="quantity"
                                value="{{ $item->quantity }}"
                                min="1"
                                class="form-control mb-2">

                            <button
                                class="btn btn-primary w-100">

                                Update

                            </button>

                        </form>

                        <form
                            action="{{ route('cart.destroy',$item->id) }}"
                            method="POST"
                            class="mt-2">

                            @csrf

                            @method('DELETE')

                            <button
                                class="btn btn-outline-danger w-100">

                                Remove

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        @empty

        <div class="card shadow border-0">

            <div class="card-body text-center p-5">

                <h3>Your Cart is Empty</h3>

                <a href="{{ url('/') }}"
                   class="btn btn-outline-secondary mt-3">

                    Continue Shopping

                </a>

            </div>

        </div>

        @endforelse

    </div>

    {{-- ORDER SUMMARY --}}
    <div class="col-lg-4">

        <div class="card shadow border-0 rounded-4 sticky-top"
             style="top:120px;">

            <div class="card-body">

                <h3 class="fw-bold mb-4">

                    Order Summary

                </h3>

                <div class="d-flex justify-content-between mb-3">

                    <span>Total Items</span>

                    <strong>

                        {{ $cart->totalItems() }}

                    </strong>

                </div>

                <div class="d-flex justify-content-between mb-3">

                    <span>Subtotal</span>

                    <strong>

                        ₹{{ number_format($subtotal,2) }}

                    </strong>

                </div>

                <div class="d-flex justify-content-between mb-3">

                    <span>Shipping</span>

                    @if($shippingCharge > 0)

                    <strong class="text-danger">

                        ₹{{ number_format($shippingCharge,2) }}

                    </strong>

                    @else

                    <strong class="text-success">

                        FREE

                    </strong>

                    @endif

                </div>

                @if($shipping && $shipping->enabled)

                    @if($shippingCharge > 0)

                    <div class="alert alert-warning py-2">

                        Add

                        <strong>

                            ₹{{ number_format($shipping->free_shipping_limit - $subtotal,2) }}

                        </strong>

                        more to get

                        <strong>FREE Shipping</strong>

                    </div>

                    @else

                    <div class="alert alert-success py-2">

                        🎉 Congratulations!

                        You unlocked

                        <strong>FREE SHIPPING</strong>

                    </div>

                    @endif

                @endif

                <hr>

                <div class="d-flex justify-content-between align-items-center">

                    <h4 class="fw-bold">

                        Grand Total

                    </h4>

                    <h3 class="text-danger fw-bold">

                        ₹{{ number_format($grandTotal,2) }}

                    </h3>

                </div>

                <button
                    class="btn btn-warning btn-lg w-100 mt-4 fw-bold">

                    Proceed To Checkout

                </button>

                <a href="{{ url('/') }}"
                   class="btn btn-outline-dark w-100 mt-3">

                    Continue Shopping

                </a>

            </div>

        </div>

    </div>

</div>

@endsection