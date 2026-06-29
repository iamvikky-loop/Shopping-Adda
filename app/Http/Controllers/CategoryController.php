<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required'
        ]);

        $category = new Category();

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->status = $request->status;

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $filename = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('uploads/categories'), $filename);

            $category->image = $filename;
        }

        $category->save();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category Created Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return redirect()->route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required'
        ]);

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->status = $request->status;

        if ($request->hasFile('image')) {

            if (
                $category->image &&
                File::exists(public_path('uploads/categories/' . $category->image))
            ) {
                File::delete(public_path('uploads/categories/' . $category->image));
            }

            $image = $request->file('image');

            $filename = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('uploads/categories'), $filename);

            $category->image = $filename;
        }

        $category->save();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category Updated Successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(Category $category)
    {
        if (
            $category->image &&
            File::exists(public_path('uploads/categories/' . $category->image))
        ) {
            File::delete(public_path('uploads/categories/' . $category->image));
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category Deleted Successfully.');
    }
}