<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('email', $user->email)->first();

            if ($findUser) {
                Auth::login($findUser);
                return redirect()->intended('cluster');
            } else {
                $newUser = User::create([
                    'role_id' => 3, // Sesuaikan dengan role ID yang sesuai
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => Hash::make('password'), // Sesuaikan dengan logika hash password Anda
                ]);

                Auth::login($newUser);
                return redirect()->intended('cluster');
            }
        } catch (\Exception $e) {
            // Log or handle the exception appropriately
            dd($e);
        }
    }
}
