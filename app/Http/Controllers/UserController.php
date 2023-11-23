<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
      $storedFilePath = $request->file('profile_photo')->store('public/profile-photos');
      if ($storedFilePath) {
        // TODO: These are not atomic, there is a possibility that the
        // file is stored but the database is not updated
        if ($user->profile_photo_path) {
          Storage::delete($user->profile_photo_path);
        }
        $updated_fields['profile_photo_path'] = $storedFilePath;
      }
    }

    User::where('id', $user->id)->update($updated_fields);

    return redirect('/profile')->with('success', 'Profile updated!');
  }
}
