<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with([
            'category',
            'subCategory',
            'brand'
        ])->latest()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('status',1)->get();
        $subCategories = SubCategory::where('status',1)->get();
        $brands = Brand::where('status',1)->get();

        return view(
            'admin.products.create',
            compact(
                'categories',
                'subCategories',
                'brands'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'category_id'=>'required|exists:categories,id',

            'sub_category_id'=>'required|exists:sub_categories,id',

            'brand_id'=>'nullable|exists:brands,id',

            'name'=>'required|max:255|unique:products,name',

            'price'=>'required|numeric',

            'sale_price'=>'nullable|numeric',

            'stock'=>'required|integer',

            'description'=>'nullable',

            'thumbnail'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'gallery.*'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status'=>'required',

        ]);

        $thumbnail = null;

        if($request->hasFile('thumbnail')){

            $file = $request->file('thumbnail');

            $thumbnail = time().'_'.$file->getClientOriginalName();

            $file->move(
                public_path('uploads/products'),
                $thumbnail
            );
        }

        // Auto Generate SKU

        $lastProduct = Product::latest('id')->first();

        $nextId = $lastProduct ? $lastProduct->id + 1 : 1;

        $sku = 'SA-' . str_pad($nextId,6,'0',STR_PAD_LEFT);

        $product = Product::create([

            'category_id'=>$request->category_id,

            'sub_category_id'=>$request->sub_category_id,

            'brand_id'=>$request->brand_id,

            'name'=>$request->name,

            'slug'=>Str::slug($request->name),

            'sku'=>$sku,

            'description'=>$request->description,

            'price'=>$request->price,

            'sale_price'=>$request->sale_price,

            'stock'=>$request->stock,

            'thumbnail'=>$thumbnail,

            'featured'=>$request->featured ?? 0,

            'trending'=>$request->trending ?? 0,

            'status'=>$request->status,

        ]);

        if($request->hasFile('gallery')){

            foreach($request->file('gallery') as $key=>$image){

                $imageName=time().'_'.$key.'_'.$image->getClientOriginalName();

                $image->move(
                    public_path('uploads/products/gallery'),
                    $imageName
                );

                ProductImage::create([

                    'product_id'=>$product->id,

                    'image'=>$imageName,

                    'is_primary'=>false,

                    'sort_order'=>$key,

                ]);

            }

        }

        return redirect()
            ->route('admin.products.index')
            ->with('success','Product Added Successfully.');
    }
        public function edit(Product $product)
    {
        $categories = Category::where('status', 1)->get();
        $subCategories = SubCategory::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();

        $product->load('images');

        return view(
            'admin.products.edit',
            compact(
                'product',
                'categories',
                'subCategories',
                'brands'
            )
        );
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([

            'category_id' => 'required|exists:categories,id',

            'sub_category_id' => 'required|exists:sub_categories,id',

            'brand_id' => 'nullable|exists:brands,id',

            'name' => 'required|max:255|unique:products,name,' . $product->id,

            'price' => 'required|numeric',

            'sale_price' => 'nullable|numeric',

            'stock' => 'required|integer',

            'description' => 'nullable',

            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'required',

        ]);

        $thumbnail = $product->thumbnail;

        if ($request->hasFile('thumbnail')) {

            if (
                $product->thumbnail &&
                File::exists(public_path('uploads/products/' . $product->thumbnail))
            ) {
                File::delete(public_path('uploads/products/' . $product->thumbnail));
            }

            $file = $request->file('thumbnail');

            $thumbnail = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/products'),
                $thumbnail
            );
        }

        $product->update([

            'category_id' => $request->category_id,

            'sub_category_id' => $request->sub_category_id,

            'brand_id' => $request->brand_id,

            'name' => $request->name,

            'slug' => Str::slug($request->name),

            // SKU remains unchanged after creation
            'sku' => $product->sku,

            'description' => $request->description,

            'price' => $request->price,

            'sale_price' => $request->sale_price,

            'stock' => $request->stock,

            'thumbnail' => $thumbnail,

            'featured' => $request->featured ?? 0,

            'trending' => $request->trending ?? 0,

            'status' => $request->status,

        ]);

        if ($request->hasFile('gallery')) {

            foreach ($request->file('gallery') as $key => $image) {

                $imageName = time() . '_' . rand(1000, 9999) . '_' . $image->getClientOriginalName();

                $image->move(
                    public_path('uploads/products/gallery'),
                    $imageName
                );

                ProductImage::create([

                    'product_id' => $product->id,

                    'image' => $imageName,

                    'is_primary' => false,

                    'sort_order' => $key,

                ]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product Updated Successfully.');
    }

    public function destroy(Product $product)
    {
        if (
            $product->thumbnail &&
            File::exists(public_path('uploads/products/' . $product->thumbnail))
        ) {
            File::delete(
                public_path('uploads/products/' . $product->thumbnail)
            );
        }

        foreach ($product->images as $image) {

            if (
                File::exists(
                    public_path('uploads/products/gallery/' . $image->image)
                )
            ) {
                File::delete(
                    public_path('uploads/products/gallery/' . $image->image)
                );
            }

            $image->delete();
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product Deleted Successfully.');
    }

    public function show(Product $product)
    {
        return redirect()->route('admin.products.index');
    }

    public function getSubCategories($categoryId)
    {
        $subCategories = SubCategory::where('category_id', $categoryId)
            ->where('status', 1)
            ->get();

        return response()->json($subCategories);
    }
}