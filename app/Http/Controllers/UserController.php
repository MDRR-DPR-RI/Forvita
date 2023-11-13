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
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);

        User::where('id', $user->id)->update([
            'password' => Hash::make($data['password'])
        ]);

        return redirect('/profile')->with('success', 'Profile updated!');
    }
}
