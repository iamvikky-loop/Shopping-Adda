@extends('admin.layouts.app')

@section('title', 'Edit Product Variant')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header">
            <h4 class="mb-0">Edit Product Variant</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.product-variants.update',$productVariant->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Product
                        </label>

                        <select name="product_id" class="form-select">

                            @foreach($products as $product)

                                <option value="{{ $product->id }}"
                                    {{ $productVariant->product_id == $product->id ? 'selected' : '' }}>

                                    {{ $product->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Price
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="price"
                            value="{{ old('price',$productVariant->price) }}"
                            class="form-control">

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Sale Price
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="sale_price"
                            value="{{ old('sale_price',$productVariant->sale_price) }}"
                            class="form-control">

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Stock
                        </label>

                        <input
                            type="number"
                            name="stock"
                            value="{{ old('stock',$productVariant->stock) }}"
                            class="form-control">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status" class="form-select">

                            <option value="1"
                                {{ $productVariant->status ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ !$productVariant->status ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                </div>

                <hr>

                <h5 class="mb-3">
                    Variant Attributes
                </h5>

                <div class="row">

                    @foreach($attributes as $attribute)

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                {{ $attribute->name }}

                            </label>

                            <select
                                name="attribute_value[{{ $attribute->id }}]"
                                class="form-select">

                                <option value="">
                                    Select {{ $attribute->name }}
                                </option>

                                @foreach($attribute->values as $value)

                                    <option
                                        value="{{ $value->id }}"
                                        {{ isset($selectedValues[$attribute->id]) && $selectedValues[$attribute->id] == $value->id ? 'selected' : '' }}>

                                        {{ $value->value }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    @endforeach

                </div>

                <hr>

                {{-- Optional compatibility fields --}}

                <div class="row">

                    <div class="col-md-6">

                        <label class="form-label">
                            Color
                        </label>

                        <input
                            type="text"
                            name="color"
                            value="{{ old('color',$productVariant->color) }}"
                            class="form-control">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Size
                        </label>

                        <input
                            type="text"
                            name="size"
                            value="{{ old('size',$productVariant->size) }}"
                            class="form-control">

                    </div>

                </div>

                <div class="mt-4">

                    <button class="btn btn-success">

                        <i class="bi bi-check-circle"></i>

                        Update Variant

                    </button>

                    <a href="{{ route('admin.products.show',$productVariant->product_id) }}"
                       class="btn btn-secondary">

                        Back

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection