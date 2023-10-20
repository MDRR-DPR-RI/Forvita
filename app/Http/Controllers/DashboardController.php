<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Clean;

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
        Dashboard::create([
            'name' => $request->input('dashboard_name'),
            'cluster_id' => $cluster_id,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Dashboard $dashboard)
    {
        /**
         * Update y_value data everytime the dashboard was rendered 
         */
        $contents = Content::where('dashboard_id', $dashboard->id)->get();
        // logic for updating the y_value data
        foreach ($contents as $content) { // loop every content in the dashboard
            $y_value = [];
            $x_value_array = json_decode($content->x_value); // convert json to an array
            if ($x_value_array) { // if data is not null then continue
                for ($i = 0; $i < count($x_value_array); $i++) { // looping for push the $y_value data based on $content->x_value leangth
                    /**
                     * take the new cleans data where judul = $content->judul and keterangan = $content->x_value[$i] & newest = true to take the newest data
                     * use first() instead of get() so can use the variable like $clean->id to access id.
                     */
                    $clean = Clean::where('judul', $content->judul)
                        ->where('keterangan', $x_value_array[$i])
                        ->where('newest', true)
                        ->first();
                    array_push($y_value, $clean->jumlah); // push the vaue into the $y_value array
                }
            }

            $content->where('x_value', $content->x_value)->update([
                'y_value' => json_encode($y_value),
            ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
