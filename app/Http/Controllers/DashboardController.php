<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Clean;
use App\Models\Share;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

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
    return redirect('/dashboard/' . $dashboard->id)->with('success', "Berhasil Membuat Dashboard Baru: $dashboard->name");
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

    // Fetch all contents that in the dashboard
    $contents = Content::where('dashboard_id', $dashboard->id)->get();

    $usernames = Content::where('chart_id', 1)->pluck('username_tableau')->unique();

    $ticket = ''; // Initialize the ticket variable outside the loop

    // dd($username);
    foreach ($usernames as $username) {
      // Check if username is not null before making the POST request
      if ($username !== null) {
        // Make a POST request
        $response = Http::post('https://visualisasi.dpr.go.id/trusted?username=' . $username);
        $responseBody = $response->body();

        // Assuming $responseBody is a string, you might concatenate it if it's an array or handle it accordingly
        $ticket .= $responseBody; // Adjust this based on the actual structure of $responseBody
      }
    }
    return view('dashboard.contents.main', [
      'dashboard' => $dashboard,
      'contents' => $contents,
      'ticket' => $ticket,
    ]);
    // }
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
