@extends('admin.layouts.app')

@section('title', 'Add Sub Category')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>Add Sub Category</h3>

        <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-secondary">
            Back
        </a>

    </div>

    <form action="{{ route('admin.sub-categories.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        @php
            $button = 'Save Sub Category';
        @endphp

        @include('admin.sub-categories.form')

    </form>

</div>

@endsection