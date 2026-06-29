@extends('admin.layouts.app')

@section('title','Create Category')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header">

            <h3>Add New Category</h3>

        </div>

        <div class="card-body">

            <form
                action="{{ route('admin.categories.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                @include('admin.categories.form')

            </form>

        </div>

    </div>

</div>

@endsection