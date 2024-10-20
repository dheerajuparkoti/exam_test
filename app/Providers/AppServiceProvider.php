<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

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
        // Share the username variable with all views
        view()->composer('*', function ($view) {
            $user = Auth::user();
            $view->with([
                'user_id'=>$user? $user->id:null,
                'username' => $user ? $user->name : 'Guest',
                'email' => $user ? $user->email : null,
            ]);
        });
    }
}
