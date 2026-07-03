<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 1)
            ->with([
                'category',
                'subCategory',
                'brand',
                'images',
                'variants.variantAttributes.attribute',
                'variants.variantAttributes.value',
            ])
            ->firstOrFail();

        // Related Products
        $relatedProducts = Product::where('status', 1)
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->latest()
            ->take(4)
            ->get();

        return view('home.product.show', compact(
            'product',
            'relatedProducts'
        ));
    }
}