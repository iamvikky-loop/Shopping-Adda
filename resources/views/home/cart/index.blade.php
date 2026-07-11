@extends('home.layouts.app')

@section('title','Shopping Cart')

@section('content')

<div class="container py-5">

    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">

        {{-- LEFT SIDE --}}
        <div class="col-lg-9">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white">

                    <h3 class="fw-bold mb-0">
                        Shopping Cart
                    </h3>

                </div>

                <div class="card-body">

                    @if($cart->items->count())

                        @foreach($cart->items as $item)

                        <div class="row align-items-center py-4 border-bottom">

                            {{-- IMAGE --}}

                            <div class="col-md-2">

                                @if($item->product->thumbnail)

                                    <img
                                        src="{{ asset('uploads/products/'.$item->product->thumbnail) }}"
                                        class="img-fluid rounded">

                                @else

                                    <img
                                        src="https://via.placeholder.com/200x200"
                                        class="img-fluid rounded">

                                @endif

                            </div>

                            {{-- DETAILS --}}

                            <div class="col-md-5">

                                <h5 class="fw-bold">

                                    {{ $item->product->name }}

                                </h5>

                                <div class="text-success">

                                    In Stock

                                </div>

                                @if($item->variant)

                                    <small class="text-muted">

                                        Variant :

                                        {{ $item->variant->sku }}

                                    </small>

                                @endif

                            </div>

                            {{-- PRICE --}}

                            <div class="col-md-2 text-center">

                                <h5 class="fw-bold">

                                    ₹{{ number_format($item->price,2) }}

                                </h5>

                            </div>

                            {{-- QUANTITY --}}

                            <div class="col-md-2">

                                <form
                                    action="{{ route('cart.update',$item->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('PUT')

                                    <input
                                        type="number"
                                        class="form-control"
                                        name="quantity"
                                        min="1"
                                        value="{{ $item->quantity }}">

                                    <button
                                        class="btn btn-sm btn-primary mt-2 w-100">

                                        Update

                                    </button>

                                </form>

                            </div>

                            {{-- DELETE --}}

                            <div class="col-md-1">

                                <form
                                    action="{{ route('cart.destroy',$item->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </div>

                        @endforeach

                    @else

                        <div class="text-center py-5">

                            <h3>

                                Your Cart is Empty

                            </h3>

                            <a
                                href="{{ route('home') }}"
                                class="btn btn-warning mt-3">

                                Continue Shopping

                            </a>

                        </div>

                    @endif

                </div>

            </div>

        </div>

        {{-- RIGHT SIDE --}}

        <div class="col-lg-3">

            <div class="card shadow-sm border-0 sticky-top"
                 style="top:100px;">

                <div class="card-body">

                    <h5 class="fw-bold">

                        Order Summary

                    </h5>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>

                            Items

                        </span>

                        <strong>

                            {{ $cart->totalItems() }}

                        </strong>

                    </div>

                    <div class="d-flex justify-content-between mt-3">

                        <span>

                            Total

                        </span>

                        <strong class="fs-4 text-danger">

                            ₹{{ number_format($cart->total(),2) }}

                        </strong>

                    </div>

                    <hr>

                    <button
                        class="btn btn-warning w-100 btn-lg">

                        Proceed to Checkout

                    </button>

                    <form
                        action="{{ route('cart.clear') }}"
                        method="POST"
                        class="mt-3">

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-outline-danger w-100">

                            Clear Cart

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection