@extends('admin.layouts.app')

@section('title', 'Edit Sub Category')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>Edit Sub Category</h3>

        <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-secondary">
            Back
        </a>

    </div>

    <form action="{{ route('admin.sub-categories.update', $subCategory->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        @php
            $button = 'Update Sub Category';
        @endphp

        @include('admin.sub-categories.form')

    </form>

</div>

@endsection