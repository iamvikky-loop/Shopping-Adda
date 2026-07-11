@extends('admin.layouts.app')

@section('title','Shipping Settings')

@section('content')

<div class="container py-4">

    <div class="card shadow">

        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">
                Shipping Settings
            </h4>
        </div>

        <div class="card-body">

            @if(session('success'))

                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif

            <form action="{{ route('admin.shipping.update') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Shipping Type
                    </label>

                    <select
                        class="form-select"
                        name="shipping_type">

                        <option value="flat"
                            {{ $shipping->shipping_type=='flat'?'selected':'' }}>
                            Flat Shipping
                        </option>

                        <option value="free"
                            {{ $shipping->shipping_type=='free'?'selected':'' }}>
                            Free Shipping
                        </option>

                        <option value="weight"
                            {{ $shipping->shipping_type=='weight'?'selected':'' }}>
                            Weight Based
                        </option>

                        <option value="location"
                            {{ $shipping->shipping_type=='location'?'selected':'' }}>
                            Location Based
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Shipping Charge
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        class="form-control"
                        name="shipping_charge"
                        value="{{ $shipping->shipping_charge }}">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Free Shipping Above
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        class="form-control"
                        name="free_shipping_above"
                        value="{{ $shipping->free_shipping_above }}">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        COD Charge
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        class="form-control"
                        name="cod_charge"
                        value="{{ $shipping->cod_charge }}">

                </div>

                <div class="form-check mb-4">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="status"
                        value="1"
                        {{ $shipping->status ? 'checked' : '' }}>

                    <label class="form-check-label">

                        Enable Shipping

                    </label>

                </div>

                <button
                    class="btn btn-primary">

                    Save Settings

                </button>

            </form>

        </div>

    </div>

</div>

@endsection