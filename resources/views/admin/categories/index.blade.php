@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                <i class="bi bi-grid text-primary"></i>
                Categories
            </h2>

            <p class="text-muted mb-0">
                Manage product categories, images and SEO settings.
            </p>

        </div>

        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Add Category
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

        </div>

    @endif

    {{-- Search & Filters --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form method="GET" action="{{ route('admin.categories.index') }}">

                <div class="row g-3 align-items-end">

                    <div class="col-lg-4">

                        <label class="form-label small text-muted">Search</label>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Search by name, slug or SEO title">

                    </div>

                    <div class="col-lg-2">

                        <label class="form-label small text-muted">Status</label>

                        <select name="status" class="form-select">

                            <option value="">All Status</option>

                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                    <div class="col-lg-2">

                        <label class="form-label small text-muted">Sort By</label>

                        <select name="sort" class="form-select">

                            <option value="created_at" {{ $sort === 'created_at' ? 'selected' : '' }}>
                                Latest
                            </option>

                            <option value="name" {{ $sort === 'name' ? 'selected' : '' }}>
                                Name
                            </option>

                            <option value="slug" {{ $sort === 'slug' ? 'selected' : '' }}>
                                Slug
                            </option>

                            <option value="status" {{ $sort === 'status' ? 'selected' : '' }}>
                                Status
                            </option>

                        </select>

                    </div>

                    <div class="col-lg-2">

                        <label class="form-label small text-muted">Direction</label>

                        <select name="direction" class="form-select">

                            <option value="desc" {{ $direction === 'desc' ? 'selected' : '' }}>
                                Descending
                            </option>

                            <option value="asc" {{ $direction === 'asc' ? 'selected' : '' }}>
                                Ascending
                            </option>

                        </select>

                    </div>

                    <div class="col-lg-2 d-flex gap-2">

                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-search"></i>
                            Filter
                        </button>

                        <a href="{{ route('admin.categories.index') }}"
                           class="btn btn-outline-secondary"
                           title="Reset">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- Table --}}
    <div class="card shadow border-0">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <span class="text-muted">
                Showing {{ $categories->firstItem() ?? 0 }}–{{ $categories->lastItem() ?? 0 }}
                of {{ $categories->total() }} categories
            </span>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th width="60">ID</th>

                            <th width="80">Image</th>

                            <th>
                                <a href="{{ route('admin.categories.index', array_merge(request()->query(), ['sort' => 'name', 'direction' => $sort === 'name' && $direction === 'asc' ? 'desc' : 'asc'])) }}"
                                   class="text-white text-decoration-none">
                                    Name
                                    @if($sort === 'name')
                                        <i class="bi bi-caret-{{ $direction === 'asc' ? 'up' : 'down' }}-fill"></i>
                                    @endif
                                </a>
                            </th>

                            <th>
                                <a href="{{ route('admin.categories.index', array_merge(request()->query(), ['sort' => 'slug', 'direction' => $sort === 'slug' && $direction === 'asc' ? 'desc' : 'asc'])) }}"
                                   class="text-white text-decoration-none">
                                    Slug
                                    @if($sort === 'slug')
                                        <i class="bi bi-caret-{{ $direction === 'asc' ? 'up' : 'down' }}-fill"></i>
                                    @endif
                                </a>
                            </th>

                            <th>SEO Title</th>

                            <th width="90">
                                <a href="{{ route('admin.categories.index', array_merge(request()->query(), ['sort' => 'status', 'direction' => $sort === 'status' && $direction === 'asc' ? 'desc' : 'asc'])) }}"
                                   class="text-white text-decoration-none">
                                    Status
                                    @if($sort === 'status')
                                        <i class="bi bi-caret-{{ $direction === 'asc' ? 'up' : 'down' }}-fill"></i>
                                    @endif
                                </a>
                            </th>

                            <th width="160">Action</th>

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
                                            width="60"
                                            height="60"
                                            class="rounded border"
                                            style="object-fit:cover;"
                                            alt="{{ $category->name }}">

                                    @else

                                        <span class="text-muted small">No Image</span>

                                    @endif

                                </td>

                                <td class="fw-semibold">{{ $category->name }}</td>

                                <td>
                                    <code class="small">{{ $category->slug }}</code>
                                </td>

                                <td>
                                    <span class="small text-muted">
                                        {{ $category->meta_title ?: '—' }}
                                    </span>
                                </td>

                                <td>

                                    @if($category->status)

                                        <span class="badge bg-success">Active</span>

                                    @else

                                        <span class="badge bg-danger">Inactive</span>

                                    @endif

                                </td>

                                <td>

                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       class="btn btn-warning btn-sm"
                                       title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form
                                        action="{{ route('admin.categories.destroy', $category) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            onclick="return confirm('Delete this category?')"
                                            class="btn btn-danger btn-sm"
                                            title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center py-4 text-muted">

                                    No categories found.

                                    @if(request()->hasAny(['search', 'status']))
                                        <a href="{{ route('admin.categories.index') }}">Clear filters</a>
                                    @endif

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
