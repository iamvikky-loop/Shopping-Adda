@extends('admin.layouts.app')

@section('title','Edit Category')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header">

            <h3>Edit Category</h3>

        </div>

        <div class="card-body">

            <form
                action="{{ route('admin.categories.update',$category->id) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                @method('PUT')

                @include('admin.categories.form')

            </form>

        </div>

    </div>

</div>

@endsection