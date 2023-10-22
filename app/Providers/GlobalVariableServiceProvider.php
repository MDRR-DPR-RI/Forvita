<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Chart;
use App\Models\Prompt;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class GlobalVariableServiceProvider extends ServiceProvider
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
        view()->composer('*', function ($view) {
            if (Schema::hasTable('dashboards') && auth()->check()) {
                $cluster_id = session('cluster_id');
                $dashboard_ids = session('dashboard_ids');
                if (auth()->user()->role->name == 'Admin') {
                    $dashboards = Dashboard::where('cluster_id', $cluster_id)->get();
                } else {
                    $dashboards = Dashboard::where('cluster_id', $cluster_id)
                        ->whereIn('id', $dashboard_ids)
                        ->get();
                }
                $view->with('dashboards', $dashboards);
            }
        });
        // check if has these schema then sent as global variable. this will prevent error while migration
        if (Schema::hasTable('charts')) {
            $chartData = Chart::all();
            view()->share('charts', $chartData);
        }
        // check if has these schema then sent as global variable. this will prevent error while migration
        if (Schema::hasTable('prompts')) {
            $prmopts = Prompt::all();
            view()->share('prompts', $prmopts);
        }
    }
}
