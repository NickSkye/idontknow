<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {




//        view()->composer('*', function ($view)
//        {
//            $use_loc = DB::table('profileinfo')->select('use_loc')->where('username', Auth::user()->username)->first();
//
//            //...with this variable
//
//            $view->with('use_location', $use_loc );
//        });


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
