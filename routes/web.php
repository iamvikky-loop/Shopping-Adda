<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home.index');
})->name('home');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::view('/dashboard', 'dashboard')->name('dashboard');

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

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('categories', CategoryController::class);

        Route::resource('sub-categories', SubCategoryController::class);

        Route::resource('brands', BrandController::class);

        Route::resource('products', ProductController::class);
        Route::get('/get-sub-categories/{category}', [ProductController::class, 'getSubCategories'])
    ->name('products.subcategories');
    });

require __DIR__.'/auth.php';