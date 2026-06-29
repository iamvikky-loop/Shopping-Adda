@extends('admin.layouts.app')

@section('title', 'Edit Brand')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header">

            <h4>Edit Brand</h4>

        </div>

        <div class="card-body">

            <form action="{{ route('admin.brands.update', $brand) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                @include('admin.brands.form')

            </form>

        </div>

    </div>

</div>

@endsection