@extends('admin.layouts.app')

@section('title', 'Orders Management')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                <i class="bi bi-bag-check-fill text-primary"></i>
                Orders Management
            </h2>

            <p class="text-muted mb-0">
                Manage customer orders, payments, invoices and deliveries.
            </p>

        </div>

        <div>

            <a href="#"
               class="btn btn-success">

                <i class="bi bi-download"></i>

                Export Orders

            </a>

        </div>

    </div>

    {{-- Statistics Cards --}}

    <div class="row g-4 mb-4">

        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">

                                Total Orders

                            </small>

                            <h2 class="fw-bold mt-2">

                                {{ $orders->total() }}

                            </h2>

                        </div>

                        <div>

                            <span class="bg-primary text-white rounded-circle p-3">

                                <i class="bi bi-bag fs-4"></i>

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">

                                Pending Orders

                            </small>

                            <h2 class="fw-bold mt-2 text-warning">

                                {{ $orders->where('order_status','Pending')->count() }}

                            </h2>

                        </div>

                        <div>

                            <span class="bg-warning text-dark rounded-circle p-3">

                                <i class="bi bi-clock-history fs-4"></i>

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">

                                Delivered

                            </small>

                            <h2 class="fw-bold mt-2 text-success">

                                {{ $orders->where('order_status','Delivered')->count() }}

                            </h2>

                        </div>

                        <div>

                            <span class="bg-success text-white rounded-circle p-3">

                                <i class="bi bi-check-circle fs-4"></i>

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">

                                Revenue

                            </small>

                            <h2 class="fw-bold mt-2 text-primary">

                                ₹{{ number_format($orders->sum('grand_total'),2) }}

                            </h2>

                        </div>

                        <div>

                            <span class="bg-info text-white rounded-circle p-3">

                                <i class="bi bi-currency-rupee fs-4"></i>

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Filters --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form method="GET">

                <div class="row g-3">

                    <div class="col-lg-3">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Search Order / Invoice / Customer">

                    </div>

                    <div class="col-lg-2">

                        <select
                            name="payment_status"
                            class="form-select">

                            <option value="">Payment</option>

                            <option value="Pending">Pending</option>

                            <option value="Paid">Paid</option>

                            <option value="Failed">Failed</option>

                            <option value="Refunded">Refunded</option>

                        </select>

                    </div>

                    <div class="col-lg-2">

                        <select
                            name="order_status"
                            class="form-select">

                            <option value="">Order Status</option>

                            <option>Pending</option>

                            <option>Confirmed</option>

                            <option>Packed</option>

                            <option>Shipped</option>

                            <option>Out For Delivery</option>

                            <option>Delivered</option>

                            <option>Cancelled</option>

                            <option>Returned</option>

                        </select>

                    </div>

                    <div class="col-lg-2">

                        <input
                            type="date"
                            class="form-control"
                            name="from">

                    </div>

                    <div class="col-lg-2">

                        <input
                            type="date"
                            class="form-control"
                            name="to">

                    </div>

                    <div class="col-lg-1 d-grid">

                        <button
                            class="btn btn-primary">

                            <i class="bi bi-search"></i>

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- Orders Table Starts Here --}}

    <div class="card border-0 shadow-sm">

        <div class="table-responsive">

            <table class="table align-middle table-hover mb-0">

                <thead class="table-dark">

                <tr>

                    <th>#</th>

                    <th>Order</th>

                    <th>Customer</th>

                    <th>Amount</th>

                    <th>Payment</th>

                    <th>Status</th>

                    <th>Delivery</th>

                    <th>Actions</th>

                </tr>

                </thead>

                <tbody>
                @forelse($orders as $order)

<tr>
<td>

    <input
        type="checkbox"
        class="order-checkbox"
        value="{{ $order->id }}">

