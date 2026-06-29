@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Products</h2>

        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Add Product
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <div class="card shadow">

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>#</th>

                        <th>Image</th>

                        <th>Name</th>

                        <th>Category</th>

                        <th>Sub Category</th>

                        <th>Brand</th>

                        <th>SKU</th>

                        <th>Price</th>

                        <th>Sale Price</th>

                        <th>Stock</th>

                        <th>Status</th>

                        <th width="170">Action</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($products as $product)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>

                            @if($product->image)

                                <img src="{{ asset('uploads/products/'.$product->image) }}"
                                     width="60"
                                     height="60"
                                     style="object-fit:cover;border-radius:5px;">

                            @else

                                <span class="text-muted">No Image</span>

                            @endif

                        </td>

                        <td>{{ $product->name }}</td>

                        <td>{{ $product->category->name ?? '-' }}</td>

                        <td>{{ $product->subCategory->name ?? '-' }}</td>

                        <td>{{ $product->brand->name ?? '-' }}</td>

                        <td>{{ $product->sku }}</td>

                        <td>₹{{ $product->price }}</td>

                        <td>

                            @if($product->sale_price)

                                ₹{{ $product->sale_price }}

                            @else

                                -

                            @endif

                        </td>

                        <td>{{ $product->stock }}</td>

                        <td>

                            @if($product->status)

                                <span class="badge bg-success">Active</span>

                            @else

                                <span class="badge bg-danger">Inactive</span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('admin.products.edit',$product->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('admin.products.destroy',$product->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Delete this product?')"
                                    class="btn btn-danger btn-sm">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="12" class="text-center">

                            No Products Found

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $products->links() }}

            </div>

        </div>

    </div>

</div>

@endsection