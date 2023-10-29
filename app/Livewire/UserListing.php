<?php

namespace App\Livewire;

use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;

class UserListing extends Component
{
    public string $searchUserQuery = "";
    public Collection $users;
    public Collection $selectedUsers;

    public string $searchDashboardQuery = "";
    public Collection $dashboards;
    public Collection $selectedDashboards;

    public string $class = "show";
    public string $style = "display: block;";

    public function searchUser()
    {
        $this->users = User::where('name', 'LIKE', "%".$this->searchUserQuery."%")
            ->orWhere('email', 'LIKE', "%".$this->searchUserQuery."%")
            ->get();
    }

    public function selectUser($userID): void
    {
        $selectedUser = User::where('id', $userID)
            ->get();
        if (!isset($this->selectedUsers)) {
            $this->selectedUsers = $selectedUser;
        }
        else {
            $this->selectedUsers = $this->selectedUsers->merge($selectedUser);
        }
    }

    public function deselectUser($userID): void
    {
        $selectedUser = User::where('id', $userID)
            ->get();
        $this->selectedUsers = $this->selectedUsers->diff($selectedUser);
    }

    public function searchDashboard()
    {
        $this->dashboards = Dashboard::where('name', 'LIKE', "%".$this->searchDashboardQuery."%")
            ->orWhereHas('cluster', function (Builder $query) {
                $query->where('name', 'LIKE', "%".$this->searchDashboardQuery."%");
            })->get();
    }

    public function selectDashboard($dashboardID): void
    {
        $selectedDashboard = Dashboard::where('id', $dashboardID)
            ->get();
        if (!isset($this->selectedDashboard)) {
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

    public function render(): view
    {
        return view('livewire.user-listing');
    }
}
