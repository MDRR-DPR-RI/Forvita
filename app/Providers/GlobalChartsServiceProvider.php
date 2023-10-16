<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Chart;
use App\Models\Prompt;
use App\Models\Dashboard;
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
        // check if has these schema then sent as global variable. this will prevent error while migration
        if (Schema::hasTable('charts')) {
            $chartData = Chart::all();
            view()->share('charts', $chartData);
        }
        if (Schema::hasTable('prompts')) {
            $prmopts = Prompt::all();
            view()->share('prompts', $prmopts);
        }
        if (Schema::hasTable('dashboards')) {
            $dashboards = Dashboard::where('cluster_id', 1)->get();
            view()->share('dashboards', $dashboards);
        }
    }
}
