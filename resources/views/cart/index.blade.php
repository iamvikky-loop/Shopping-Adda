@extends('home.layouts.app')

@section('title','Shopping Cart')

@section('content')

<div class="container py-5">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
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

                        <div class="col-md-3 text-center">

                            @if($item->product && $item->product->thumbnail)

                                <img src="{{ asset('uploads/products/'.$item->product->thumbnail) }}"
                                     class="img-fluid rounded"
                                     style="height:180px;object-fit:contain;">

                            @else

                                <img src="https://via.placeholder.com/250"
                                     class="img-fluid rounded">

                            @endif

                        </div>

                        <div class="col-md-6">

                            <h4 class="fw-bold">

                                {{ $item->product->name }}

                            </h4>

                            <p class="text-success fw-bold">
                                In Stock
                            </p>

                            @if($item->variant)

                                @foreach($item->variant->variantAttributes as $attribute)

                                    <span class="badge bg-dark me-1">

                                        {{ $attribute->attribute->name }}

                                        :

                                        {{ $attribute->value->value }}

                                    </span>

                                @endforeach

                            @endif

                            <h4 class="text-danger mt-3">

                                ₹{{ number_format($item->price,2) }}

                            </h4>

                        </div>

                        <div class="col-md-3">

                            <form action="{{ route('cart.update',$item->id) }}"
                                  method="POST">

                                @csrf
                                @method('PUT')

                                <label class="form-label">

                                    Quantity

                                </label>

                                <input type="number"
                                       name="quantity"
                                       value="{{ $item->quantity }}"
                                       min="1"
                                       class="form-control mb-2">

                                <button class="btn btn-primary w-100">

                                    Update

                                </button>

                            </form>

                            <form action="{{ route('cart.destroy',$item->id) }}"
                                  method="POST"
                                  class="mt-2">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-outline-danger w-100">

                                    Remove

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

            @empty

                <div class="card shadow">

                    <div class="card-body text-center py-5">

                        <h3>Your Cart is Empty</h3>

                        <a href="{{ url('/') }}"
                           class="btn btn-primary mt-3">

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

                        @if($shippingCharge>0)

                            <strong class="text-danger">

                                ₹{{ number_format($shippingCharge,2) }}

                            </strong>

                        @else

                            <strong class="text-success">

                                FREE

                            </strong>

                        @endif

                    </div>

                    @if(isset($shipping) && $shipping && $shipping->status)

                        @if($shippingCharge>0)

                            <div class="alert alert-warning">

                                Add

                                <strong>

                                    ₹{{ number_format($shipping->free_shipping_above-$subtotal,2) }}

                                </strong>

                                more for FREE Shipping

                            </div>

                        @else

                            <div class="alert alert-success">

                                🎉 You unlocked FREE Shipping

                            </div>

                        @endif

                    @endif

                    <hr>

                    <div class="d-flex justify-content-between">

                        <h4 class="fw-bold">

                            Grand Total

                        </h4>

                        <h3 class="text-danger">

                            ₹{{ number_format($grandTotal,2) }}

                        </h3>

                    </div>

                    <a href="{{ route('checkout.index') }}"
                       class="btn btn-warning btn-lg w-100 mt-4 fw-bold">

                        Proceed To Checkout

                    </a>

                    <a href="{{ url('/') }}"
                       class="btn btn-outline-dark w-100 mt-3">

                        Continue Shopping

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection