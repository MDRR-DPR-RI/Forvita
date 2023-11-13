<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Clean;
use Illuminate\Support\Facades\Gate;

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
        if (! Gate::allows('show-dashboard', $dashboard)) {
            abort(403);
        }


        // Fetch all contents that in the dashboard
        $contents = Content::where('dashboard_id', $dashboard->id)->get();

        
        // $count = 0;
        // // logic for updating the y_value data
        // foreach ($contents as $content) { // loop every content in the dashboard

    //     // Initialize an empty array to store y_value data
    //     $y_value = [];

    //     // Convert the JSON x_value field of the content to an array
    //     $x_value_array = json_decode($content->x_value);

    //     // Check if x_value_array is not null
    //     if ($x_value_array) {
    //         for ($i = 0; $i < count($x_value_array); $i++) { // looping for push the $y_value data based on $content->x_value leangth
    //             /**
    //              * take the new cleans data where judul = $content->judul and keterangan = $content->x_value[$i] & newest = true to take the newest data
    //              * use first() instead of get() so can use the variable like $clean->id to access id.
    //              */
    //             $clean = Clean::where('judul', $content->judul)
    //                 ->where('keterangan', $x_value_array[$i])
    //                 ->where('newest', true)
    //                 ->first();

    //             // Push the 'jumlah' value from the Clean model into the y_value array
    //             array_push($y_value, $clean->jumlah);
    //         }
    //     }

    //     // Update the content's 'y_value' field with the new y_value array
    //     $updated = Content::where('x_value', $content->x_value)
    //         ->where('id', $content->id)
    //         ->update([
    //             'y_value' => json_encode($y_value),
    //         ]);

    //     // If the content was successfully updated, increment the count
    //     if ($updated) {
    //         $count++;
    //     }
    // }

    // If all contents were successfully updated, return the view
    // if ($count === count($contents)) {
    return view('dashboard.contents.main', [
      'dashboard' => $dashboard,
      'contents' => $contents,
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
        'name' => 'Dashboard 1',
      ]);
      // Set the ID of the newly created dashboard as the next_dashboard_id
      $next_dashboard_id = $new_dashboard->id;
    }

    // Redirect to the dashboard route with the next_dashboard_id
    return redirect('/dashboard/' . $next_dashboard_id)->with('deleted', "Dashboard $dashboard->name berhasil dihapus!");
  }
}
