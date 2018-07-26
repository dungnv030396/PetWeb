<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Catalog;
use App\Cart;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.header', function ($view) {
            $catalog = new Catalog();
            $catalogs = $catalog->getAllCatalog();
            $view->with('catalogs', $catalogs);
        });
        view()->composer('layouts.header', function ($view) {
            if (Session('cart')) {
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart' => Session::get('cart'), 'cart_products' => $cart->items,
                    'amount' => $cart->totalPrice, 'totalQuantity' => $cart->totalQuantity]);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
