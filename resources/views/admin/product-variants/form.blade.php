<div class="row">

    <div class="col-md-6 mb-3">

        <label class="form-label">Product</label>

        <select name="product_id"
                class="form-select"
                required>

            <option value="">Select Product</option>

            @foreach($products as $product)

                <option value="{{ $product->id }}"
                    {{ old('product_id',$productVariant->product_id ?? '')==$product->id ? 'selected' : '' }}>

                    {{ $product->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-3 mb-3">

        <label class="form-label">Color</label>

        <input
            type="text"
            name="color"
            class="form-control"
            value="{{ old('color',$productVariant->color ?? '') }}">

    </div>

    <div class="col-md-3 mb-3">

        <label class="form-label">Size</label>

        <input
            type="text"
            name="size"
            class="form-control"
            value="{{ old('size',$productVariant->size ?? '') }}">

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">Price</label>

        <input
            type="number"
            step="0.01"
            name="price"
            class="form-control"
            value="{{ old('price',$productVariant->price ?? '') }}"
            required>

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">Sale Price</label>

        <input
            type="number"
            step="0.01"
            name="sale_price"
            class="form-control"
            value="{{ old('sale_price',$productVariant->sale_price ?? '') }}">

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">Stock</label>

        <input
            type="number"
            name="stock"
            class="form-control"
            value="{{ old('stock',$productVariant->stock ?? '') }}"
            required>

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">Status</label>

        <select
            name="status"
            class="form-select">

            <option value="1"
                {{ old('status',$productVariant->status ?? 1)==1 ? 'selected':'' }}>

                Active

            </option>

            <option value="0"
                {{ old('status',$productVariant->status ?? 1)==0 ? 'selected':'' }}>

                Inactive

            </option>

        </select>

    </div>

</div>