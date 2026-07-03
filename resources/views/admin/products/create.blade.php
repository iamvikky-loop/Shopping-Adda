@extends('admin.layouts.app')

@section('title','Add Product')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>Add Product</h3>

        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            Back
        </a>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <form action="{{ route('admin.products.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row">

                    {{-- Category --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">Category</label>

                        <select name="category_id" id="category" class="form-select" required>

                            <option value="">Select Category</option>

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}">

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- Sub Category --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">Sub Category</label>

                        <select name="sub_category_id"
                                id="sub_category"
                                class="form-select"
                                required>

                            <option value="">Select Sub Category</option>

                            @foreach($subCategories as $sub)

                                <option value="{{ $sub->id }}">

                                    {{ $sub->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- Brand --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">Brand</label>

                        <select name="brand_id" class="form-select">

                            <option value="">Select Brand</option>

                            @foreach($brands as $brand)

                                <option value="{{ $brand->id }}">

                                    {{ $brand->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- Product Name --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Product Name</label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name') }}"
                               required>

                    </div>

                    {{-- SKU --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">SKU</label>

                        <input type="text"
                               class="form-control"
                               value="Auto Generated"
                               readonly>

                    </div>

                    {{-- Price --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">Price</label>

                        <input type="number"
                               step="0.01"
                               name="price"
                               class="form-control"
                               value="{{ old('price') }}"
                               required>

                    </div>

                    {{-- Sale Price --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">Sale Price</label>

                        <input type="number"
                               step="0.01"
                               name="sale_price"
                               class="form-control"
                               value="{{ old('sale_price') }}">

                    </div>

                    {{-- Stock --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">Stock</label>

                        <input type="number"
                               name="stock"
                               class="form-control"
                               value="{{ old('stock') }}"
                               required>

                    </div>

                    {{-- Thumbnail --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Thumbnail</label>

                        <input type="file"
                               name="thumbnail"
                               class="form-control">

                    </div>

                    {{-- Gallery --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Gallery Images</label>

                        <input type="file"
                               name="gallery[]"
                               class="form-control"
                               multiple>

                    </div>

                    {{-- Featured --}}
                    <div class="col-md-3 mb-3">

                        <label class="form-label">Featured</label>

                        <select name="featured" class="form-select">

                            <option value="0">No</option>

                            <option value="1">Yes</option>

                        </select>

                    </div>

                    {{-- Trending --}}
                    <div class="col-md-3 mb-3">

                        <label class="form-label">Trending</label>

                        <select name="trending" class="form-select">

                            <option value="0">No</option>

                            <option value="1">Yes</option>

                        </select>

                    </div>

                    {{-- Status --}}
                    <div class="col-md-3 mb-3">

                        <label class="form-label">Status</label>

                        <select name="status" class="form-select">

                            <option value="1">Active</option>

                            <option value="0">Inactive</option>

                        </select>

                    </div>

                    {{-- Description --}}
                    <div class="col-md-12 mb-3">

                        <label class="form-label">Description</label>

                        <textarea name="description"
                                  rows="5"
                                  class="form-control">{{ old('description') }}</textarea>

                    </div>

                </div>

                <button class="btn btn-primary">

                    Save Product

                </button>

            </form>

        </div>

    </div>

</div>

@endsection

@section('scripts')

<script>

document.getElementById('category').addEventListener('change', function(){

    let categoryId=this.value;

    fetch('/admin/get-sub-categories/'+categoryId)

    .then(res=>res.json())

    .then(data=>{

        let sub=document.getElementById('sub_category');

        sub.innerHTML='<option value="">Select Sub Category</option>';

        data.forEach(function(item){

            sub.innerHTML += `<option value="${item.id}">${item.name}</option>`;

        });

    });

});

</script>

@endsection