<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display Homepage
     */
    public function index()
    {
        // Active Categories
        $categories = Category::where('status', 1)
            ->orderBy('name')
            ->get();

        // Featured Products
        $featuredProducts = Product::where('status', 1)
            ->where('featured', 1)
            ->latest()
            ->take(8)
            ->get();

        // Trending Products
        $trendingProducts = Product::where('status', 1)
            ->where('trending', 1)
            ->latest()
            ->take(8)
            ->get();

        // Latest Products
        $latestProducts = Product::where('status', 1)
            ->latest()
            ->take(12)
            ->get();

        return view('home.index', compact(
            'categories',
            'featuredProducts',
            'trendingProducts',
            'latestProducts'
        ));
    }
}