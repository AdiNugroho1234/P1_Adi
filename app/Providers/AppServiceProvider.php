<?php



namespace App\Providers;



use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\View;



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

        View::composer('*', function ($view) {

            $cartItems = [];



            if (Auth::check()) {

                $cartItems = DB::table('cart')

                    ->where('user_id', Auth::id())

                    ->get();
            }



            $totalCartItems = collect($cartItems)->sum('quantity');



            $subtotal = collect($cartItems)->sum(function ($item) {

                return $item->harga * $item->quantity;
            });



            $view->with([

                'cartItems' => $cartItems,

                'totalCartItems' => $totalCartItems,

                'subtotal' => $subtotal

            ]);
        });
    }
}
