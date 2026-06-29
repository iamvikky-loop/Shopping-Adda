<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::with('category')
            ->latest()
            ->paginate(10);

        return view('admin.sub-categories.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('admin.sub-categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255|unique:sub_categories,name',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required'
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('uploads/sub-categories'), $imageName);
        }

        SubCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'image' => $imageName,
            'status' => $request->status
        ]);

        return redirect()
            ->route('admin.sub-categories.index')
            ->with('success', 'Sub Category Created Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::where('status', 1)
            ->orderBy('name')
            ->get();

        return view(
            'admin.sub-categories.edit',
            compact('subCategory', 'categories')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255|unique:sub_categories,name,' . $subCategory->id,
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required'
        ]);

        $imageName = $subCategory->image;

        if ($request->hasFile('image')) {

            if (
                $subCategory->image &&
                file_exists(public_path('uploads/sub-categories/' . $subCategory->image))
            ) {
                unlink(public_path('uploads/sub-categories/' . $subCategory->image));
            }

            $image = $request->file('image');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('uploads/sub-categories'), $imageName);
        }

        $subCategory->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'image' => $imageName,
            'status' => $request->status
        ]);

        return redirect()
            ->route('admin.sub-categories.index')
            ->with('success', 'Sub Category Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        if (
            $subCategory->image &&
            file_exists(public_path('uploads/sub-categories/' . $subCategory->image))
        ) {
            unlink(public_path('uploads/sub-categories/' . $subCategory->image));
        }

        $subCategory->delete();

        return redirect()
            ->route('admin.sub-categories.index')
            ->with('success', 'Sub Category Deleted Successfully.');
    }
}