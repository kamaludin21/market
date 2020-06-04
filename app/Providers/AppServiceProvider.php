<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Gate;

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
        Gate::define('administrator', function($user) {
            return $user->level == 'administrator';
        });
        
        Gate::define('customer', function($user) {
            return $user->level == 'customer';
        });
    }
}
