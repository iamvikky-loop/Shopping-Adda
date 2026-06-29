<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(10);

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands,name',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $brand = new Brand();

        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->description = $request->description;
        $brand->status = $request->status;

        if ($request->hasFile('logo')) {

            $image = $request->file('logo');

            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->move(public_path('uploads/brands'), $imageName);

            $brand->logo = 'uploads/brands/'.$imageName;
        }

        $brand->save();

        return redirect()
            ->route('admin.brands.index')
            ->with('success','Brand created successfully.');
    }

    public function show(Brand $brand)
    {
        //
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|unique:brands,name,'.$brand->id,
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->description = $request->description;
        $brand->status = $request->status;

        if ($request->hasFile('logo')) {

            if ($brand->logo && File::exists(public_path($brand->logo))) {
                File::delete(public_path($brand->logo));
            }

            $image = $request->file('logo');

            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->move(public_path('uploads/brands'), $imageName);

            $brand->logo = 'uploads/brands/'.$imageName;
        }

        $brand->save();

        return redirect()
            ->route('admin.brands.index')
            ->with('success','Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        if ($brand->logo && File::exists(public_path($brand->logo))) {
            File::delete(public_path($brand->logo));
        }

        $brand->delete();

        return redirect()
            ->route('admin.brands.index')
            ->with('success','Brand deleted successfully.');
    }
}