@extends('admin.layouts.app')

@section('title','Upload Variant Images')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>Upload Variant Images</h3>

        <a href="{{ route('admin.variant-images.index') }}"
           class="btn btn-secondary">

            Back

        </a>

    </div>

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="card shadow">

        <div class="card-body">

            <form
                action="{{ route('admin.variant-images.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="mb-4">

                    <label class="form-label">

                        Product Variant

                    </label>

                    <select
                        name="product_variant_id"
                        class="form-select"
                        required>

                        <option value="">

                            Select Variant

                        </option>

                        @foreach($variants as $variant)

                            <option
                                value="{{ $variant->id }}"
                                {{ old('product_variant_id',$selectedVariant ?? '')==$variant->id?'selected':'' }}>

                                {{ $variant->product->name }}
                                |

                                {{ $variant->color ?: 'No Color' }}

                                |

                                {{ $variant->size ?: 'No Size' }}

                                |

                                {{ $variant->sku }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-4">

                    <label class="form-label">

                        Upload Images

                    </label>

                    <input
                        type="file"
                        name="images[]"
                        multiple
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                        required>

                    <small class="text-muted">

                        You can select multiple images.

                    </small>

                </div>

                <button class="btn btn-primary">

                    Upload Images

                </button>

            </form>

        </div>

    </div>

</div>

@endsection