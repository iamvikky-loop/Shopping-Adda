@extends('home.layouts.app')

@section('title','Edit Address')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow border-0 rounded-4">

                <div class="card-header bg-warning">

                    <h3 class="mb-0">
                        Edit Address
                    </h3>

                </div>

                <div class="card-body p-4">

                    <form action="{{ route('addresses.update',$address->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label>Full Name</label>

                                <input
                                    type="text"
                                    class="form-control"
                                    name="full_name"
                                    value="{{ old('full_name',$address->full_name) }}"
                                    required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>Mobile</label>

                                <input
                                    type="text"
                                    class="form-control"
                                    name="mobile"
                                    value="{{ old('mobile',$address->mobile) }}"
                                    required>

                            </div>

                        </div>

                        <div class="mb-3">

                            <label>Email</label>

                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                value="{{ old('email',$address->email) }}">

                        </div>

                        <div class="mb-3">

                            <label>Address Line 1</label>

                            <textarea
                                class="form-control"
                                rows="2"
                                name="address_line1"
                                required>{{ old('address_line1',$address->address_line1) }}</textarea>

                        </div>

                        <div class="mb-3">

                            <label>Address Line 2</label>

                            <textarea
                                class="form-control"
                                rows="2"
                                name="address_line2">{{ old('address_line2',$address->address_line2) }}</textarea>

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label>City</label>

                                <input
                                    type="text"
                                    class="form-control"
                                    name="city"
                                    value="{{ old('city',$address->city) }}"
                                    required>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>State</label>

                                <input
                                    type="text"
                                    class="form-control"
                                    name="state"
                                    value="{{ old('state',$address->state) }}"
                                    required>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>Country</label>

                                <input
                                    type="text"
                                    class="form-control"
                                    name="country"
                                    value="{{ old('country',$address->country) }}"
                                    required>

                            </div>

                        </div>

                        <div class="mb-4">

                            <label>Postal Code</label>

                            <input
                                type="text"
                                class="form-control"
                                name="postal_code"
                                value="{{ old('postal_code',$address->postal_code) }}"
                                required>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('addresses.index') }}"
                               class="btn btn-secondary">

                                Back

                            </a>

                            <button
                                class="btn btn-warning">

                                Update Address

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection