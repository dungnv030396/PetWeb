<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Catalog;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.header',function($view){
            $catalog = new Catalog();
            $catalogs = $catalog->getCatalog([1,2]);
            $view->with('catalogs',$catalogs);
        });
        /*
        view()->composer('header',function($view){
            if(Session('cart')){
                $oldCart= Session::get('cart');
                $cart=new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,
                    'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
        });
        */
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
