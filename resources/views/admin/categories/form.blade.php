{{-- Basic Information --}}
<div class="row">

    <div class="col-md-8">

        <div class="mb-3">

            <label class="form-label">
                Category Name <span class="text-danger">*</span>
            </label>

            <input
                type="text"
                name="name"
                id="category-name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $category->name ?? '') }}"
                placeholder="e.g. Electronics">

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

    </div>

    <div class="col-md-4">

        <div class="mb-3">

            <label class="form-label">Status <span class="text-danger">*</span></label>

            <select
                name="status"
                class="form-select @error('status') is-invalid @enderror">

                <option value="1" {{ old('status', $category->status ?? 1) == 1 ? 'selected' : '' }}>
                    Active
                </option>

                <option value="0" {{ old('status', $category->status ?? 1) == 0 ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>

            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

    </div>

</div>

<div class="mb-3">

    <label class="form-label">Slug</label>

    <input
        type="text"
        name="slug"
        id="category-slug"
        class="form-control @error('slug') is-invalid @enderror"
        value="{{ old('slug', $category->slug ?? '') }}"
        placeholder="auto-generated-from-name">

    <div class="form-text">
        Leave blank to auto-generate from name. Use lowercase letters, numbers and hyphens only.
    </div>

    @error('slug')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>

<div class="mb-3">

    <label class="form-label">Description</label>

    <textarea
        name="description"
        rows="4"
        class="form-control @error('description') is-invalid @enderror"
        placeholder="Brief description of this category">{{ old('description', $category->description ?? '') }}</textarea>

    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>

<hr class="my-4">

{{-- Images --}}
<h5 class="mb-3">
    <i class="bi bi-image text-primary"></i>
    Images
</h5>

<div class="row">

    <div class="col-md-4">

        <div class="mb-3">

            <label class="form-label">Category Image</label>

            <input
                type="file"
                name="image"
                class="form-control @error('image') is-invalid @enderror"
                accept="image/jpeg,image/png,image/webp">

            <div class="form-text">Max 2MB. JPG, PNG or WebP.</div>

            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @isset($category)
                @if($category->image)
                    <div class="mt-2">
                        <img
                            src="{{ asset('uploads/categories/'.$category->image) }}"
                            width="100"
                            class="rounded border"
                            alt="Current image">
                    </div>
                @endif
            @endisset

        </div>

    </div>

    <div class="col-md-4">

        <div class="mb-3">

            <label class="form-label">Banner Image</label>

            <input
                type="file"
                name="banner"
                class="form-control @error('banner') is-invalid @enderror"
                accept="image/jpeg,image/png,image/webp">

            <div class="form-text">Max 4MB. Used on category pages.</div>

            @error('banner')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @isset($category)
                @if($category->banner)
                    <div class="mt-2">
                        <img
                            src="{{ asset('uploads/categories/'.$category->banner) }}"
                            width="100"
                            class="rounded border"
                            alt="Current banner">
                    </div>
                @endif
            @endisset

        </div>

    </div>

    <div class="col-md-4">

        <div class="mb-3">

            <label class="form-label">Icon</label>

            <input
                type="file"
                name="icon"
                class="form-control @error('icon') is-invalid @enderror"
                accept="image/jpeg,image/png,image/webp">

            <div class="form-text">Max 1MB. Small icon for menus.</div>

            @error('icon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @isset($category)
                @if($category->icon)
                    <div class="mt-2">
                        <img
                            src="{{ asset('uploads/categories/'.$category->icon) }}"
                            width="50"
                            class="rounded border"
                            alt="Current icon">
                    </div>
                @endif
            @endisset

        </div>

    </div>

</div>

<hr class="my-4">

{{-- SEO --}}
<h5 class="mb-3">
    <i class="bi bi-search text-primary"></i>
    SEO Settings
</h5>

<div class="mb-3">

    <label class="form-label">Meta Title</label>

    <input
        type="text"
        name="meta_title"
        class="form-control @error('meta_title') is-invalid @enderror"
        value="{{ old('meta_title', $category->meta_title ?? '') }}"
        placeholder="SEO page title"
        maxlength="255">

    @error('meta_title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>

<div class="mb-3">

    <label class="form-label">Meta Description</label>

    <textarea
        name="meta_description"
        rows="3"
        class="form-control @error('meta_description') is-invalid @enderror"
        placeholder="SEO meta description"
        maxlength="500">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>

    @error('meta_description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>

<div class="mb-4">

    <label class="form-label">Meta Keywords</label>

    <textarea
        name="meta_keywords"
        rows="2"
        class="form-control @error('meta_keywords') is-invalid @enderror"
        placeholder="keyword1, keyword2, keyword3"
        maxlength="500">{{ old('meta_keywords', $category->meta_keywords ?? '') }}</textarea>

    @error('meta_keywords')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>

<div class="d-flex gap-2">

    <button type="submit" class="btn btn-success">
        <i class="bi bi-check-circle"></i>
        Save Category
    </button>

    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
        Cancel
    </a>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const nameInput = document.getElementById('category-name');
        const slugInput = document.getElementById('category-slug');

        if (!nameInput || !slugInput) {
            return;
        }

        const slugManuallyEdited = slugInput.value.length > 0;

        slugInput.addEventListener('input', function () {
            this.dataset.manual = 'true';
        });

        nameInput.addEventListener('input', function () {

            if (slugInput.dataset.manual === 'true' && slugInput.value.length > 0) {
                return;
            }

            slugInput.value = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        });

        if (!slugManuallyEdited) {
            nameInput.dispatchEvent(new Event('input'));
        }
    });
</script>
@endpush
