<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
class UserManagementController extends Controller
{

    public function index(): View
    {
        return view('user-management.user-management', [
            'initialUsers' => User::all(),
        ]);
    }
}
