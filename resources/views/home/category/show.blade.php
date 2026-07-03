@extends('home.layouts.app')

@section('title', $category->name)

@section('content')

<div class="container py-5">

    <h2 class="mb-4">

        {{ $category->name }}

    </h2>

    <div class="row">

        @forelse($products as $product)

            <div class="col-lg-3 col-md-4 col-6 mb-4">

                <div class="card h-100 shadow-sm">

                    <a href="{{ route('product.show', $product->slug) }}">

                        @if($product->thumbnail)

                            <img
                                src="{{ asset('uploads/products/'.$product->thumbnail) }}"
                                class="card-img-top"
                                style="height:250px;object-fit:cover;">

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

                    No Products Found

                </div>

            </div>

        @endforelse

    </div>

    {{ $products->links() }}

</div>

@endsection