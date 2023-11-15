<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        return view('dashboard.contents.view-profile', [
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'password' => ['nullable', 'string', 'min:5', 'max:255', 'confirmed'],
            'profile_photo' => ['image'],
        ]);

        $updated_fields = array();

        if ($data['password']) {
            $updated_fields['password'] = Hash::make($data['password']);
        }

        if ($request->hasFile('profile_photo')) {
            $updated_fields['profile_photo_path'] = $request->file('profile_photo')->store('public/profile-photos');
        }

        User::where('id', $user->id)->update($updated_fields);

        return redirect('/profile')->with('success', 'Profile updated!');
    }
}
