@extends('admin.layouts.app')

@section('title','Variant Images')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>Variant Images</h3>

        <a href="{{ route('admin.variant-images.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>

            Upload Images

        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    @forelse($variants as $variant)

        <div class="card shadow mb-4">

            <div class="card-header d-flex justify-content-between align-items-center">

                <div>

                    <strong>{{ $variant->product->name }}</strong>

                    <br>

                    <small>

                        Color :

                        {{ $variant->color ?: 'N/A' }}

                        |

                        Size :

                        {{ $variant->size ?: 'N/A' }}

                        |

                        SKU :

                        {{ $variant->sku }}

                    </small>

                </div>

                <a href="{{ route('admin.variant-images.create',['variant_id'=>$variant->id]) }}"
                   class="btn btn-success btn-sm">

                    <i class="bi bi-upload"></i>

                    Upload More

                </a>

            </div>

            <div class="card-body">

                @if($variant->images->count())

                    <div class="row">

                        @foreach($variant->images as $image)

                            <div class="col-md-2 mb-4">

                                <div class="card">

                                    <img
                                        src="{{ asset('uploads/products/variants/'.$image->image) }}"
                                        class="card-img-top"
                                        style="height:170px;object-fit:cover;">

                                    <div class="card-body text-center">

                                        @if($image->is_primary)

                                            <span class="badge bg-success mb-2">

                                                Primary

                                            </span>

                                            <br>

                                        @endif

                                        <form
                                            action="{{ route('admin.variant-images.destroy',$image->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Delete this image?')">

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                class="btn btn-danger btn-sm">

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="text-center py-4">

                        <p class="text-muted">

                            No Images Uploaded

                        </p>

                        <a href="{{ route('admin.variant-images.create',['variant_id'=>$variant->id]) }}"
                           class="btn btn-primary">

                            Upload Images

                        </a>

                    </div>

                @endif

            </div>

        </div>

    @empty

        <div class="alert alert-warning">

            No Variants Found.

        </div>

    @endforelse

    <div class="mt-4">

        {{ $variants->links() }}

    </div>

</div>

@endsection