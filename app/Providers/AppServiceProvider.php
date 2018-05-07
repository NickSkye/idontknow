<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        if(auth()->check()) {
            view()->composer('layouts.app', function ($view) {
                $notifications = DB::table('notifications')->where('username', Auth::user()->username)->where('seen', false)->get();
                $view->with('notifications', $notifications);
            });
        }
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
