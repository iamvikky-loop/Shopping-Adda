<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductAttribute;
use App\Models\ProductVariantAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variants = ProductVariant::with([
            'product',
            'attributes.attribute',
            'attributes.value'
        ])
        ->latest()
        ->paginate(10);

        return view('admin.product-variants.index', compact('variants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $products = Product::where('status', 1)->get();

        $attributes = ProductAttribute::with('values')
            ->where('status', 1)
            ->get();

        $selectedProduct = $request->product_id;

        return view(
            'admin.product-variants.create',
            compact(
                'products',
                'selectedProduct',
                'attributes'
            )
        );
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color' => 'nullable|string|max:100',
            'size' => 'nullable|string|max:100',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        $lastVariant = ProductVariant::latest('id')->first();

        $nextId = $lastVariant ? $lastVariant->id + 1 : 1;

        $sku = 'VAR-' . str_pad($nextId, 6, '0', STR_PAD_LEFT);

        $variant = ProductVariant::create([

            'product_id' => $request->product_id,
            'color' => $request->color,
            'size' => $request->size,
            'sku' => $sku,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'status' => $request->status,

        ]);

        if ($request->has('attribute_value')) {

            foreach ($request->attribute_value as $attributeId => $valueId) {

                if (!empty($valueId)) {

                    ProductVariantAttribute::create([

                        'product_variant_id' => $variant->id,
                        'product_attribute_id' => $attributeId,
                        'product_attribute_value_id' => $valueId,

                    ]);
                }
            }
        }

        return redirect()
            ->route('admin.products.show', $request->product_id)
            ->with('success', 'Variant Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariant $productVariant)
    {
        return redirect()->route(
            'admin.products.show',
            $productVariant->product_id
        );
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit(ProductVariant $productVariant)
    {
        $products = Product::where('status', 1)->get();

        $attributes = ProductAttribute::with('values')
            ->where('status', 1)
            ->get();

        $selectedValues = ProductVariantAttribute::where(
            'product_variant_id',
            $productVariant->id
        )->pluck(
            'product_attribute_value_id',
            'product_attribute_id'
        );

        return view(
            'admin.product-variants.edit',
            compact(
                'productVariant',
                'products',
                'attributes',
                'selectedValues'
            )
        );
    }

    /**
     * Update the resource.
     */
    public function update(Request $request, ProductVariant $productVariant)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color' => 'nullable|string|max:100',
            'size' => 'nullable|string|max:100',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        $productVariant->update([

            'product_id' => $request->product_id,
            'color' => $request->color,
            'size' => $request->size,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'status' => $request->status,

        ]);

        ProductVariantAttribute::where(
            'product_variant_id',
            $productVariant->id
        )->delete();

        if ($request->has('attribute_value')) {

            foreach ($request->attribute_value as $attributeId => $valueId) {

                if (!empty($valueId)) {

                    ProductVariantAttribute::create([

                        'product_variant_id' => $productVariant->id,
                        'product_attribute_id' => $attributeId,
                        'product_attribute_value_id' => $valueId,

                    ]);
                }
            }
        }

        return redirect()
            ->route('admin.products.show', $productVariant->product_id)
            ->with('success', 'Variant Updated Successfully.');
    }

    /**
     * Remove the resource.
     */
    public function destroy(ProductVariant $productVariant)
    {
        $productId = $productVariant->product_id;

        ProductVariantAttribute::where(
            'product_variant_id',
            $productVariant->id
        )->delete();

        $productVariant->delete();

        return redirect()
            ->route('admin.products.show', $productId)
            ->with('success', 'Variant Deleted Successfully.');
    }
}