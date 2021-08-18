<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
        

        //  else{
        //     View::share('userType', "NA");
        //  }
        //  View::share('userType', $userType);

         view()->composer('*', function ($view) 
    {
        // $userType="NA";

         if(Auth::check()){
             $userType=Auth::user()->userable_type;
             $view->with('userType', Auth::user()->userable_type ); 
         }

        //...with this variable
         
    });  


        Schema::defaultStringLength(191);
        
    }
}