</td>
    <td>

        <strong>#{{ $loop->iteration }}</strong>

    </td>

    <td>

        <div class="fw-bold">

            {{ $order->order_number }}

        </div>

        <small class="text-muted">

            Invoice :
            {{ $order->invoice_number ?? 'Not Generated' }}

        </small>

        <br>

        <small class="text-muted">

            {{ $order->created_at->format('d M Y h:i A') }}

        </small>

    </td>

    <td>

        <strong>

            {{ $order->user->name }}

        </strong>

        <br>

        <small>

            {{ $order->user->email }}

        </small>

        <br>

        <small class="text-muted">

            {{ optional($order->address)->mobile }}

        </small>

    </td>

    <td>

        <div class="fw-bold text-success">

            ₹{{ number_format($order->grand_total,2) }}

        </div>

        <small class="text-muted">

            {{ $order->items->count() }} Products

        </small>

    </td>

    <td>

        @switch($order->payment_status)

            @case('Paid')

                <span class="badge bg-success">

                    Paid

                </span>

                @break

            @case('Pending')

                <span class="badge bg-warning text-dark">

                    Pending

                </span>

                @break

            @case('Failed')

                <span class="badge bg-danger">

                    Failed

                </span>

                @break

            @case('Refunded')

                <span class="badge bg-secondary">

                    Refunded

                </span>

                @break

            @default

                <span class="badge bg-dark">

                    {{ $order->payment_status }}

                </span>

        @endswitch

        <br>

        <small class="text-muted">

            {{ $order->payment_method }}

        </small>

    </td>

    <td>

        @php

            $statusColor = match($order->order_status){

                'Pending' => 'warning text-dark',

                'Confirmed' => 'info',

                'Packed' => 'primary',

                'Shipped' => 'secondary',

                'Out For Delivery' => 'warning',

                'Delivered' => 'success',

                'Cancelled' => 'danger',

                'Returned' => 'dark',

                default => 'secondary'

            };

        @endphp

        <span class="badge bg-{{ $statusColor }}">

            {{ $order->order_status }}

        </span>

    </td>

    <td>

        @if($order->courier)

            <strong>

                {{ $order->courier }}

            </strong>

            <br>

            <small>

                {{ $order->tracking_number }}

            </small>

            <br>

            @if($order->expected_delivery)

                <small class="text-success">

                    {{ \Carbon\Carbon::parse($order->expected_delivery)->format('d M Y') }}

                </small>

            @endif

        @else

            <span class="text-muted">

                Not Assigned

            </span>

        @endif

    </td>

    <td>

        <div class="dropdown">

            <button

                class="btn btn-outline-primary btn-sm dropdown-toggle"

                data-bs-toggle="dropdown">

                Actions

            </button>

            <ul class="dropdown-menu dropdown-menu-end">

                <li>

                    <a

                        class="dropdown-item"

                        href="{{ route('admin.orders.show',$order) }}">

                        <i class="bi bi-eye"></i>

                        View Details

                    </a>

                </li>

                <li>

                    <a

                        class="dropdown-item"

                        target="_blank"

                        href="{{ route('admin.orders.show',$order) }}">

                        <i class="bi bi-printer"></i>

                        Print

                    </a>

                </li>

                <li>

                    <a

                        class="dropdown-item"

                        target="_blank"

                        href="#">

                        <i class="bi bi-file-earmark-pdf"></i>

                        Invoice PDF

                    </a>

                </li>

                <li><hr class="dropdown-divider"></li>

                <li>

                    <a

                        class="dropdown-item text-danger"

                        href="#">

                        <i class="bi bi-trash"></i>

                        Delete

                    </a>

                </li>

            </ul>

        </div>

    </td>

</tr>

@empty

<tr>

    <td colspan="8" class="text-center py-5">

        <img

            src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png"

            width="90">

        <br><br>

        <h5>No Orders Found</h5>

        <p class="text-muted">

            There are no orders matching your filters.

        </p>

    </td>

</tr>

@endforelse
                </tbody>

            </table>

        </div>

        {{-- Footer --}}

        <div class="card-footer bg-white">

            <div class="row align-items-center">

                <div class="col-md-6">

                    <div class="btn-group">

                        <button
                            class="btn btn-outline-success btn-sm">

                            <i class="bi bi-check2-circle"></i>

                            Mark Selected Delivered

                        </button>

                        <button
                            class="btn btn-outline-primary btn-sm">

                            <i class="bi bi-box-seam"></i>

                            Mark Shipped

                        </button>

                        <button
                            class="btn btn-outline-danger btn-sm">

                            <i class="bi bi-trash"></i>

                            Delete Selected

                        </button>

                    </div>

                </div>

                <div class="col-md-6 text-end">

                    {{ $orders->withQueryString()->links() }}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const selectAll = document.getElementById('selectAll');

    if(selectAll){

        selectAll.addEventListener('change', function(){

            document.querySelectorAll('.order-checkbox').forEach(function(item){

                item.checked = selectAll.checked;

            });

        });

    }

});

</script>

@endpush