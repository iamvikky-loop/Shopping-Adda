<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('home.*', function ($view) {

            $categories = Category::where('status', 1)
                ->with([
                    'subCategories' => function ($query) {
                        $query->where('status', 1);
                    }
                ])
                ->orderBy('name')
                ->get();

            $view->with('categories', $categories);
        });
    }
}