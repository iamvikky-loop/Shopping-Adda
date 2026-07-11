@extends('home.layouts.app')

@section('title','Checkout')

@section('content')

<div class="container py-5">

    <div class="row">

        <!-- LEFT SIDE -->

        <div class="col-lg-8">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">

                    <h4 class="mb-0 fw-bold">

                        Delivery Address

                    </h4>

                </div>

                <div class="card-body">

                    @if($addresses->count())

                        @foreach($addresses as $address)

                        <div class="form-check border rounded p-3 mb-3">

                            <input
                                class="form-check-input"
                                type="radio"
                                name="address_id"
                                value="{{ $address->id }}"
                                {{ $address->is_default ? 'checked' : '' }}>

                            <label class="form-check-label w-100">

                                <strong>

                                    {{ $address->full_name }}

                                </strong>

                                <br>

                                {{ $address->mobile }}

                                <br>

                                {{ $address->address_line1 }}

                                @if($address->address_line2)

                                    {{ $address->address_line2 }},

                                @endif

                                {{ $address->city }},

                                {{ $address->state }},

                                {{ $address->country }}

                                -

                                {{ $address->postal_code }}

                            </label>

                        </div>

                        @endforeach

                    @else

                        <div class="alert alert-warning">

                            No Address Found.

                            <br><br>

                            <a
                                href="{{ route('addresses.create') }}"
                                class="btn btn-primary">

                                Add Address

                            </a>

                        </div>

                    @endif

                </div>

            </div>
            {{-- Cart Items --}}

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white">

        <h4 class="fw-bold mb-0">

            Order Items

        </h4>

    </div>

    <div class="card-body">

        @foreach($cartItems as $item)

        <div class="row align-items-center mb-4">

            <div class="col-md-2">

                @php
                    $image = $item->product->thumbnail ?? ($item->product->image ?? 'images/no-image.png');
                @endphp

                <img src="{{ asset($image) }}"
                     class="img-fluid rounded">

            </div>

            <div class="col-md-6">

                <h6 class="fw-bold">

                    {{ $item->product->name }}

                </h6>

                <small class="text-muted">

                    Quantity :
                    {{ $item->quantity }}

                </small>

            </div>

            <div class="col-md-4 text-end">

                <h5>

                    ₹{{ number_format($item->price * $item->quantity,2) }}

                </h5>

            </div>

        </div>

        <hr>

        @endforeach

    </div>

</div>





{{-- Coupon Card --}}

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white">

        <h4 class="fw-bold mb-0">

            Apply Coupon

        </h4>

    </div>

    <div class="card-body">

        <div class="input-group">

            <input
                type="text"
                class="form-control"
                placeholder="Enter Coupon Code">

            <button
                class="btn btn-primary">

                Apply

            </button>

        </div>

    </div>

</div>





{{-- Payment Method --}}

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h4 class="fw-bold mb-0">

            Payment Method

        </h4>

    </div>

    <div class="card-body">

        <div class="form-check mb-3">

            <input
                class="form-check-input"
                type="radio"
                checked
                name="payment_method"
                value="COD">

            <label class="form-check-label">

                Cash On Delivery

            </label>

        </div>

        <div class="form-check mb-3">

            <input
                class="form-check-input"
                type="radio"
                name="payment_method"
                value="RAZORPAY">

            <label class="form-check-label">

                Razorpay

            </label>

        </div>

        <div class="form-check">

            <input
                class="form-check-input"
                type="radio"
                name="payment_method"
                value="UPI">

            <label class="form-check-label">

                UPI

            </label>

        </div>

    </div>

</div>

</div>
<!-- RIGHT SIDE -->

<div class="col-lg-4">

    <div class="card shadow border-0 sticky-top" style="top:20px;">

        <div class="card-header bg-dark text-white">

            <h4 class="mb-0">

                Order Summary

            </h4>

        </div>

        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">

                <span>Subtotal</span>

                <strong>

                    ₹{{ number_format($subtotal,2) }}

                </strong>

            </div>

            <div class="d-flex justify-content-between mb-3">

                <span>Shipping</span>

                <strong>

                    ₹{{ number_format($shippingCharge,2) }}

                </strong>

            </div>

            <div class="d-flex justify-content-between mb-3">

                <span>Discount</span>

                <strong class="text-success">

                    - ₹{{ number_format($discount,2) }}

                </strong>

            </div>

            <hr>

            <div class="d-flex justify-content-between mb-4">

                <h5>

                    Grand Total

                </h5>

                <h4 class="text-primary">

                    ₹{{ number_format($total,2) }}

                </h4>

            </div>

            <button
                class="btn btn-success w-100 btn-lg">

                <i class="bi bi-bag-check-fill"></i>

                Place Order

            </button>

            <div class="text-center mt-3">

                <small class="text-muted">

                    Secure Checkout

                </small>

            </div>

        </div>

    </div>

</div>

</div>

</div>

@endsection