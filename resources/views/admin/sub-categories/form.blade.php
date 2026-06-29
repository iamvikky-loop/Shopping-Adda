<div class="card shadow">

    <div class="card-body">

        <div class="mb-3">
            <label class="form-label">Category</label>

            <select name="category_id" class="form-select" required>

                <option value="">Select Category</option>

                @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id', $subCategory->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>

            @error('category_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>


        <div class="mb-3">

            <label class="form-label">Sub Category Name</label>

            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name', $subCategory->name ?? '') }}"
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
                class="form-control">{{ old('description', $subCategory->description ?? '') }}</textarea>

        </div>


        <div class="mb-3">

            <label class="form-label">Image</label>

            <input
                type="file"
                name="image"
                class="form-control">

            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>


        @isset($subCategory)

            @if($subCategory->image)

                <div class="mb-3">

                    <img
                        src="{{ asset('uploads/sub-categories/'.$subCategory->image) }}"
                        width="120"
                        class="img-thumbnail">

                </div>

            @endif

        @endisset


        <div class="mb-3">

            <label class="form-label">Status</label>

            <select name="status" class="form-select">

                <option value="1"
                    {{ old('status', $subCategory->status ?? 1) == 1 ? 'selected' : '' }}>
                    Active
                </option>

                <option value="0"
                    {{ old('status', $subCategory->status ?? 1) == 0 ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>

        </div>


        <button class="btn btn-success">
            {{ $button }}
        </button>

        <a href="{{ route('admin.sub-categories.index') }}"
           class="btn btn-secondary">
            Cancel
        </a>

    </div>

</div>