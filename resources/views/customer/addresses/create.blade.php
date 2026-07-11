@extends('home.layouts.app')

@section('title','Add Address')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow border-0">

                <div class="card-header bg-primary text-white">

                    <h4 class="mb-0">
                        Add New Address
                    </h4>

                </div>

                <div class="card-body">

                    @if ($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <form action="{{ route('addresses.store') }}" method="POST">

                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">Full Name</label>

                                <input
                                    type="text"
                                    name="full_name"
                                    class="form-control"
                                    value="{{ old('full_name') }}"
                                    required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">Mobile Number</label>

                                <input
                                    type="text"
                                    name="mobile"
                                    class="form-control"
                                    value="{{ old('mobile') }}"
                                    required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">Email</label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email') }}">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">Country</label>

                                <input
                                    type="text"
                                    name="country"
                                    class="form-control"
                                    value="{{ old('country','India') }}"
                                    required>

                            </div>

                            <div class="col-12 mb-3">

                                <label class="form-label">Address Line 1</label>

                                <textarea
                                    name="address_line1"
                                    rows="2"
                                    class="form-control"
                                    required>{{ old('address_line1') }}</textarea>

                            </div>

                            <div class="col-12 mb-3">

                                <label class="form-label">Address Line 2</label>

                                <textarea
                                    name="address_line2"
                                    rows="2"
                                    class="form-control">{{ old('address_line2') }}</textarea>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label">City</label>

                                <input
                                    type="text"
                                    name="city"
                                    class="form-control"
                                    value="{{ old('city') }}"
                                    required>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label">State</label>

                                <input
                                    type="text"
                                    name="state"
                                    class="form-control"
                                    value="{{ old('state') }}"
                                    required>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label">Postal Code</label>

                                <input
                                    type="text"
                                    name="postal_code"
                                    class="form-control"
                                    value="{{ old('postal_code') }}"
                                    required>

                            </div>

                        </div>

                        <div class="d-flex justify-content-between mt-3">

                            <a href="{{ route('addresses.index') }}"
                               class="btn btn-secondary">

                                Back

                            </a>

                            <button
                                class="btn btn-primary">

                                Save Address

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection