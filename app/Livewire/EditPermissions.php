<?php

namespace App\Livewire;

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

    public function searchDashboard()
    {
        $this->allDashboards = Dashboard::where('name', 'LIKE', "%".$this->searchDashboardQuery."%")
            ->orWhereHas('cluster',   function (Builder $query) {
                $query->where('name', 'LIKE', "%".$this->searchDashboardQuery."%");
            })->get();
        error_log($this->searchDashboardQuery);
        error_log($this->allDashboards);
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
        $this->allDashboards = Dashboard::orderBy('cluster_id')
            ->orderBy('name')
            ->get();
        return view('livewire.edit-permissions', [

        ]);
    }
}
