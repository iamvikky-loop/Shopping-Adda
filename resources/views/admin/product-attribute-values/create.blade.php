@extends('admin.layouts.app')

@section('title', 'Add Attribute Value')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header">
            <h4 class="mb-0">Add Attribute Value</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.product-attribute-values.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Attribute</label>

                    <select name="attribute_id"
                            class="form-select @error('attribute_id') is-invalid @enderror">

                        <option value="">Select Attribute</option>

                        @foreach($attributes as $attribute)

                            <option value="{{ $attribute->id }}"
                                {{ old('attribute_id') == $attribute->id ? 'selected' : '' }}>

                                {{ $attribute->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('attribute_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">Attribute Value</label>

                    <input type="text"
                           name="value"
                           class="form-control @error('value') is-invalid @enderror"
                           value="{{ old('value') }}"
                           placeholder="Example: Red, XL, Cotton">

                    @error('value')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">Status</label>

                    <select name="status"
                            class="form-select @error('status') is-invalid @enderror">

                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i>
                    Save
                </button>

                <a href="{{ route('admin.product-attribute-values.index') }}"
                   class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>

    </div>

</div>

@endsection