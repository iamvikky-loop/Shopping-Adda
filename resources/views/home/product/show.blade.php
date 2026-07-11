@extends('home.layouts.app')

@section('title', $product->name)

@section('content')

<div class="container py-4">

    <div class="row">

        {{-- ========================= --}}
        {{-- LEFT SIDE IMAGES --}}
        {{-- ========================= --}}

        <div class="col-lg-6 mb-4">

            <div class="row">

                {{-- Thumbnail Images --}}

                <div class="col-2">

                    @if($product->thumbnail)

                        <img
                            src="{{ asset('uploads/products/'.$product->thumbnail) }}"
                            class="img-fluid border rounded mb-2 thumb-image active-thumb"
                            style="cursor:pointer"
                            onclick="changeImage(this)">

                    @endif

                    @foreach($product->images as $image)

                        <img
                            src="{{ asset('uploads/products/gallery/'.$image->image) }}"
                            class="img-fluid border rounded mb-2 thumb-image"
                            style="cursor:pointer"
                            onclick="changeImage(this)">

                    @endforeach

                </div>

                {{-- Main Image --}}

                <div class="col-10">

                    @if($product->thumbnail)

                        <img
                            id="main-image"
                            src="{{ asset('uploads/products/'.$product->thumbnail) }}"
                            class="img-fluid border rounded shadow-sm w-100">

                    @else

                        <img
                            id="main-image"
                            src="https://via.placeholder.com/700x700?text=No+Image"
                            class="img-fluid border rounded shadow-sm w-100">

                    @endif

                </div>

            </div>

        </div>

        {{-- ========================= --}}
        {{-- PRODUCT DETAILS --}}
        {{-- ========================= --}}

        <div class="col-lg-6">

            <small class="text-success fw-bold">

                {{ $product->brand->name ?? 'Shopping Adda' }}

            </small>

            <h2 class="fw-bold mt-2">

                {{ $product->name }}

            </h2>

            <div class="mb-3">

                @if($product->sale_price)

                    <h2 class="text-danger fw-bold">

                        ₹<span id="product-price">

                            {{ number_format($product->sale_price,2) }}

                        </span>

                    </h2>

                    <span class="text-muted">

                        <del>

                            ₹{{ number_format($product->price,2) }}

                        </del>

                    </span>

                @else

                    <h2 class="fw-bold">

                        ₹<span id="product-price">

                            {{ number_format($product->price,2) }}

                        </span>

                    </h2>

                @endif

            </div>

            <div class="mb-3">

                @if($product->stock > 0)

                    <span class="badge bg-success">

                        In Stock

                    </span>

                    <span class="ms-2 text-muted">

                        Available :

                        <span id="product-stock">

                            {{ $product->stock }}

                        </span>

                    </span>

                @else

                    <span class="badge bg-danger">

                        Out Of Stock

                    </span>

                @endif

            </div>

            <div class="mb-4">

                {!! nl2br(e($product->short_description)) !!}

            </div>

            <hr>

            <table class="table table-bordered">

                <tr>

                    <th width="180">

                        Category

                    </th>

                    <td>

                        {{ $product->category->name ?? '-' }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Sub Category

                    </th>

                    <td>

                        {{ $product->subCategory->name ?? '-' }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Brand

                    </th>

                    <td>

                        {{ $product->brand->name ?? '-' }}

                    </td>

                </tr>

                <tr>

                    <th>

                        SKU

                    </th>

                    <td>

                        {{ $product->sku }}

                    </td>

                </tr>

            </table>

            <hr>
                        {{-- ========================= --}}
            {{-- PRODUCT VARIANTS --}}
            {{-- ========================= --}}

            @if($product->variants->count())

                <h5 class="fw-bold mb-3">

                    Select Variant

                </h5>

                <div class="row mb-4">

                    @foreach($product->variants as $variant)

                        <div class="col-md-6 mb-3">

                            <div
                                class="card variant-card p-3 h-100"
                                style="cursor:pointer"
                                onclick="selectVariant(
                                    '{{ $variant->id }}',
                                    '{{ $variant->sale_price ?: $variant->price }}',
                                    '{{ $variant->stock }}',
                                    this
                                )">

                                <div class="fw-bold">

                                    SKU :
                                    {{ $variant->sku }}

                                </div>

                                <hr>

                                @foreach($variant->variantAttributes as $attribute)

                                    <span class="badge bg-primary me-1 mb-1">

                                        {{ $attribute->attribute->name }}

                                        :

                                        {{ $attribute->value->value }}

                                    </span>

                                @endforeach

                                <hr>

                                <div class="fw-bold text-danger">

                                    ₹{{ number_format($variant->sale_price ?: $variant->price,2) }}

                                </div>

                                <small class="text-muted">

                                    Stock :

                                    {{ $variant->stock }}

                                </small>

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

            {{-- ========================= --}}
            {{-- ADD TO CART FORM --}}
            {{-- ========================= --}}

            <form
                action="{{ route('cart.store') }}"
                method="POST">

                @csrf

                <input
                    type="hidden"
                    name="product_id"
                    value="{{ $product->id }}">

                <input
                    type="hidden"
                    id="product_variant_id"
                    name="product_variant_id">

                <div class="row align-items-center mb-4">

                    <div class="col-md-3">

                        <label class="form-label">

                            Quantity

                        </label>

                        <input
                            type="number"
                            name="quantity"
                            class="form-control"
                            min="1"
                            value="1">

                    </div>

                </div>

                <div class="d-grid gap-2">

                    <button
                        type="submit"
                        class="btn btn-warning btn-lg">

                        <i class="bi bi-cart-plus-fill"></i>

                        Add To Cart

                    </button>

                    <button
                        type="button"
                        class="btn btn-danger btn-lg">

                        <i class="bi bi-lightning-charge-fill"></i>

                        Buy Now

                    </button>

                    <button
                        type="button"
                        class="btn btn-outline-dark">

                        <i class="bi bi-heart"></i>

                        Add To Wishlist

                    </button>

                </div>

            </form>

            <hr class="my-4">

            <div class="row text-center">

                <div class="col-4">

                    <i class="bi bi-truck fs-3 text-primary"></i>

                    <div class="small mt-2">

                        Fast Delivery

                    </div>

                </div>

                <div class="col-4">

                    <i class="bi bi-shield-check fs-3 text-success"></i>

                    <div class="small mt-2">

                        Secure Payment

                    </div>

                </div>

                <div class="col-4">

                    <i class="bi bi-arrow-repeat fs-3 text-danger"></i>

                    <div class="small mt-2">

                        Easy Returns

                    </div>

                </div>

            </div>

        </div>

    </div>

    <hr class="my-5">
        {{-- ========================= --}}
    {{-- PRODUCT DESCRIPTION --}}
    {{-- ========================= --}}

    <div class="row">

        <div class="col-lg-8">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">

                    <h4 class="mb-0">

                        Product Description

                    </h4>

                </div>

                <div class="card-body">

                    {!! nl2br(e($product->description)) !!}

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        Specifications

                    </h5>

                </div>

                <div class="card-body p-0">

                    <table class="table table-striped mb-0">

                        <tr>

                            <th width="40%">

                                Brand

                            </th>

                            <td>

                                {{ $product->brand->name ?? '-' }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Category

                            </th>

                            <td>

                                {{ $product->category->name ?? '-' }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Sub Category

                            </th>

                            <td>

                                {{ $product->subCategory->name ?? '-' }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                SKU

                            </th>

                            <td>

                                {{ $product->sku }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Stock

                            </th>

                            <td>

                                {{ $product->stock }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Status

                            </th>

                            <td>

                                @if($product->stock > 0)

                                    <span class="badge bg-success">

                                        Available

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Out Of Stock

                                    </span>

                                @endif

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

    {{-- ========================= --}}
    {{-- RELATED PRODUCTS --}}
    {{-- ========================= --}}

    <h3 class="fw-bold mb-4">

        Related Products

    </h3>

    <div class="row">

        @forelse($relatedProducts as $item)

            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

                <div class="card h-100 shadow-sm border-0">

                    <a
                        href="{{ route('product.show',$item->slug) }}">

                        @if($item->thumbnail)

                            <img
                                src="{{ asset('uploads/products/'.$item->thumbnail) }}"
                                class="card-img-top"
                                style="height:250px;object-fit:cover;">

                        @else

                            <img
                                src="https://via.placeholder.com/400x400"
                                class="card-img-top">

                        @endif

                    </a>

                    <div class="card-body">

                        <h6 class="fw-bold">

                            {{ $item->name }}

                        </h6>

                        @if($item->sale_price)

                            <div>

                                <span class="text-danger fw-bold">

                                    ₹{{ number_format($item->sale_price,2) }}

                                </span>

                                <br>

                                <small>

                                    <del>

                                        ₹{{ number_format($item->price,2) }}

                                    </del>

                                </small>

                            </div>

                        @else

                            <span class="fw-bold">

                                ₹{{ number_format($item->price,2) }}

                            </span>

                        @endif

                    </div>

                    <div class="card-footer bg-white border-0">

                        <a
                            href="{{ route('product.show',$item->slug) }}"
                            class="btn btn-primary w-100">

                            View Product

                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-info text-center">

                    No Related Products Found.

                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection

@push('scripts')

<script>

function changeImage(image){

    document.getElementById('main-image').src = image.src;

    document.querySelectorAll('.thumb-image').forEach(function(img){
        img.classList.remove('border-primary');
    });

    image.classList.add('border-primary');

}

function selectVariant(id, price, stock, element){

    document.getElementById('product_variant_id').value = id;

    document.getElementById('product-price').innerHTML =
        parseFloat(price).toFixed(2);

    document.getElementById('product-stock').innerHTML = stock;

    document.querySelectorAll('.variant-card').forEach(function(card){
        card.classList.remove('border-primary');
        card.classList.remove('shadow');
    });

    element.classList.add('border-primary');
    element.classList.add('shadow');

}

</script>

@endpush