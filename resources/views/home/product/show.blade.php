@extends('home.layouts.app')

@section('title', $product->name)

@section('content')

<div class="container py-5">

    <div class="row">

        <!-- Product Images -->
        <div class="col-lg-6">

            <div class="row">

                <!-- Thumbnails -->
                <div class="col-2">

                    @if($product->thumbnail)
                        <img
                            src="{{ asset('uploads/products/'.$product->thumbnail) }}"
                            class="img-fluid border rounded mb-2 thumb-image active-thumb"
                            onclick="changeImage(this)"
                            style="cursor:pointer">
                    @endif

                    @foreach($product->images as $image)
                        <img
                            src="{{ asset('uploads/products/gallery/'.$image->image) }}"
                            class="img-fluid border rounded mb-2 thumb-image"
                            onclick="changeImage(this)"
                            style="cursor:pointer">
                    @endforeach

                </div>

                <!-- Main Image -->
                <div class="col-10">

                    @if($product->thumbnail)

                        <img
                            id="main-image"
                            src="{{ asset('uploads/products/'.$product->thumbnail) }}"
                            class="img-fluid rounded border shadow-sm w-100">

                    @else

                        <img
                            id="main-image"
                            src="https://via.placeholder.com/600x600"
                            class="img-fluid rounded border shadow-sm w-100">

                    @endif

                </div>

            </div>

        </div>

        <!-- Product Details -->
        <div class="col-lg-6">

            <h2 class="fw-bold mb-3">
                {{ $product->name }}
            </h2>

            <div class="mb-3">

                @if($product->sale_price)

                    <h3 class="text-danger">

                        ₹<span id="product-price">
                            {{ number_format($product->sale_price,2) }}
                        </span>

                    </h3>

                    <del class="text-muted">

                        ₹{{ number_format($product->price,2) }}

                    </del>

                @else

                    <h3>

                        ₹<span id="product-price">
                            {{ number_format($product->price,2) }}
                        </span>

                    </h3>

                @endif

            </div>

            <div class="mb-3">

                @if($product->stock > 0)

                    <span class="badge bg-success">

                        In Stock
                        (<span id="product-stock">{{ $product->stock }}</span>)

                    </span>

                @else

                    <span class="badge bg-danger">

                        Out Of Stock

                    </span>

                @endif

            </div>

            <p class="text-muted">

                {{ $product->short_description }}

            </p>

            @if($product->variants->count())

                <hr>

                <h5>Select Variant</h5>

                <div class="row">

                    @foreach($product->variants as $variant)

                        <div class="col-md-6 mb-3">

                            <div
                                class="card variant-card h-100 p-3"
                                style="cursor:pointer"
                                onclick="selectVariant(
                                    '{{ $variant->id }}',
                                    '{{ $variant->sale_price ?: $variant->price }}',
                                    '{{ $variant->stock }}'
                                )">

                                <strong>SKU:</strong>

                                {{ $variant->sku }}

                                <hr>

                                @foreach($variant->variantAttributes as $attribute)

                                    <span class="badge bg-primary me-1">

                                        {{ $attribute->attribute->name }}

                                        :

                                        {{ $attribute->value->value }}

                                    </span>

                                @endforeach

                                <hr>

                                <strong>

                                    ₹{{ number_format($variant->sale_price ?: $variant->price,2) }}

                                </strong>

                                <br>

                                <small>

                                    Stock :

                                    {{ $variant->stock }}

                                </small>

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

            <hr>
                        <h5>Description</h5>

            <div class="mb-4">
                {!! nl2br(e($product->description)) !!}
            </div>

            <form action="{{ route('cart.store') }}" method="POST">

                @csrf

                <input
                    type="hidden"
                    name="product_id"
                    value="{{ $product->id }}">

                <input
                    type="hidden"
                    id="variant_id"
                    name="variant_id">

                <div class="row">

                    <div class="col-md-3">

                        <input
                            type="number"
                            name="quantity"
                            value="1"
                            min="1"
                            class="form-control">

                    </div>

                    <div class="col-md-9">

                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            <i class="bi bi-cart-plus"></i>

                            Add To Cart

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <hr class="my-5">

    <h3 class="mb-4">
        Related Products
    </h3>

    <div class="row">

        @forelse($relatedProducts as $item)

            <div class="col-lg-3 col-md-4 col-6 mb-4">

                <div class="card h-100 shadow-sm">

                    <a href="{{ route('product.show',$item->slug) }}">

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

                            <div class="fw-bold">

                                ₹{{ number_format($item->price,2) }}

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-secondary">

                    No related products found.

                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection

@push('scripts')
<script>

function changeImage(element)
{
    document.getElementById('main-image').src = element.src;

    document.querySelectorAll('.thumb-image').forEach(function(img){
        img.classList.remove('active-thumb');
    });

    element.classList.add('active-thumb');
}

function selectVariant(id, price, stock)
{
    document.getElementById('variant_id').value = id;

    document.getElementById('product-price').innerHTML =
        Number(price).toFixed(2);

    document.getElementById('product-stock').innerHTML = stock;

    document.querySelectorAll('.variant-card').forEach(function(card){
        card.classList.remove('border-primary');
        card.classList.remove('shadow');
    });

    event.currentTarget.classList.add('border-primary');
    event.currentTarget.classList.add('shadow');
}

</script>
@endpush