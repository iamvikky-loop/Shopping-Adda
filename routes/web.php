<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Home Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Home\ProductController as HomeProductController;
use App\Http\Controllers\Home\CategoryController as HomeCategoryController;
use App\Http\Controllers\Home\SearchController;

/*
|--------------------------------------------------------------------------
| Customer Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Customer\AddressController;

/*
|--------------------------------------------------------------------------
| Admin Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderStatusController;
use App\Http\Controllers\Admin\OrderPaymentController;
use App\Http\Controllers\Admin\OrderTrackingController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ShippingSettingController;

/*
|--------------------------------------------------------------------------
| Product Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ProductVariantImageController;
use App\Http\Controllers\ProductAttributeController;
use App\Http\Controllers\ProductAttributeValueController;
use App\Http\Controllers\VariantGeneratorController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/category/{slug}', [HomeCategoryController::class, 'show'])
    ->name('category.show');

Route::get('/product/{slug}', [HomeProductController::class, 'show'])
    ->name('product.show');

Route::get('/search', [SearchController::class, 'index'])
    ->name('search');

/*
|--------------------------------------------------------------------------
| User Dashboard
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::view('/dashboard', 'dashboard')
        ->name('dashboard');

});

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |-----------------------------------
    | Addresses
    |-----------------------------------
    */

    Route::resource('addresses', AddressController::class);

    Route::post('/addresses/{address}/default',
        [AddressController::class, 'setDefault'])
        ->name('addresses.default');

    /*
    |-----------------------------------
    | Cart
    |-----------------------------------
    */

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

    /*
    |-----------------------------------
    | Checkout
    |-----------------------------------
    */

    Route::get('/checkout',
        [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout/place-order',
        [CheckoutController::class, 'placeOrder'])
        ->name('checkout.placeOrder');

    /*
    |-----------------------------------
    | Temporary Order Success
    |-----------------------------------
    */

    Route::get('/orders/{order}', function ($order) {

        return "<h2>✅ Order Placed Successfully</h2>
                <h4>Order ID : {$order}</h4>";

    })->name('orders.show');

});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        | Dashboard
        */

        Route::get('/dashboard',
            [DashboardController::class,'index'])
            ->name('dashboard');

        /*
        | Categories
        */

        Route::resource('categories', CategoryController::class);

        /*
        | Sub Categories
        */

        Route::resource('sub-categories', SubCategoryController::class);

        /*
        | Brands
        */

        Route::resource('brands', BrandController::class);

        /*
        | Products
        */

        Route::get(
            'get-sub-categories/{category}',
            [ProductController::class,'getSubCategories']
        )->name('products.subcategories');

        Route::resource('products', ProductController::class);

        /*
        | Product Variants
        */

        Route::resource(
            'product-variants',
            ProductVariantController::class
        );

        /*
        | Variant Images
        */

        Route::resource(
            'variant-images',
            ProductVariantImageController::class
        );

        /*
        | Product Attributes
        */

        Route::resource(
            'product-attributes',
            ProductAttributeController::class
        );

        Route::resource(
            'product-attribute-values',
            ProductAttributeValueController::class
        );

        /*
        | Shopify Variant Generator
        */

        Route::post(
            'products/{product}/generate-variants',
            [VariantGeneratorController::class,'generate']
        )->name('products.generate-variants');

        /*
        | Orders
        */

        Route::resource('orders', OrderController::class);

        Route::patch(
            'orders/{order}/status',
            [OrderStatusController::class,'update']
        )->name('orders.status');

        Route::patch(
            'orders/{order}/payment',
            [OrderPaymentController::class,'update']
        )->name('orders.payment');

        Route::patch(
            'orders/{order}/tracking',
            [OrderTrackingController::class,'update']
        )->name('orders.tracking');

        Route::patch(
            'orders/{order}/note',
            [OrderTrackingController::class,'note']
        )->name('orders.note');

        /*
        | Shipping
        */

        Route::get('/shipping',
            [ShippingSettingController::class,'index'])
            ->name('shipping.index');

        Route::post('/shipping',
            [ShippingSettingController::class,'update'])
            ->name('shipping.update');

        /*
        | Invoice
        */

        Route::get(
            'orders/{order}/invoice',
            [InvoiceController::class,'show']
        )->name('orders.invoice');

        Route::get(
            'orders/{order}/invoice/print',
            [InvoiceController::class,'print']
        )->name('orders.invoice.print');

        Route::get(
            'orders/{order}/invoice/pdf',
            [InvoiceController::class,'pdf']
        )->name('orders.invoice.pdf');

    });

require __DIR__.'/auth.php';