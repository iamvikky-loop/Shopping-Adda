<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Home\ProductController as HomeProductController;
use App\Http\Controllers\Home\SearchController;
use App\Http\Controllers\Home\CategoryController as HomeCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\VariantGeneratorController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ProductVariantImageController;
use App\Http\Controllers\ProductAttributeController;
use App\Http\Controllers\ProductAttributeValueController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| Product Details
|--------------------------------------------------------------------------
*/
Route::get('/category/{slug}', [HomeCategoryController::class, 'show'])
    ->name('category.show');
    
Route::get('/product/{slug}', [HomeProductController::class, 'show'])
    ->name('product.show');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::view('/dashboard', 'dashboard')
        ->name('dashboard');

});

        Route::get('/search', [SearchController::class, 'index'])
    ->name('search');
/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart', [CartController::class, 'store'])
        ->name('cart.store');

    Route::put('/cart/{cartItem}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])
        ->name('cart.destroy');

    Route::delete('/cart', [CartController::class, 'clear'])
        ->name('cart.clear');

});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        Route::resource('categories', CategoryController::class);

        /*
        |--------------------------------------------------------------------------
        | Sub Categories
        |--------------------------------------------------------------------------
        */

        Route::resource('sub-categories', SubCategoryController::class);

        /*
        |--------------------------------------------------------------------------
        | Brands
        |--------------------------------------------------------------------------
        */

        Route::resource('brands', BrandController::class);

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/get-sub-categories/{category}',
            [ProductController::class, 'getSubCategories']
        )->name('products.subcategories');

        Route::resource('products', ProductController::class);

        /*
        |--------------------------------------------------------------------------
        | Product Variants
        |--------------------------------------------------------------------------
        */

        Route::resource('product-variants', ProductVariantController::class);

        /*
        |--------------------------------------------------------------------------
        | Product Variant Images
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'variant-images',
            ProductVariantImageController::class
        );

        /*
        |--------------------------------------------------------------------------
        | Product Attributes
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'product-attributes',
            ProductAttributeController::class
        );

        /*
        |--------------------------------------------------------------------------
        | Product Attribute Values
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'product-attribute-values',
            ProductAttributeValueController::class
        );

        /*
        |--------------------------------------------------------------------------
        | Shopify Variant Generator
        |--------------------------------------------------------------------------
        */

        Route::post(
            'products/{product}/generate-variants',
            [VariantGeneratorController::class, 'generate']
        )->name('products.generate-variants');

    });

require __DIR__.'/auth.php';