<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;

class UserListing extends Component
{
    public string $searchUserQuery = "";
    public Collection $users;
    public Collection $selectedUsers;
    public $selectedPermissions = [];

    public int $showPermissionsNumber;

    public function searchUser()
    {
        $this->users = DB::table('users')
            ->where('name', 'LIKE', "%".$this->searchUserQuery."%")
            ->orWhere('email', 'LIKE', "%".$this->searchUserQuery."%")
            ->get();
    }

    public function showPermissions($userID): void
    {
        $this->showPermissionsNumber = $userID;
    }
    public function hidePermissions(): void
    {
        $this->showPermissionsNumber = -1;
    }

    public function render(): view
    {
        return view('livewire.user-listing');
    }
}
