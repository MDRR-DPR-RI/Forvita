<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use App\Models\Dashboard;
use Illuminate\Http\Request;

class ClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clusters = Cluster::get();
        return view('dashboard.contents.cluster', [
            'clusters' => $clusters,
        ]);
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
        $cluster = Cluster::create([
            'name' => $request->input('cluster_name'),
        ]);
        $clusterId = $cluster->id;
        Dashboard::create([
            'cluster_id' => $clusterId,
            'name' => 'dashboard 1',
        ]);
        return redirect('/cluster');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cluster $cluster, Request $request)
    {
        $cluster_id = $request->query('cluster_id');

        $dashboards = Dashboard::where('cluster_id', $cluster_id)->get();
        return view('dashboard.contents.main', [
            'dashboards' => $dashboards,
            'dashboard_name' => "null",
            'cluster' => $cluster
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cluster $cluster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cluster $cluster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cluster $cluster)
    {
        //
    }
}
