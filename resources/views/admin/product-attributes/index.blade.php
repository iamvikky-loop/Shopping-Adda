@extends('admin.layouts.app')

@section('title', 'Product Attributes')

@section('content')

<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                Product Attributes
            </h4>

            <a href="{{ route('admin.product-attributes.create') }}"
               class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                Add Attribute
            </a>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>

                        <th width="70">#</th>

                        <th>Name</th>

                        <th>Status</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($attributes as $attribute)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $attribute->name }}</td>

                        <td>

                            @if($attribute->status)

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

                            <a href="{{ route('admin.product-attributes.edit',$attribute->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil"></i>

                            </a>

                            <form action="{{ route('admin.product-attributes.destroy',$attribute->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Delete this attribute?')"
                                    class="btn btn-danger btn-sm">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center">

                            No Attributes Found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $attributes->links() }}

            </div>

        </div>

    </div>

</div>

@endsection