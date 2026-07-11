@extends('home.layouts.app')

@section('title', 'My Addresses')

@section('content')

<div class="container py-5">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            My Addresses
        </h2>

        <a href="{{ route('addresses.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Add New Address
        </a>

    </div>

    <div class="row">

        @forelse($addresses as $address)

        <div class="col-lg-6 mb-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    @if($address->is_default)
                        <span class="badge bg-success mb-3">
                            Default Address
                        </span>
                    @endif

                    <h5 class="fw-bold">
                        {{ $address->full_name }}
                    </h5>

                    <p class="mb-1">
                        <strong>Mobile:</strong>
                        {{ $address->mobile }}
                    </p>

                    @if($address->email)
                        <p class="mb-1">
                            <strong>Email:</strong>
                            {{ $address->email }}
                        </p>
                    @endif

                    <hr>

                    <p class="mb-3">

                        {{ $address->address_line1 }}

                        @if($address->address_line2)
                            <br>
                            {{ $address->address_line2 }}
                        @endif

                        <br>

                        {{ $address->city }},
                        {{ $address->state }}

                        <br>

                        {{ $address->country }}
                        -
                        {{ $address->postal_code }}

                    </p>

                    <div class="d-flex flex-wrap gap-2">

                        <a href="{{ route('addresses.edit',$address->id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                            Edit
                        </a>

                        <form
                            action="{{ route('addresses.destroy',$address->id) }}"
                            method="POST"
                            onsubmit="return confirm('Delete this address?')">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                                Delete
                            </button>

                        </form>

                        @unless($address->is_default)

                        <form
                            action="{{ route('addresses.default',$address->id) }}"
                            method="POST">

                            @csrf

                            <button class="btn btn-success btn-sm">
                                Make Default
                            </button>

                        </form>

                        @endunless

                    </div>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="alert alert-info">

                No address found.

                <a href="{{ route('addresses.create') }}">
                    Add your first address
                </a>

            </div>

        </div>

        @endforelse

    </div>

</div>

@endsection