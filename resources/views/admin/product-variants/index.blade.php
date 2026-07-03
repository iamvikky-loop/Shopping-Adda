@extends('admin.layouts.app')

@section('title', 'Product Variants')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Product Variants</h3>

        <a href="{{ route('admin.product-variants.create') }}"
           class="btn btn-primary">
            + Add Variant
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                <tr>

                    <th>#</th>

                    <th>Product</th>

                    <th>Color</th>

                    <th>Size</th>

                    <th>SKU</th>

                    <th>Price</th>

                    <th>Stock</th>

                    <th>Status</th>

                    <th width="150">Action</th>

                </tr>

                </thead>

                <tbody>

                @forelse($variants as $variant)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $variant->product->name }}</td>

                        <td>{{ $variant->color ?? '-' }}</td>

                        <td>{{ $variant->size ?? '-' }}</td>

                        <td>{{ $variant->sku }}</td>

                        <td>₹{{ number_format($variant->price,2) }}</td>

                        <td>{{ $variant->stock }}</td>

                        <td>

                            @if($variant->status)

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Inactive
                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('admin.product-variants.edit',$variant) }}"
                               class="btn btn-sm btn-warning">

                                Edit

                            </a>

                            <form action="{{ route('admin.product-variants.destroy',$variant) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this variant?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9" class="text-center">

                            No Variants Found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            {{ $variants->links() }}

        </div>

    </div>

</div>

@endsection