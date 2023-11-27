<?php

namespace App\Livewire\UserManagement;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Hash;

class AddUser extends ModalComponent
{
    public string $name;
    public string $email;
    public string $roleID;
    public string $password;
    public string $resubmitPassword;
    public Collection $roles;

    public function mount(): void
        // runs the first time the page is loaded
    {
        $this->roles = Role::all();
    }

    public function addUser(): void
    {
        $validated = $this->validate(
            [ // validation rules
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'roleID' => 'required|exists:roles,id',
                'password' => 'required|min:5|max:255',
                'resubmitPassword' => 'same:password',
            ],
            [ // Messages when validation rule is broken
                'roleID.required' => 'Mohon pilih salah satu role.',
                'roleID.exists' => 'Role yang dipilih tidak valid.',
                'resubmitPassword.same' => 'Password harus sama.',
            ],
        );

        $validated['password'] = Hash::make($validated['password']);
        $createdUser = User::create($validated);

        $createdUser->role_id = $this->roleID;
        $createdUser->save();

        $this->closeModalWithEvents([
            UserListing::class => 'refreshUsers',
        ]);
    }
    public function render() : View
        // Runs each time the page renders for any reason
    {
        return view('livewire.user-management.add-user');
    }
}
