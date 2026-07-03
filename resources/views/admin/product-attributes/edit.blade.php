@extends('admin.layouts.app')

@section('title', 'Edit Product Attribute')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header">

            <h4 class="mb-0">
                Edit Product Attribute
            </h4>

        </div>

        <div class="card-body">

            <form action="{{ route('admin.product-attributes.update', $productAttribute->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        Attribute Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $productAttribute->name) }}"
                        placeholder="Enter Attribute Name">

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select @error('status') is-invalid @enderror">

                        <option value="1" {{ $productAttribute->status ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0" {{ !$productAttribute->status ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i>
                    Update Attribute
                </button>

                <a href="{{ route('admin.product-attributes.index') }}"
                   class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>

    </div>

</div>

@endsection