<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->q;

        $products = Product::with('category','brand')
            ->where('status',1)
            ->when($search,function($query) use ($search){

                $query->where(function($q) use ($search){

                    $q->where('name','LIKE',"%{$search}%")
                      ->orWhere('slug','LIKE',"%{$search}%")
                      ->orWhere('sku','LIKE',"%{$search}%");

                });

            })
            ->latest()
            ->paginate(12);

        return view('home.search.index',compact('products','search'));
    }
}