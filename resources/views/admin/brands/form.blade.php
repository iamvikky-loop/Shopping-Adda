<div class="mb-3">
    <label class="form-label">Brand Name</label>

    <input type="text"
           name="name"
           class="form-control"
           value="{{ old('name', $brand->name ?? '') }}"
           required>

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Description</label>

    <textarea
        name="description"
        rows="4"
        class="form-control">{{ old('description', $brand->description ?? '') }}</textarea>

    @error('description')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Logo</label>

    <input type="file"
           name="logo"
           class="form-control">

    @error('logo')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    @if(isset($brand) && $brand->logo)
        <div class="mt-3">
            <img src="{{ asset($brand->logo) }}"
                 width="120"
                 class="img-thumbnail">
        </div>
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Status</label>

    <select name="status" class="form-select">

        <option value="1"
            {{ old('status', $brand->status ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>

        <option value="0"
            {{ old('status', $brand->status ?? 1) == 0 ? 'selected' : '' }}>
            Inactive
        </option>

    </select>
</div>

<div class="mt-4">
    <button type="submit" class="btn btn-success">
        Save Brand
    </button>

    <a href="{{ route('admin.brands.index') }}"
       class="btn btn-secondary">
        Cancel
    </a>
</div>