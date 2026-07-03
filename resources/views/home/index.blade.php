@extends('home.layouts.app')

@section('title', 'Shopping Adda')

@section('content')

<!-- ================= HERO SLIDER ================= -->

<div id="homeSlider"
     class="carousel slide mb-5"
     data-bs-ride="carousel">

    <div class="carousel-inner">

        <div class="carousel-item active">

            <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?w=1600"
                 class="d-block w-100"
                 style="height:500px;object-fit:cover;">

            <div class="carousel-caption text-start">

                <h1 class="display-4 fw-bold">
                    Summer Collection
                </h1>

                <p class="lead">
                    Flat 60% OFF on Fashion
                </p>

                <a href="#latest-products"
                   class="btn btn-primary btn-lg">

                    Shop Now

                </a>

            </div>

        </div>

        <div class="carousel-item">

            <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=1600"
                 class="d-block w-100"
                 style="height:500px;object-fit:cover;">

            <div class="carousel-caption text-start">

                <h1 class="display-4 fw-bold">
                    New Fashion Arrivals
                </h1>

                <p class="lead">
                    Starting from ₹499
                </p>

                <a href="#latest-products"
                   class="btn btn-warning btn-lg">

                    Explore

                </a>

            </div>

        </div>

        <div class="carousel-item">

            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=1600"
                 class="d-block w-100"
                 style="height:500px;object-fit:cover;">

            <div class="carousel-caption text-start">

                <h1 class="display-4 fw-bold">
                    Sports Collection
                </h1>

                <p class="lead">
                    Up to 40% OFF
                </p>

                <a href="#latest-products"
                   class="btn btn-success btn-lg">

                    Buy Now

                </a>

            </div>

        </div>

    </div>

    <button class="carousel-control-prev"
            type="button"
            data-bs-target="#homeSlider"
            data-bs-slide="prev">

        <span class="carousel-control-prev-icon"></span>

    </button>

    <button class="carousel-control-next"
            type="button"
            data-bs-target="#homeSlider"
            data-bs-slide="next">

        <span class="carousel-control-next-icon"></span>

    </button>

</div>

<!-- ================= FEATURED PRODUCTS ================= -->

<section class="mb-5">

    <h2 class="fw-bold mb-4">
        Featured Products
    </h2>

    <div class="row">

        @forelse($featuredProducts as $product)

            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                <div class="card border-0 shadow-sm h-100">

                    <a href="{{ route('product.show',$product->slug) }}">

                        @if($product->thumbnail)

                            <img src="{{ asset('uploads/products/'.$product->thumbnail) }}"
                                 class="card-img-top"
                                 style="height:250px;object-fit:cover;">

                        @else

                            <img src="https://via.placeholder.com/300x300?text=No+Image"
                                 class="card-img-top"
                                 style="height:250px;object-fit:cover;">

                        @endif

                    </a>

                    <div class="card-body d-flex flex-column">

                        <h6 class="fw-bold">

                            {{ $product->name }}

                        </h6>

                        <h5 class="text-primary">

                            ₹{{ number_format($product->sale_price ?: $product->price,2) }}

                        </h5>

                        <a href="{{ route('product.show',$product->slug) }}"
                           class="btn btn-outline-primary mt-auto">

                            View Product

                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-warning">

                    No Featured Products

                </div>

            </div>

        @endforelse

    </div>

</section>

<!-- ================= TRENDING PRODUCTS ================= -->

<section class="mb-5">

    <h2 class="fw-bold mb-4">
        Trending Products
    </h2>

    <div class="row">

        @forelse($trendingProducts as $product)

            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                <div class="card border-0 shadow-sm h-100">

                    <a href="{{ route('product.show',$product->slug) }}">

                        @if($product->thumbnail)

                            <img src="{{ asset('uploads/products/'.$product->thumbnail) }}"
                                 class="card-img-top"
                                 style="height:250px;object-fit:cover;">

                        @else

                            <img src="https://via.placeholder.com/300x300?text=No+Image"
                                 class="card-img-top"
                                 style="height:250px;object-fit:cover;">

                        @endif

                    </a>

                    <div class="card-body d-flex flex-column">

                        <h6 class="fw-bold">

                            {{ $product->name }}

                        </h6>

                        <h5 class="text-success">

                            ₹{{ number_format($product->sale_price ?: $product->price,2) }}

                        </h5>

                        <a href="{{ route('product.show',$product->slug) }}"
                           class="btn btn-outline-success mt-auto">

                            View Product

                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-warning">

                    No Trending Products

                </div>

            </div>

        @endforelse

    </div>

</section>

<!-- ================= LATEST PRODUCTS ================= -->

<section id="latest-products">

    <h2 class="fw-bold mb-4">
        Latest Products
    </h2>

    <div class="row">

        @forelse($latestProducts as $product)

            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                <div class="card border-0 shadow-sm h-100">

                    <a href="{{ route('product.show',$product->slug) }}">

                        @if($product->thumbnail)

                            <img src="{{ asset('uploads/products/'.$product->thumbnail) }}"
                                 class="card-img-top"
                                 style="height:250px;object-fit:cover;">

                        @else

                            <img src="https://via.placeholder.com/300x300?text=No+Image"
                                 class="card-img-top"
                                 style="height:250px;object-fit:cover;">

                        @endif

                    </a>

                    <div class="card-body d-flex flex-column">

                        <h6 class="fw-bold">

                            {{ $product->name }}

                        </h6>

                        <h5 class="text-danger">

                            ₹{{ number_format($product->sale_price ?: $product->price,2) }}

                        </h5>

                        <a href="{{ route('product.show',$product->slug) }}"
                           class="btn btn-dark mt-auto">

                            View Product

                        </a>

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

</section>

@endsection