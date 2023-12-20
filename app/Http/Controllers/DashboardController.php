<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $cluster_id = $request->session()->get('cluster_id');
    $dashboard = Dashboard::create([
      'name' => $request->input('dashboard_name'),
      'description' => $request->input('dashboard_description'),
      'icon_name' => $request->input('icon'),
      'cluster_id' => $cluster_id,
    ]);

    if (auth()->user()->role->name == 'User') {
      Permission::create([
        'user_id' => auth()->user()->id,
        'dashboard_id' => $dashboard->id
      ]);
      // Retrieve the existing array from the session
      $dashboardIds = session('dashboard_ids', []);

      // Append a new value to the array
      $dashboardIds[] = $dashboard->id;

      // Store the modified array back into the session
      session(['dashboard_ids' => $dashboardIds]);
    }
    return redirect('/dashboard/' . $dashboard->id)->with('success', "Berhasil Membuat Dashboard baru: $dashboard->name");
  }

  /**
   * Display the specified resource.
   */
  public function show(Request $request, Dashboard $dashboard)
  {
    /**
     * Update y_value data everytime the dashboard was rendered 
     */
    // Gate to check if user is authorized to see dashboard
    if (!Gate::allows('show-dashboard', $dashboard)) {
      abort(403);
    }

    $contents = Content::where('dashboard_id', $dashboard->id)
      ->orderBy('position')
      ->get();
    $usernames = Content::where('chart_id', 18)
      ->where('dashboard_id', $dashboard->id)
      ->pluck('username_tableau')->unique();

    // Initialize an associative array to store tickets for each username
    $tickets = [];
    if (!$usernames->isEmpty()) {
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
            return redirect()->back()->with('error', "Coba Lagi!");
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
    }

    return view('dashboard.contents.main', [
      'dashboard' => $dashboard,
      'contents' => $contents,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Dashboard $dashboard)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Dashboard $dashboard)
  {
    $dashboard->update([
      'name' => $request->dashboard_name,
      'description' => $request->dashboard_description,
      'icon_name' => $request->icon
    ]);

    return redirect()->back()->with('success', "Berhasil Mengubah Nama Dashboard: $request->dashboard_name");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Dashboard $dashboard, Request $request)
  {
    Content::where('dashboard_id', $dashboard->id)->delete(); // remove all dashboard in this dashboard
    // Delete the dashboard with the given ID
    $is_deleted = Dashboard::destroy($dashboard->id);

    // Initialize the variable to store the ID of the next dashboard
    $next_dashboard_id = '';

    // Get the cluster ID from the session
    $cluster_id = $request->session()->get('cluster_id');

    // Check if the dashboard was successfully deleted
    if ($is_deleted) {
      // If the dashboard was deleted, find the ID of the next dashboard in the same cluster
      $next_dashboard_id = Dashboard::where('cluster_id', $cluster_id)->pluck('id')->first();
    }

    // If there is no next dashboard (or the last dashboard was deleted), create a new dashboard
    if (!$next_dashboard_id) {
      // Create a new dashboard with the cluster ID and a default name
      $new_dashboard = Dashboard::create([
        'cluster_id' => $cluster_id,
        'name' => 'Dashboard-' . $dashboard->cluster->name,
        'description' => 'Description ' . $dashboard->cluster_name,
        'icon_name' => $dashboard->cluster->icon_name,
      ]);
      // Set the ID of the newly created dashboard as the next_dashboard_id
      $next_dashboard_id = $new_dashboard->id;
    }

    // Redirect to the dashboard route with the next_dashboard_id
    return redirect('/dashboard/' . $next_dashboard_id)->with('deleted', "Dashboard $dashboard->name berhasil dihapus!");
  }
}
