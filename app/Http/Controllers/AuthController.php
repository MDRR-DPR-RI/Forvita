<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // LOGIN
    public function login_view()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function login_submit(Request $request)
    {
        $credentioals = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentioals)) {
            $request->session()->regenerate();

            return redirect()->intended('/cluster');
        }
        return back()->with('loginError', 'Login Failed!');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    // REGISTER
    public function register_view()
    {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }


    public function register_submit(Request $request)
    {

        $validatedData =  $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:4', 'max:25', 'unique:users'],
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        // $validatedData['password'] = bcrypt($validatedData['password']);
        //or
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        // $request->session()->flash('success', 'Registration successfull');
        return redirect('/')->with('success', 'Registration successfull');
    }
}
