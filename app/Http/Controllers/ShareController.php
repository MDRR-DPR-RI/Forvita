<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Dashboard;
use App\Models\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ShareController extends Controller
{
  public function index(Dashboard $dashboard, $link)
  {

    $item = Share::with([
      'dashboard'
    ])->where('link', $link)
      ->firstOrFail();

    // Fetch all contents that in the dashboard
    $contents = Content::where('dashboard_id', $item->dashboard_id)->get();

    $usernames = Content::where('chart_id', 18)->pluck('username_tableau')->unique();

    $tickets = []; // Initialize the ticket variable outside the loop

    // dd($username);
    foreach ($usernames as $username) {
      // Check if username is not null before making the POST request
      if ($username !== null) {
        // Make a POST request
        $response = Http::post('https://visualisasi.dpr.go.id/trusted?username=' . $username);
        // Check if the request was successful before accessing the response body
        if ($response->successful()) {
          $responseBody = $response->body();

          // Assuming $responseBody is a string, you might concatenate it if it's an array or handle it accordingly
          // Store the ticket information in the associative array
          $tickets[$username] = $responseBody;
        } else {
          // Handle the case where the request was not successful
          // You might want to log an error or take other appropriate action
        }
      }
    }

    // Iterate through the $contents collection and update each model with the corresponding ticket
    foreach ($contents as $content) {
      // Assuming $content->username_tableau exists and is not null
      $username = $content->username_tableau;

      // Check if the username has a corresponding ticket in the $tickets array
      if (isset($tickets[$username])) {
        // Add the ticket information to the model
        $content->ticket = $tickets[$username];
      }
    }

    if ($item->expired > now()) {
      return view('dashboard.contents.share', [
        'item' => $item,
        'share' => $item->link,
        'dashboard' => $dashboard,
        'contents' => $contents,
      ]);
    } else {
      return view('dashboard.contents.share-expired', [
        // 'item' => $item,
        // 'share' => $item->link,
        // 'dashboard' => $dashboard,
        // 'contents' => $contents,
      ]);
    }
  }

  public function store(Request $request)
  {
    $request->validate([
      'expired' => 'required',
    ]);

    $link = Str::random(20);
    Share::create([
      'user_id' => Auth()->user()->id, // cluster creator
      'dashboard_id' => $request->input('dashboard_id'),
      'expired' => $request->input('expired'),
      'link' => $link
    ]);

    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $hostUrl = $protocol . '://' . $host . '/';

    return back()->with('status', 'Link Berhasil Dibuat!, '.$hostUrl.'public/dashboard/' . $link);
  }

  public function destroy($id)
  {
    Share::destroy($id);

    // redirect with send dashboard_id variable to the dashboard routes
    return back()->with('deleted', "Share has been deleted!");
  }

  public function show($id)
  {
    $share = Share::findorFail($id);

    return view('dashboard.contents.edit_share', [
      'share' => $share
    ]);
  }

  public function update(Request $request,  $id)
  {
    $request->validate([
      'link' => 'required',
    ]);

    $data = $request->all();
    $item = Share::findorFail($id);
    $item->update($data);

    return back()->with('status', 'Dashboard Publik berhasil di Update!');
  }
}
