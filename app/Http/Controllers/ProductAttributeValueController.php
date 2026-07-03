<?php

namespace App\Http\Controllers;

use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use Illuminate\Http\Request;

class ProductAttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $values = ProductAttributeValue::with('attribute')
                    ->latest()
                    ->paginate(10);

        return view('admin.product-attribute-values.index', compact('values'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attributes = ProductAttribute::where('status',1)->get();

        return view('admin.product-attribute-values.create', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'attribute_id' => 'required|exists:product_attributes,id',
            'value'        => 'required|max:255',
            'status'       => 'required'
        ]);

        ProductAttributeValue::create([
            'attribute_id' => $request->attribute_id,
            'value'        => $request->value,
            'status'       => $request->status,
        ]);

        return redirect()
            ->route('admin.product-attribute-values.index')
            ->with('success', 'Attribute Value Created Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductAttributeValue $productAttributeValue)
    {
        return redirect()->route('admin.product-attribute-values.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductAttributeValue $productAttributeValue)
    {
        $attributes = ProductAttribute::where('status',1)->get();

        return view(
            'admin.product-attribute-values.edit',
            compact('productAttributeValue','attributes')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductAttributeValue $productAttributeValue)
    {
        $request->validate([
            'attribute_id' => 'required|exists:product_attributes,id',
            'value'        => 'required|max:255',
            'status'       => 'required'
        ]);

        $productAttributeValue->update([
            'attribute_id' => $request->attribute_id,
            'value'        => $request->value,
            'status'       => $request->status,
        ]);

        return redirect()
            ->route('admin.product-attribute-values.index')
            ->with('success', 'Attribute Value Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductAttributeValue $productAttributeValue)
    {
        $productAttributeValue->delete();

        return redirect()
            ->route('admin.product-attribute-values.index')
            ->with('success', 'Attribute Value Deleted Successfully.');
    }
}