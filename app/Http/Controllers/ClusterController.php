<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\RedisJob;
use Illuminate\Support\Facades\Session;

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
        // storing session
        $cluster_id = $cluster->id;
        $request->session()->put('cluster_id', $cluster_id);

        $cluster_name = $cluster->name;
        $request->session()->put('cluster_name', $cluster_name);

        $dashboard = Dashboard::where('cluster_id', $cluster_id)->first();

        return redirect('/dashboard/' . $dashboard->id);
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
