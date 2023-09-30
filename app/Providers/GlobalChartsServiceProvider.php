<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Chart;
use App\Models\Content;

class GlobalChartsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->share('charts', Chart::all());
    }
}
