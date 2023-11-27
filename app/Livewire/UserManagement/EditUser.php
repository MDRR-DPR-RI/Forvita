<?php

namespace App\Livewire\UserManagement;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;

class EditUser extends ModalComponent
{
    public string $selectedUserID;
    public User $selectedUser;
    public string $name;
    public string $email;
    public string $roleID;
    public string $password;
    public string $resubmitPassword;
    public Collection $roles;

    public bool $changePassword;

    public function mount(): void
        // runs the first time the page is loaded
    {
        $this->changePassword = false;

        $this->roles = Role::all();
        $selectedUser = User::find($this->selectedUserID);

        $this->selectedUser = $selectedUser;
        $this->name = $selectedUser->name;
        $this->email = $selectedUser->email;
        $this->roleID = $selectedUser->role->id;
    }

    public function editUser(): void
    {
        $validated = $this->validate(
            [ // validation rules
                'name' => 'required|max:255',

                // ignore unique email rule for self when updating
                'email' => 'required|email|unique:users,email,'.$this->selectedUserID,

                'roleID' => 'required|exists:roles,id',
                'password' => 'exclude_if:changePassword,false|min:5|max:255',
                'resubmitPassword' => 'exclude_if:changePassword,false|same:password',
            ],
            [ // Messages when validation rule is broken
                'roleID.required' => 'Mohon pilih salah satu role.',
                'roleID.exists' => 'Role yang dipilih tidak valid',
                'resubmitPassword.same' => 'Password harus sama.',
            ],
        );


        $this->selectedUser->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        $this->selectedUser->role_id = $this->roleID;
        if ($this->changePassword) {
            $this->password = Hash::make($validated['password']);
            $this->selectedUser->update([
                'password' => $this->password,
            ]);
        }
        $this->selectedUser->save();

        $this->closeModalWithEvents([
            UserListing::class => 'refreshUsers',
        ]);
    }
    public function render()
    {
        return view('livewire.user-management.edit-user');
    }
}
