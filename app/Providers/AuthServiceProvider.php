<?php

namespace App\Providers;

use App\Models\Dashboard;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Gate for view dashboard authorization
        Gate::define('show-dashboard', function (User $user, Dashboard $dashboard) {
            if ($user->role->name === 'Admin') {
                return true;
            }
            return Permission::where('user_id', $user->id)
                ->where('dashboard_id', $dashboard->id)
                ->get()->isNotEmpty();
        });
    }
}
