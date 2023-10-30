<?php

namespace App\Livewire;

use App\Models\Permission;
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
    public array $selectedUsersID;

    protected $listeners = ['permissionsModified' => '$refresh'];

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

            $this->selectedUsersID = array();
            $this->selectedUsersID[] = $userID;

        }
        else {
            $this->selectedUsers = $this->selectedUsers->merge($selectedUser);
            $this->selectedUsersID[] = $userID;
        }
    }

    public function deselectUser($userID): void
    {
        $selectedUser = User::where('id', $userID)
            ->get();
        $this->selectedUsers = $this->selectedUsers->diff($selectedUser);
        $this->selectedUsersID = array_diff($this->selectedUsersID, array($userID));
    }

    public function render(): view
    {
        return view('livewire.user-listing');
    }
}
