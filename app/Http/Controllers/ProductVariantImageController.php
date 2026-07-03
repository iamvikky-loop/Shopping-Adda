<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\ProductVariantImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductVariantImageController extends Controller
{
    /**
     * Display a listing of variant images grouped by variant.
     */
    public function index()
    {
        $variants = ProductVariant::with([
            'product',
            'images'
        ])->latest()->paginate(10);

        return view(
            'admin.variant-images.index',
            compact('variants')
        );
    }

    /**
     * Show upload form.
     */
    public function create(Request $request)
    {
        $variants = ProductVariant::with('product')->get();

        $selectedVariant = $request->variant_id;

        return view(
            'admin.variant-images.create',
            compact(
                'variants',
                'selectedVariant'
            )
        );
    }

    /**
     * Store uploaded images.
     */
    public function store(Request $request)
    {
        $request->validate([

            'product_variant_id' => 'required|exists:product_variants,id',

            'images' => 'required',

            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',

        ]);

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $index => $image) {

                $imageName =
                    time().'_'.
                    rand(1000,9999).'_'.
                    $image->getClientOriginalName();

                $image->move(
                    public_path('uploads/products/variants'),
                    $imageName
                );

                ProductVariantImage::create([

                    'product_variant_id' => $request->product_variant_id,

                    'image' => $imageName,

                    'is_primary' => $index == 0,

                    'sort_order' => $index,

                ]);
            }
        }

        return redirect()
            ->route('admin.variant-images.index')
            ->with(
                'success',
                'Variant Images Uploaded Successfully.'
            );
    }

    /**
     * Display one variant.
     */
    public function show(ProductVariantImage $variantImage)
    {
        return redirect()
            ->route('admin.variant-images.index');
    }

    /**
     * Edit not required.
     */
    public function edit(ProductVariantImage $variantImage)
    {
        return redirect()
            ->route('admin.variant-images.index');
    }

    /**
     * Update not required.
     */
    public function update(
        Request $request,
        ProductVariantImage $variantImage
    ) {
        return redirect()
            ->route('admin.variant-images.index');
    }

    /**
     * Delete image.
     */
    public function destroy(ProductVariantImage $variantImage)
    {
        $path = public_path(
            'uploads/products/variants/' .
            $variantImage->image
        );

        if (File::exists($path)) {

            File::delete($path);
        }

        $variantImage->delete();

        return back()->with(
            'success',
            'Image Deleted Successfully.'
        );
    }
}