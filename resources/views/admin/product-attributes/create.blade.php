@extends('admin.layouts.app')

@section('title', 'Add Product Attribute')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header">

            <h4 class="mb-0">
                Add Product Attribute
            </h4>

        </div>

        <div class="card-body">

            <form action="{{ route('admin.product-attributes.store') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Attribute Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
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

                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>
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
                    Save Attribute
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