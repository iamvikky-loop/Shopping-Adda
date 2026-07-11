@extends('home.layouts.app')

@section('title','Add Address')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow border-0 rounded-4">

                <div class="card-header bg-primary text-white">

                    <h3 class="mb-0">
                        Add New Address
                    </h3>

                </div>

                <div class="card-body p-4">

                    <form action="{{ route('addresses.store') }}" method="POST">

                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Full Name
                                </label>

                                <input
                                    type="text"
                                    name="full_name"
                                    class="form-control"
                                    value="{{ old('full_name') }}"
                                    required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Mobile Number
                                </label>

                                <input
                                    type="text"
                                    name="mobile"
                                    class="form-control"
                                    value="{{ old('mobile') }}"
                                    required>

                            </div>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Address Line 1

                            </label>

                            <textarea
                                name="address_line1"
                                class="form-control"
                                rows="2"
                                required>{{ old('address_line1') }}</textarea>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Address Line 2

                            </label>

                            <textarea
                                name="address_line2"
                                class="form-control"
                                rows="2">{{ old('address_line2') }}</textarea>

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label class="form-label">

                                    City

                                </label>

                                <input
                                    type="text"
                                    name="city"
                                    class="form-control"
                                    value="{{ old('city') }}"
                                    required>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label">

                                    State

                                </label>

                                <input
                                    type="text"
                                    name="state"
                                    class="form-control"
                                    value="{{ old('state') }}"
                                    required>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label">

                                    Country

                                </label>

                                <input
                                    type="text"
                                    name="country"
                                    class="form-control"
                                    value="{{ old('country','India') }}"
                                    required>

                            </div>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Postal Code

                            </label>

                            <input
                                type="text"
                                name="postal_code"
                                class="form-control"
                                value="{{ old('postal_code') }}"
                                required>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('addresses.index') }}"
                               class="btn btn-secondary">

                                Back

                            </a>

                            <button
                                type="submit"
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