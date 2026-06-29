@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')

<div class="container-fluid">

    <div class="row mb-3">

        <div class="col-md-6">
            <h2>Categories</h2>
        </div>

        <div class="col-md-6 text-end">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Category
            </a>
        </div>

    </div>

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif

    <div class="card shadow border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th width="70">ID</th>

                            <th width="100">Image</th>

                            <th>Name</th>

                            <th>Slug</th>

                            <th>Status</th>

                            <th width="180">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($categories as $category)

                            <tr>

                                <td>{{ $category->id }}</td>

                                <td>

                                    @if($category->image)

                                        <img
                                            src="{{ asset('uploads/categories/'.$category->image) }}"
                                            width="70"
                                            height="70"
                                            class="rounded border"
                                            style="object-fit:cover;">

                                    @else

                                        <span class="text-muted">No Image</span>

                                    @endif

                                </td>

                                <td>{{ $category->name }}</td>

                                <td>{{ $category->slug }}</td>

                                <td>

                                    @if($category->status)

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

                                    <a href="{{ route('admin.categories.edit',$category->id) }}"
                                       class="btn btn-warning btn-sm">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                    <form
                                        action="{{ route('admin.categories.destroy',$category->id) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Delete this category?')"
                                            class="btn btn-danger btn-sm">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center">

                                    No Categories Found

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $categories->links() }}

            </div>

        </div>

    </div>

</div>

@endsection