@extends('admin.layouts.app')

@section('title', 'Add Product Variant')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header">
            <h4 class="mb-0">Add Product Variant</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.product-variants.store') }}" method="POST">

                @csrf

                <div class="row">

                    {{-- Product --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Product</label>

                        <select name="product_id"
                                class="form-select @error('product_id') is-invalid @enderror">

                            <option value="">Select Product</option>

                            @foreach($products as $product)

                                <option value="{{ $product->id }}"
                                    {{ old('product_id',$selectedProduct) == $product->id ? 'selected' : '' }}>

                                    {{ $product->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('product_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    {{-- Price --}}
                    <div class="col-md-3 mb-3">

                        <label class="form-label">Price</label>

                        <input type="number"
                               step="0.01"
                               name="price"
                               value="{{ old('price') }}"
                               class="form-control @error('price') is-invalid @enderror">

                        @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    {{-- Sale Price --}}
                    <div class="col-md-3 mb-3">

                        <label class="form-label">Sale Price</label>

                        <input type="number"
                               step="0.01"
                               name="sale_price"
                               value="{{ old('sale_price') }}"
                               class="form-control">

                    </div>

                </div>

                <div class="row">

                    {{-- Stock --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">Stock</label>

                        <input type="number"
                               name="stock"
                               value="{{ old('stock',0) }}"
                               class="form-control">

                    </div>

                    {{-- Status --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">Status</label>

                        <select name="status" class="form-select">

                            <option value="1">Active</option>

                            <option value="0">Inactive</option>

                        </select>

                    </div>

                </div>

                <hr>

               <h5 class="mb-3">
                    Select Variant Attributes
                </h5>       

                <div class="row">

                    @foreach($attributes as $attribute)

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                {{ $attribute->name }}

                            </label>

                            <select
                                name="attributes[{{ $attribute->id }}]"
                                class="form-select">

                                <option value="">
                                    Select {{ $attribute->name }}
                                </option>

                                @foreach($attribute->values as $value)

                                    <option value="{{ $value->id }}">

                                        {{ $value->value }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    @endforeach

                </div>

                <hr>

                {{-- Optional compatibility fields --}}
                
                <div class="mt-4">

                    <button class="btn btn-primary">

                        <i class="bi bi-check-circle"></i>

                        Save Variant

                    </button>

                    <a href="{{ route('admin.products.index') }}"
                       class="btn btn-secondary">

                        Back

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection