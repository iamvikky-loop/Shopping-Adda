@extends('home.layouts.app')

@section('title','Search')

@section('content')

<div class="container py-5">

    <form action="{{ route('search') }}" method="GET">

        <div class="input-group mb-5">

            <input
                type="text"
                class="form-control"
                name="q"
                placeholder="Search products..."
                value="{{ request('q') }}">

            <button class="btn btn-primary">

                Search

            </button>

        </div>

    </form>

    @if(request('q'))

        <h4 class="mb-4">

            Search Result for :

            <span class="text-primary">

                "{{ request('q') }}"

            </span>

        </h4>

    @endif

    <div class="row">

        @forelse($products as $product)

            <div class="col-lg-3 col-md-4 col-6 mb-4">

                <div class="card h-100 shadow-sm">

                    <a href="{{ route('product.show',$product->slug) }}">

                        @if($product->thumbnail)

                            <img
                                src="{{ asset('uploads/products/'.$product->thumbnail) }}"
                                class="card-img-top"
                                style="height:240px;object-fit:cover;">

                        @else

                            <img
                                src="https://via.placeholder.com/400x400"
                                class="card-img-top">

                        @endif

                    </a>

                    <div class="card-body">

                        <h6>

                            {{ $product->name }}

                        </h6>

                        @if($product->sale_price)

                            <span class="text-danger fw-bold">

                                ₹{{ number_format($product->sale_price,2) }}

                            </span>

                            <br>

                            <small>

                                <del>

                                    ₹{{ number_format($product->price,2) }}

                                </del>

                            </small>

                        @else

                            <span class="fw-bold">

                                ₹{{ number_format($product->price,2) }}

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-warning">

                    No Products Found.

                </div>

            </div>

        @endforelse

    </div>

    <div class="mt-4">

        {{ $products->withQueryString()->links() }}

    </div>

</div>

@endsection