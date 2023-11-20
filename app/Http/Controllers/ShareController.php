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

    $ticket = ''; // Initialize the ticket variable outside the loop

    // dd($username);
    foreach ($usernames as $username) {
      // Check if username is not null before making the POST request
      if ($username !== null) {
        // Make a POST request
        $response = Http::post('https://visualisasi.dpr.go.id/trusted?username=' . $username);
        $responseBody = $response->body();
        // dd($responseBody);
        // Assuming $responseBody is a string, you might concatenate it if it's an array or handle it accordingly
        $ticket .= $responseBody; // Adjust this based on the actual structure of $responseBody
      }
    }

    return view('dashboard.contents.share', [
      'item' => $item,
      'share' => $item->link,
      'dashboard' => $dashboard,
      'contents' => $contents,
      'ticket' => $ticket
    ]);
  }

  public function store(Request $request)
  {
    $link = Str::random(20);
    Share::create([
      'user_id' => Auth()->user()->id, // cluster creator
      'dashboard_id' => $request->input('dashboard_id'),
      'link' => $link
    ]);

    return back()->with('status', 'Link Berhasil Dibuat!, https://172.18.25.16/public/dashboard/' . $link);
  }

  public function destroy($id)
  {
    Share::destroy($id);

    // redirect with send dashboard_id variable to the dashboard routes
    return back()->with('deleted', "Share has been deleted!");
  }
}
