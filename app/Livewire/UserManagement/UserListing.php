<?php

namespace App\Livewire\UserManagement;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class UserListing extends Component
{
    public string $searchUserQuery = "";
    public Collection $users;
    public Collection $selectedUsers;

    protected $listeners = ['permissionsModified' => '$refresh'];

    public function mount()
    {
        $this->users = User::all();
    }

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
//        $this->selectedUsersID = array_diff($this->selectedUsersID, array($userID));
    }

    public function deleteUser($userID): void
    {
        $this->users = $this->users->diff(User::where('id', $userID)->get());
        User::where('id', $userID)
            ->delete();
    }

    public function deletePermission($permissionID): void
    {
        Permission::where('id', $permissionID)
            ->delete();
    }
    public function render(): view
    {
        return view('livewire.user-management.user-listing');
    }
}
