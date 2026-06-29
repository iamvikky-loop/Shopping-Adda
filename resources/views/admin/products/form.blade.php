<div class="row">

    {{-- Category --}}
    <div class="col-md-4 mb-3">
        <label class="form-label">Category</label>

        <select name="category_id" id="category" class="form-select" required>

            <option value="">Select Category</option>

            @foreach($categories as $category)

                <option value="{{ $category->id }}"
                    {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>

                    {{ $category->name }}

                </option>

            @endforeach

        </select>
    </div>

    {{-- Sub Category --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">Sub Category</label>

        <select name="sub_category_id" id="sub_category" class="form-select">

            <option value="">Select Sub Category</option>

            @foreach($subCategories as $subCategory)

                <option value="{{ $subCategory->id }}"
                    {{ old('sub_category_id', $product->sub_category_id ?? '') == $subCategory->id ? 'selected' : '' }}>

                    {{ $subCategory->name }}

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

                <option value="{{ $brand->id }}"
                    {{ old('brand_id', $product->brand_id ?? '') == $brand->id ? 'selected' : '' }}>

                    {{ $brand->name }}

                </option>

            @endforeach

        </select>

    </div>

    {{-- Product Name --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">Product Name</label>

        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name', $product->name ?? '') }}"
            required>

    </div>
    
    {{-- Price --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">Price</label>

        <input
            type="number"
            step="0.01"
            name="price"
            class="form-control"
            value="{{ old('price', $product->price ?? '') }}"
            required>

    </div>

    {{-- Sale Price --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">Sale Price</label>

        <input
            type="number"
            step="0.01"
            name="sale_price"
            class="form-control"
            value="{{ old('sale_price', $product->sale_price ?? '') }}">

    </div>

    {{-- Stock --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">Stock</label>

        <input
            type="number"
            name="stock"
            class="form-control"
            value="{{ old('stock', $product->stock ?? '') }}"
            required>

    </div>

    {{-- Description --}}
    <div class="col-md-12 mb-3">

        <label class="form-label">Description</label>

        <textarea
            name="description"
            rows="5"
            class="form-control">{{ old('description', $product->description ?? '') }}</textarea>

    </div>

    {{-- Thumbnail --}}
    <div class="col-md-6 mb-3">

        <label class="form-label">Product Image</label>

        <input
    type="file"
    name="thumbnail"
    class="form-control">

<hr>

<label class="form-label mt-3">
    Product Gallery Images
</label>

<input
    type="file"
    name="gallery[]"
    class="form-control"
    multiple>

<small class="text-muted">
    You can select multiple images.
</small>

    </div>

    {{-- Status --}}
    <div class="col-md-3 mb-3">

        <label class="form-label">Status</label>

        <select
            name="status"
            class="form-select">

            <option value="1"
                {{ old('status', $product->status ?? 1) == 1 ? 'selected' : '' }}>

                Active

            </option>

            <option value="0"
                {{ old('status', $product->status ?? 1) == 0 ? 'selected' : '' }}>

                Inactive

            </option>

        </select>

    </div>

    {{-- Current Thumbnail --}}
    <div class="col-md-3 mb-3">

        @if(isset($product) && $product->thumbnail)

            <label class="form-label d-block">

                Current Image

            </label>

            <img
                src="{{ asset('uploads/products/'.$product->thumbnail) }}"
                width="120"
                class="img-thumbnail">

        @endif

    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    let category = document.getElementById("category");
    let subCategory = document.getElementById("sub_category");

    category.addEventListener("change", function () {

        let categoryId = this.value;

        subCategory.innerHTML =
            '<option value="">Loading...</option>';

        fetch("/admin/get-sub-categories/" + categoryId)

            .then(response => response.json())

            .then(data => {

                subCategory.innerHTML =
                    '<option value="">Select Sub Category</option>';

                data.forEach(function(item){

                    subCategory.innerHTML +=
                        `<option value="${item.id}">${item.name}</option>`;

                });

            });

    });

});
</script>