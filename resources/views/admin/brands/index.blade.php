@extends('admin.layouts.app')

@section('title', 'Brands')

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
                Brands
            </h4>

            <a href="{{ route('admin.brands.create') }}"
               class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Brand
            </a>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                <tr>
                    <th width="70">ID</th>
                    <th width="100">Logo</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th width="170">Action</th>
                </tr>

                </thead>

                <tbody>

                @forelse($brands as $brand)

                    <tr>

                        <td>{{ $brand->id }}</td>

                        <td>

                            @if($brand->logo)

                                <img src="{{ asset($brand->logo) }}"
                                     width="60"
                                     height="60"
                                     class="rounded border">

                            @else

                                <span class="text-muted">No Image</span>

                            @endif

                        </td>

                        <td>{{ $brand->name }}</td>

                        <td>{{ $brand->slug }}</td>

                        <td>

                            @if($brand->status)

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

                            <a href="{{ route('admin.brands.edit',$brand) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.brands.destroy',$brand) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Delete this brand?')"
                                    class="btn btn-danger btn-sm">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            No brands found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $brands->links() }}

            </div>

        </div>

    </div>

</div>

@endsection