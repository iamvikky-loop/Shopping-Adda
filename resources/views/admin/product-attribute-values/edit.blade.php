@extends('admin.layouts.app')

@section('title', 'Edit Attribute Value')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header">
            <h4 class="mb-0">Edit Attribute Value</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.product-attribute-values.update', $productAttributeValue->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        Attribute
                    </label>

                    <select name="attribute_id"
                            class="form-select @error('attribute_id') is-invalid @enderror">

                        @foreach($attributes as $attribute)

                            <option value="{{ $attribute->id }}"
                                {{ $productAttributeValue->attribute_id == $attribute->id ? 'selected' : '' }}>

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

                    <label class="form-label">
                        Attribute Value
                    </label>

                    <input type="text"
                           name="value"
                           class="form-control @error('value') is-invalid @enderror"
                           value="{{ old('value', $productAttributeValue->value) }}">

                    @error('value')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select name="status"
                            class="form-select @error('status') is-invalid @enderror">

                        <option value="1"
                            {{ $productAttributeValue->status ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0"
                            {{ !$productAttributeValue->status ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <button class="btn btn-primary">
                    <i class="bi bi-check-circle"></i>
                    Update
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