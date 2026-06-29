<div class="mb-3">
    <label class="form-label">Category Name</label>

    <input type="text"
           name="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $category->name ?? '') }}">

    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Description</label>

    <textarea
        name="description"
        rows="5"
        class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description ?? '') }}</textarea>

    @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">

    <label class="form-label">
        Category Image
    </label>

    <input
        type="file"
        name="image"
        class="form-control @error('image') is-invalid @enderror">

    @error('image')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

    @isset($category)

        @if($category->image)

            <div class="mt-3">

                <img
                    src="{{ asset('uploads/categories/'.$category->image) }}"
                    width="120"
                    class="rounded border">

            </div>

        @endif

    @endisset

</div>

<div class="mb-4">

    <label class="form-label">
        Status
    </label>

    <select
        name="status"
        class="form-select">

        <option value="1"
            {{ old('status', $category->status ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>

        <option value="0"
            {{ old('status', $category->status ?? 1) == 0 ? 'selected' : '' }}>
            Inactive
        </option>

    </select>

</div>

<button class="btn btn-success">
    Save Category
</button>

<a href="{{ route('admin.categories.index') }}"
   class="btn btn-secondary">
    Cancel
</a>