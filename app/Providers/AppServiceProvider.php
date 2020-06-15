<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ProductType;
use View;
use App\Cart;
use Session;
use Illuminate\Routing\UrlGenerator;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         \Illuminate\Support\Facades\Schema::defaultStringLength(191);

         View::composer('layouts.header',function($view){
            if (Auth::check()) {
                $user = Auth::user();
                $view->with(['username'=> $user->full_name, 'user_id' => $user->id]);
            }
         });

         View::composer('layouts.header', function ($view) {
            $productTypes = ProductType::all();
            $view->with('productTypes', $productTypes);
        });

        View::composer(['layouts.header', 'page.checkout'], function ($view) {
            if (Session('cart')) {
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'), 'product_cart'=>$cart->items, 'totalPrice'=>$cart->totalPrice, 'totalQuantity'=>$cart->totalQuantity]);
            }
        });

        // View::composer(['layouts.header', 'layouts.dashboard'], function ($view) {
        //     if (Auth::check()) {
        //         $roles = Auth::user()->roles;

        //         $roleId = [];
        //         foreach ($roles as $value) {
        //             $roleId[] = $value['id'];
        //         }

        //         $view->with('roleId', $roleId);
        //     }
        // });

        View::composer('layouts.dashboard',function($view){
            if (Auth::check()) {
                $user = Auth::user();
                $view->with('username', $user->full_name);
            }
         });


    }
}
