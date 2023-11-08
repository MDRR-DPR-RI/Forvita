<?php

namespace App\Livewire\UserManagement;

use App\Models\Dashboard;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use LivewireUI\Modal\ModalComponent;

class EditPermissions extends ModalComponent
{

    public string $searchDashboardQuery = "";
    public Collection $allDashboards;
    public Collection $selectedDashboards;
    public array $selectedUsersID;

    public function mount()
    {
        $this->allDashboards = Dashboard::all();

        // if only editing one user, get their permissions pre-selected
        if(count($this->selectedUsersID) == 1)
        {
            $userDashboardIDs = Permission::where('user_id', $this->selectedUsersID[0])
                ->pluck('dashboard_id');
            $this->selectedDashboards = Dashboard::whereIn('id', $userDashboardIDs)
                ->get();
        }
    }
    public function searchDashboard()
    {
        $this->allDashboards = Dashboard::where('name', 'LIKE', "%".$this->searchDashboardQuery."%")
            ->orWhereHas('cluster',   function (Builder $query) {
                $query->where('name', 'LIKE', "%".$this->searchDashboardQuery."%");
            })->get();
    }

    public function selectDashboard($dashboardID): void
    {
        $selectedDashboard = Dashboard::where('id', $dashboardID)
            ->get();
        if (!isset($this->selectedDashboards)) {
            $this->selectedDashboards = $selectedDashboard;
        }
        else {
            $this->selectedDashboards = $this->selectedDashboards->merge($selectedDashboard);
        }
    }

    public function deselectDashboard($dashboardID): void
    {
        $selectedDashboard = Dashboard::where('id', $dashboardID)
            ->get();
        $this->selectedDashboards = $this->selectedDashboards->diff($selectedDashboard);
    }

    public function editPermissions()
    {
        foreach($this->selectedUsersID as $userID)
        {
            $user = User::find($userID);
            $deletedPermissions = Permission::where('user_id', $user->id)->delete();
            foreach($this->selectedDashboards as $dashboard)
            {
                $permission = new Permission;
                $permission->user_id = $user->id;
                $permission->dashboard_id = $dashboard->id;
                $permission->save();
            }
        }
        $this->closeModalWithEvents([
            UserListing::class => 'permissionsModified',
        ]);
    }

    public function render()
    {
        $this->allDashboards = $this->allDashboards
            ->sortBy([
                ['cluster_id'],
                ['name'],
            ]);
        return view('livewire.user-management.edit-permissions', [

        ]);
    }
}
