<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use App\Models\Dashboard;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\RedisJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Session::forget('cluster_id');

        /*
        |--------------------------------------------------------------------------
        | This is user's permission to see which clusters they can see based on dashboard permission
        |--------------------------------------------------------------------------
        |
        | ex: if they only have permission to see dashboard C (dashboard in cluster 2),
        | they can only see/select cluster 2 after they log-in
        | 
        */
        $user_role = auth()->user()->role->name;
        $clusters = [];
        if ($user_role == 'Admin') {
            $clusters = Cluster::all(); // if admin, they can see all clusters
        } else {
            $cluster_ids = [];
            $dashboard_ids = [];
            $permissions = Permission::where('user_id', auth()->user()->id)->get(); // get all permissions based on user's id
            foreach ($permissions as $index) { // loop the permissions to take take the cluster_id then push into array
                array_push($cluster_ids, $index->dashboard->cluster_id); // push the cluser_Id into array
                array_push($dashboard_ids, $index->dashboard->id); // push the cluser_Id into array
                $clusters = Cluster::whereIn('id', $cluster_ids)->get(); // use whereIn method to get clusters based on id in an array
            }
            $request->session()->put('dashboard_ids', $dashboard_ids); // store dashboard_ids into sessions to use in DashboardController 
        }
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
            'user_id' => Auth()->user()->id, // cluster creator
            'name' => $request->input('cluster_name'),
            'icon_name' => $request->input('icon'),
        ]);
        $clusterId = $cluster->id;
        Dashboard::create([
            'cluster_id' => $clusterId,
            'name' => 'Dshboard 1',
            'description'=> 'description 1'
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

        $iconpicker = $cluster->icon_name;
        $request->session()->put('icon', $iconpicker);

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
