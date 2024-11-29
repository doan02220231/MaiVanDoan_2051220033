<?php

namespace App\Providers;
use App\Models\Product;
use App\Models\Satistic;
use App\Models\Visitors;
use App\Models\Post;
use App\Models\Order;
use App\Models\Customer;

use Illuminate\Support\ServiceProvider;

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
        view()->composer('*', function ($view) {
            $price_min = Product::min('product_price');
            $price_max = Product::max('product_price');
            $products = Product::all()->count();
            $posts = Post::all()->count();
            $orders = Order::all()->count();
            $customers = Customer::all()->count();
            $view-> with(compact('price_min','price_max','products','posts','orders','customers'))
            ;
        });
    }
}
