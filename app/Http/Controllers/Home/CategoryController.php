<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $products = $category->products()
            ->where('status', 1)
            ->latest()
            ->paginate(12);

        return view('home.category.show', compact(
            'category',
            'products'
        ));
    }
}