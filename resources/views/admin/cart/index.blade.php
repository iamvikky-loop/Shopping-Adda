@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')

<div class="container py-4">

    <h2 class="mb-4">Shopping Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($cart->items->count())

        <div class="card">

            <div class="card-body">

                <table class="table table-bordered align-middle">

                    <thead>

                        <tr>

                            <th>Product</th>

                            <th>Variant</th>

                            <th width="120">Price</th>

                            <th width="170">Quantity</th>

                            <th width="120">Subtotal</th>

                            <th width="100">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($cart->items as $item)

                        <tr>

                            <td>

                                {{ $item->product->name }}

                            </td>

                            <td>

                                @if($item->variant)

                                    SKU: {{ $item->variant->sku }}

                                @else

                                    -

                                @endif

                            </td>

                            <td>

                                ₹{{ number_format($item->price,2) }}

                            </td>

                            <td>

                                <form action="{{ route('cart.update',$item->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('PUT')

                                    <div class="input-group">

                                        <input
                                            type="number"
                                            name="quantity"
                                            min="1"
                                            value="{{ $item->quantity }}"
                                            class="form-control">

                                        <button
                                            class="btn btn-primary">

                                            Update

                                        </button>

                                    </div>

                                </form>

                            </td>

                            <td>

                                ₹{{ number_format($item->subtotal(),2) }}

                            </td>

                            <td>

                                <form action="{{ route('cart.destroy',$item->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm">

                                        Remove

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

                <hr>

                <div class="d-flex justify-content-between">

                    <h4>

                        Total:

                        ₹{{ number_format($cart->total(),2) }}

                    </h4>

                    <form action="{{ route('cart.clear') }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-warning">

                            Clear Cart

                        </button>

                    </form>

                </div>

            </div>

        </div>

    @else

        <div class="alert alert-info">

            Your cart is empty.

        </div>

    @endif

</div>

@endsection