@extends('admin.layouts.app')

@section('title', 'Product Attribute Values')

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
                Product Attribute Values
            </h4>

            <a href="{{ route('admin.product-attribute-values.create') }}"
               class="btn btn-primary">

                <i class="bi bi-plus-circle"></i>
                Add Attribute Value

            </a>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>

                        <th width="60">#</th>

                        <th>Attribute</th>

                        <th>Value</th>

                        <th>Status</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($values as $value)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $value->attribute->name }}</td>

                        <td>{{ $value->value }}</td>

                        <td>

                            @if($value->status)

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

                            <a href="{{ route('admin.product-attribute-values.edit',$value->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil"></i>

                            </a>

                            <form action="{{ route('admin.product-attribute-values.destroy',$value->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this value?')">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" class="text-center">

                            No Attribute Values Found.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $values->links() }}

            </div>

        </div>

    </div>

</div>

@endsection