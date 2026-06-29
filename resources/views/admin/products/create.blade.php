@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Add Product</h2>

        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            Back
        </a>

    </div>

    @if ($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="card shadow">

        <div class="card-body">

            <form action="{{ route('admin.products.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                @include('admin.products.form')

                <button type="submit" class="btn btn-success">

                    Save Product

                </button>

            </form>

        </div>

    </div>

</div>

@endsection