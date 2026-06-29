@extends('admin.layouts.app')

@section('title', 'Add Brand')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header">

            <h4>Add Brand</h4>

        </div>

        <div class="card-body">

            <form action="{{ route('admin.brands.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                @include('admin.brands.form')

            </form>

        </div>

    </div>

</div>

@endsection