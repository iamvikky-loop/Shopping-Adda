@extends('admin.layouts.app')

@section('title','Order Details')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-receipt-cutoff text-primary"></i>

                Order Details

            </h2>

            <p class="text-muted mb-0">

                Order Number :

                <strong>

                    {{ $order->order_number }}

                </strong>

            </p>

        </div>

        <div>

            <a href="{{ route('admin.orders.index') }}"
               class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>

                Back

            </a>

            <a route('admin.orders.invoice', $order)
               class="btn btn-success">

                <i class="bi bi-printer"></i>

                Print

            </a>

            <a route('admin.orders.invoice', $order)
               class="btn btn-danger">

                <i class="bi bi-file-earmark-pdf"></i>

                Invoice

            </a>

        </div>

    </div>



    <div class="row">

        {{-- Customer Information --}}

        <div class="col-lg-4">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-primary text-white">

                    <h5 class="mb-0">

                        Customer Information

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-borderless">

                        <tr>

                            <th width="120">

                                Name

                            </th>

                            <td>

                                {{ $order->user->name }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Email

                            </th>

                            <td>

                                {{ $order->user->email }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Phone

                            </th>

                            <td>

                                {{ $order->address->mobile }}

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>



        {{-- Shipping Address --}}

        <div class="col-lg-4">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-success text-white">

                    <h5 class="mb-0">

                        Shipping Address

                    </h5>

                </div>

                <div class="card-body">

                    <strong>

                        {{ $order->address->full_name }}

                    </strong>

                    <br><br>

                    {{ $order->address->address_line1 }}

                    <br>

                    @if($order->address->address_line2)

                        {{ $order->address->address_line2 }}

                        <br>

                    @endif

                    {{ $order->address->city }}

                    ,

                    {{ $order->address->state }}

                    <br>

                    {{ $order->address->country }}

                    -

                    {{ $order->address->postal_code }}

                    <br><br>

                    <strong>

                        Mobile

                    </strong>

                    :

                    {{ $order->address->mobile }}

                </div>

            </div>

        </div>



        {{-- Payment Information --}}

        <div class="col-lg-4">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-dark text-white">

                    <h5 class="mb-0">

                        Payment Details

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-borderless">

                        <tr>

                            <th width="130">

                                Method

                            </th>

                            <td>

                                {{ $order->payment_method }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Payment

                            </th>

                            <td>

                                @if($order->payment_status=='Paid')

                                    <span class="badge bg-success">

                                        Paid

                                    </span>

                                @elseif($order->payment_status=='Pending')

                                    <span class="badge bg-warning text-dark">

                                        Pending

                                    </span>

                                @elseif($order->payment_status=='Failed')

                                    <span class="badge bg-danger">

                                        Failed

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        {{ $order->payment_status }}

                                    </span>

                                @endif

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Status

                            </th>

                            <td>

                                <span class="badge bg-primary">

                                    {{ $order->order_status }}

                                </span>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Date

                            </th>

                            <td>

                                {{ $order->created_at->format('d M Y h:i A') }}

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

        {{-- ===============================
        Ordered Products
    ================================ --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">

                <i class="bi bi-box-seam"></i>

                Ordered Products

            </h5>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th width="90">

                            Image

                        </th>

                        <th>

                            Product

                        </th>

                        <th>

                            SKU

                        </th>

                        <th>

                            Variant

                        </th>

                        <th class="text-center">

                            Qty

                        </th>

                        <th class="text-end">

                            Price

                        </th>

                        <th class="text-end">

                            Total

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($order->items as $item)

                    <tr>

                        <td>

                            @if($item->product && $item->product->thumbnail)

                                <img
                                    src="{{ asset('storage/'.$item->product->thumbnail) }}"
                                    class="img-thumbnail"
                                    style="width:70px;height:70px;object-fit:cover;">

                            @else

                                <img
                                    src="https://placehold.co/70x70?text=No+Image"
                                    class="img-thumbnail">

                            @endif

                        </td>

                        <td>

                            <strong>

                                {{ $item->product->name ?? 'Product Deleted' }}

                            </strong>

                            <br>

                            <small class="text-muted">

                                Product ID :
                                {{ $item->product_id }}

                            </small>

                        </td>

                        <td>

                            {{ $item->product->sku ?? '-' }}

                        </td>

                        <td>

                            @if($item->variant)

                                <span class="badge bg-info">

                                    {{ $item->variant->name ?? 'Variant' }}

                                </span>

                            @else

                                <span class="text-muted">

                                    -

                                </span>

                            @endif

                        </td>

                        <td class="text-center">

                            {{ $item->quantity }}

                        </td>

                        <td class="text-end">

                            ₹{{ number_format($item->price,2) }}

                        </td>

                        <td class="text-end fw-bold">

                            ₹{{ number_format($item->total,2) }}

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>





    {{-- ===============================
        Order Summary
    ================================ --}}

    <div class="row">

        <div class="col-lg-7">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-dark text-white">

                    <h5 class="mb-0">

                        Order Notes

                    </h5>

                </div>

                <div class="card-body">

                    @if($order->customer_note)

                        <div class="alert alert-info">

                            <strong>

                                Customer Note

                            </strong>

                            <hr>

                            {{ $order->customer_note }}

                        </div>

                    @endif

                    @if($order->admin_note)

                        <div class="alert alert-warning">

                            <strong>

                                Admin Note

                            </strong>

                            <hr>

                            {{ $order->admin_note }}

                        </div>

                    @endif

                    @if(!$order->customer_note && !$order->admin_note)

                        <div class="text-center text-muted py-4">

                            <i class="bi bi-chat-square-text fs-1"></i>

                            <br><br>

                            No Notes Available

                        </div>

                    @endif

                </div>

            </div>

        </div>
                {{-- ===============================
            Order Summary
        ================================ --}}

        <div class="col-lg-5">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-success text-white">

                    <h5 class="mb-0">

                        Order Summary

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-borderless">

                        <tr>

                            <th>

                                Subtotal

                            </th>

                            <td class="text-end">

                                ₹{{ number_format($order->subtotal,2) }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Shipping Charge

                            </th>

                            <td class="text-end">

                                ₹{{ number_format($order->shipping_charge,2) }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Discount

                            </th>

                            <td class="text-end text-success">

                                - ₹{{ number_format($order->discount,2) }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Tax

                            </th>

                            <td class="text-end">

                                ₹{{ number_format($order->tax,2) }}

                            </td>

                        </tr>

                        <tr class="border-top">

                            <th class="fs-5">

                                Grand Total

                            </th>

                            <th class="text-end text-primary fs-5">

                                ₹{{ number_format($order->grand_total,2) }}

                            </th>

                        </tr>

                    </table>

                </div>

            </div>



            {{-- Shipping Information --}}

            <div class="card shadow-sm border-0 mt-4">

                <div class="card-header bg-info text-white">

                    <h5 class="mb-0">

                        Shipping Information

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-borderless mb-0">

                        <tr>

                            <th width="140">

                                Courier

                            </th>

                            <td>

                                {{ $order->courier ?? 'Not Assigned' }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Tracking No.

                            </th>

                            <td>

                                {{ $order->tracking_number ?? 'Not Available' }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Expected Delivery

                            </th>

                            <td>

                                @if($order->expected_delivery)

                                    {{ \Carbon\Carbon::parse($order->expected_delivery)->format('d M Y') }}

                                @else

                                    -

                                @endif

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>
    {{-- ===========================================
    Order Management
=========================================== --}}

<div class="row mt-4">

    {{-- Order Status --}}
    <div class="col-lg-6">

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-warning">

                <h5 class="mb-0 text-dark">
                    <i class="bi bi-truck"></i>
                    Order Status
                </h5>

            </div>

            <div class="card-body">

                <form
    action="{{ route('admin.orders.status', $order) }}"
    method="POST">

    @csrf
    @method('PATCH')

    <div class="mb-3">

        <label class="form-label fw-bold">

            Current Status

        </label>

        <select
            name="order_status"
            class="form-select">

            @foreach([
                'Pending',
                'Confirmed',
                'Packed',
                'Shipped',
                'Out For Delivery',
                'Delivered',
                'Cancelled',
                'Returned'
            ] as $status)

                <option
                    value="{{ $status }}"
                    {{ $order->order_status == $status ? 'selected' : '' }}>

                    {{ $status }}

                </option>

            @endforeach

        </select>

    </div>

    <button
        type="submit"
        class="btn btn-warning w-100">

        <i class="bi bi-save"></i>

        Update Order Status

    </button>

</form>

            </div>

        </div>

    </div>



    {{-- Payment Status --}}

    <div class="col-lg-6">

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-success text-white">

                <h5 class="mb-0">

                    <i class="bi bi-credit-card"></i>

                    Payment Status

                </h5>

            </div>

            <div class="card-body">

                <form
    action="{{ route('admin.orders.payment', $order) }}"
    method="POST">

    @csrf
    @method('PATCH')

    <div class="mb-3">

        <label class="form-label fw-bold">

            Payment Status

        </label>

        <select
            name="payment_status"
            class="form-select">

            @foreach([
                'Pending',
                'Paid',
                'Failed',
                'Refunded'
            ] as $status)

                <option
                    value="{{ $status }}"
                    {{ $order->payment_status == $status ? 'selected' : '' }}>

                    {{ $status }}

                </option>

            @endforeach

        </select>

    </div>

    <button
        type="submit"
        class="btn btn-success w-100">

        <i class="bi bi-credit-card"></i>

        Update Payment

    </button>

</form>

            </div>

        </div>

    </div>

</div>





{{-- ===========================================
    Tracking Information
=========================================== --}}

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-info text-white">

        <h5 class="mb-0">

            <i class="bi bi-geo-alt-fill"></i>

            Tracking Information

        </h5>

    </div>

    <div class="card-body">

        <form action="{{ route('admin.orders.tracking', $order) }}" method="POST">

            @csrf

            <div class="row">

                <div class="col-md-4">

                    <label class="form-label">

                        Courier Company

                    </label>

                    <input
                        type="text"
                        name="courier"
                        value="{{ $order->courier }}"
                        class="form-control">

                </div>

                <div class="col-md-4">

                    <label class="form-label">

                        Tracking Number

                    </label>

                    <input
                        type="text"
                        name="tracking_number"
                        value="{{ $order->tracking_number }}"
                        class="form-control">

                </div>

                <div class="col-md-4">

                    <label class="form-label">

                        Expected Delivery

                    </label>

                    <input
                        type="date"
                        name="expected_delivery"
                        value="{{ $order->expected_delivery }}"
                        class="form-control">

                </div>

            </div>

            <div class="mt-4">

                <button
                    class="btn btn-info text-white">

                    <i class="bi bi-save"></i>

                    Save Tracking

                </button>

            </div>

        </form>

    </div>

</div>
{{-- ===========================================
    Order Timeline
=========================================== --}}

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-dark text-white">

        <h5 class="mb-0">
            <i class="bi bi-clock-history"></i>
            Order Timeline
        </h5>

    </div>

    <div class="card-body">

        <div class="d-flex justify-content-between text-center flex-wrap">

            @php

                $steps = [
                    'Pending',
                    'Confirmed',
                    'Packed',
                    'Shipped',
                    'Out For Delivery',
                    'Delivered'
                ];

                $current = array_search($order->order_status,$steps);

            @endphp

            @foreach($steps as $index=>$step)

                <div class="mb-3">

                    <div class="rounded-circle mx-auto mb-2
                        {{ $index <= $current ? 'bg-success' : 'bg-secondary' }}
                        text-white d-flex align-items-center justify-content-center"
                        style="width:50px;height:50px;">

                        {{ $index+1 }}

                    </div>

                    <small>

                        {{ $step }}

                    </small>

                </div>

            @endforeach

        </div>

    </div>

</div>





{{-- ===========================================
    Notes
=========================================== --}}

<div class="row">

    <div class="col-lg-6">

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-info text-white">

                <h5 class="mb-0">

                    Customer Note

                </h5>

            </div>

            <div class="card-body">

                @if($order->customer_note)

                    {{ $order->customer_note }}

                @else

                    <span class="text-muted">

                        No customer note available.

                    </span>

                @endif

            </div>

        </div>

    </div>





    <div class="col-lg-6">

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-secondary text-white">

                <h5 class="mb-0">

                    Admin Note

                </h5>

            </div>

            <div class="card-body">

                <form action="{{ route('admin.orders.note', $order) }}" method="POST">

                    @csrf

                    <textarea
                        class="form-control"
                        rows="5"
                        name="admin_note">{{ $order->admin_note }}</textarea>

                    <button
                        class="btn btn-secondary mt-3">

                        Save Note

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>





{{-- ===========================================
    Footer Buttons
=========================================== --}}

<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="d-flex justify-content-between flex-wrap">

            <div>

                <a route('admin.orders.invoice.print', $order)
                   class="btn btn-danger">

                    <i class="bi bi-file-earmark-pdf"></i>

                    Generate Invoice

                </a>

                <a route('admin.orders.invoice.print', $order)
                   class="btn btn-success">

                    <i class="bi bi-printer"></i>

                    Print Invoice

                </a>

            </div>

            <div>

                <button
                    class="btn btn-outline-danger">

                    <i class="bi bi-trash"></i>

                    Delete Order

                </button>

            </div>

        </div>

    </div>

</div>

</div>

@endsection