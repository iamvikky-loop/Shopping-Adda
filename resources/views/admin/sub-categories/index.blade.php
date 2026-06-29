@extends('admin.layouts.app')

@section('title', 'Sub Categories')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Sub Categories</h3>

    <a href="{{ route('admin.sub-categories.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Sub Category
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card shadow border-0">

    <div class="card-body">

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-dark">

                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th width="180">Action</th>
                </tr>

            </thead>

            <tbody>

                @forelse($subCategories as $subCategory)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>

                        @if($subCategory->image)

                            <img src="{{ asset('uploads/sub-categories/'.$subCategory->image) }}"
                                 width="60"
                                 height="60"
                                 class="rounded">

                        @else

                            No Image

                        @endif

                    </td>

                    <td>{{ $subCategory->category->name ?? '-' }}</td>

                    <td>{{ $subCategory->name }}</td>

                    <td>{{ $subCategory->slug }}</td>

                    <td>

                        @if($subCategory->status)

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

                        <a href="{{ route('admin.sub-categories.edit',$subCategory->id) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('admin.sub-categories.destroy',$subCategory->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Delete this sub category?')"
                                class="btn btn-sm btn-danger">

                                Delete

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7" class="text-center">

                        No Sub Categories Found

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        {{ $subCategories->links() }}

    </div>

</div>

@endsection