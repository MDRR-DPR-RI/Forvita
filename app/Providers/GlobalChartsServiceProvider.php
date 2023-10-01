<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Chart;
use Illuminate\Support\Facades\Schema;

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
        if (Schema::hasTable('charts')) {
            $chartData = Chart::all();
            view()->share('charts', $chartData);
        }
    }
}
