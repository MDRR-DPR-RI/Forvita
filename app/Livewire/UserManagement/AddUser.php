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
    public Collection $roles;

    public function mount(): void
    {
        $this->roles = Role::all();
    }

//    public function messages()
//    {
//        return [
//            'name.required' => 'The :attribute is missing.',
//            'name.max' => 'The :attribute is too long.',
//
//            'email.required' => 'The :attribute is missing.',
//            'email.email' => 'The :attribute is not a valid email.',
//        ];
//    }

    public function addUser(): void
    {
        $validated = $this->validate(
            [ // validation rules
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:5|max:255',
                'roleID' => 'required|exists:role,id'
            ],
        );
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
    }
    public function render() : View
    {
        return view('livewire.user-management.add-user');
    }
}
