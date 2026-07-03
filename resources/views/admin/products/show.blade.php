@extends('admin.layouts.app')

@section('title', 'Product Details')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Product Details</h2>

    <div>
        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">
            Edit Product
        </a>

        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>
</div>

<div class="card shadow">

    <div class="card-body">

        <div class="row">

            <div class="col-md-4">

                @if($product->thumbnail)

                    <img src="{{ asset('uploads/products/'.$product->thumbnail) }}"
                         class="img-fluid rounded border">

                @else

                    <img src="https://via.placeholder.com/400x400?text=No+Image"
                         class="img-fluid rounded border">

                @endif

            </div>

            <div class="col-md-8">

                <table class="table table-bordered">

                    <tr>
                        <th width="220">Product Name</th>
                        <td>{{ $product->name }}</td>
                    </tr>

                    <tr>
                        <th>SKU</th>
                        <td>{{ $product->sku }}</td>
                    </tr>

                    <tr>
                        <th>Category</th>
                        <td>{{ $product->category->name ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Sub Category</th>
                        <td>{{ $product->subCategory->name ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Brand</th>
                        <td>{{ $product->brand->name ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Price</th>
                        <td>₹{{ number_format($product->price,2) }}</td>
                    </tr>

                    <tr>
                        <th>Sale Price</th>
                        <td>
                            {{ $product->sale_price ? '₹'.number_format($product->sale_price,2) : '-' }}
                        </td>
                    </tr>

                    <tr>
                        <th>Stock</th>
                        <td>{{ $product->stock }}</td>
                    </tr>

                    <tr>
                        <th>Featured</th>
                        <td>
                            @if($product->featured)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Trending</th>
                        <td>
                            @if($product->trending)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            @if($product->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                    </tr>

                </table>

            </div>

        </div>

        <hr>

        <h4>Description</h4>

        <div class="border rounded p-3 mb-4">
            {!! nl2br(e($product->description)) !!}
        </div>

        <hr>

        <h4>Gallery Images</h4>

        <div class="row">

            @forelse($product->images as $image)

                <div class="col-md-2 mb-3">

                    <img src="{{ asset('uploads/products/gallery/'.$image->image) }}"
                         class="img-fluid rounded border">

                </div>

            @empty

                <div class="col-12">
                    <div class="alert alert-secondary">
                        No gallery images available.
                    </div>
                </div>

            @endforelse

        </div>

        <hr>

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h4 class="mb-0">Variants</h4>

            <a href="{{ route('admin.product-variants.create',['product_id'=>$product->id]) }}"
               class="btn btn-primary">

                + Add Variant

            </a>

        </div>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">
    <tr>
        <th>#</th>
        <th>Attributes</th>
        <th>SKU</th>
        <th>Price</th>
        <th>Sale Price</th>
        <th>Stock</th>
        <th>Status</th>
        <th width="180">Action</th>
    </tr>
</thead>

<tbody>

@forelse($product->variants as $variant)

<tr>

    <td>{{ $loop->iteration }}</td>

    <td>

        @if($variant->attributes->count())

            @foreach($variant->attributes as $attribute)

                <span class="badge bg-primary mb-1">

                    {{ $attribute->attribute->name }}
                    :
                    {{ $attribute->value->value }}

                </span>

                <br>

            @endforeach

        @else

            <span class="text-muted">No Attributes</span>

        @endif

    </td>

    <td>{{ $variant->sku }}</td>

    <td>
        ₹{{ number_format($variant->price,2) }}
    </td>

    <td>

        {{ $variant->sale_price
            ? '₹'.number_format($variant->sale_price,2)
            : '-' }}

    </td>

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

        <a href="{{ route('admin.product-variants.edit',$variant->id) }}"
           class="btn btn-warning btn-sm">

            Edit

        </a>

        <form
            action="{{ route('admin.product-variants.destroy',$variant->id) }}"
            method="POST"
            class="d-inline">

            @csrf
            @method('DELETE')

            <button
                class="btn btn-danger btn-sm"
                onclick="return confirm('Delete Variant?')">

                Delete

            </button>

        </form>

    </td>

</tr>

@empty

<tr>

    <td colspan="8" class="text-center">

        No variants found.

    </td>

</tr>

@endforelse

</tbody>

            <tbody>

                @forelse($product->variants as $variant)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $variant->color }}</td>

                        <td>{{ $variant->size }}</td>

                        <td>{{ $variant->sku }}</td>

                        <td>₹{{ number_format($variant->price,2) }}</td>

                        <td>
                            {{ $variant->sale_price ? '₹'.number_format($variant->sale_price,2) : '-' }}
                        </td>

                        <td>{{ $variant->stock }}</td>

                        <td>
                            @if($variant->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>

                        <td>

                            <a href="{{ route('admin.product-variants.edit',$variant->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('admin.product-variants.destroy',$variant->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete Variant?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9" class="text-center">

                            No variants found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection