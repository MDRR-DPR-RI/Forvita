<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        Gate::define('admin', function (User $user) {
            // return auth()->user()->role->name !== "Admin";
            //or
            return $user->role->name === "Admin";
        });

        Gate::define('user', function (User $user) {
            // return auth()->user()->role->name !== "Admin";
            //or
            return $user->role->name === "User" || $user->role->name === "Admin" ;
        });
    }
}
