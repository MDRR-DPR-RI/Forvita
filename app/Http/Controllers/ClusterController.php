<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use App\Models\Dashboard;
use App\Models\Share;
use App\Models\Content;
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
        Session::forget('cluster_name');

        /*
    |--------------------------------------------------------------------------
    | This is user's permission to see which clusters they can see based on dashboard permission
    |--------------------------------------------------------------------------
    |
    | ex: if they only have permission to see dashboard C (dashboard in cluster 2),
    | they can only see/select cluster 2 after they log-in
    | 
    */
        $user = auth()->user();

        if ($user && $user->role) {
            $user_role = $user->role->name;
            $clusters = [];

            if ($user_role == 'Admin') {
                $clusters = Cluster::orderBy('position')->get();
            } else {
                $cluster_ids = [];
                $dashboard_ids = [];
                $permissions = Permission::where('user_id', $user->id)
                    ->get(); // get all permissions based on user's id

                foreach ($permissions as $index) { // loop the permissions to take take the cluster_id then push into array
                    array_push($cluster_ids, $index->dashboard->cluster_id); // push the cluster_Id into array
                    array_push($dashboard_ids, $index->dashboard->id); // push the cluster_Id into array
                }

                $clusters = Cluster::whereIn('id', $cluster_ids)
                    ->orderBy('position')
                    ->get(); // use whereIn method to get clusters based on id in an array
                $request->session()->put('dashboard_ids', $dashboard_ids); // store dashboard_ids into sessions to use in DashboardController
            }

            return view('dashboard.contents.cluster', [
                'clusters' => $clusters,
            ]);
        } else {
            // Tindakan yang sesuai jika user atau rolenya null
            // Misalnya, Anda bisa memberikan nilai default atau mengembalikan kesalahan.
            return redirect()->back()->with('error', "User atau role tidak valid.");
        }
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
        $cluster->update([
            'position' => $cluster->id
        ]);
        $clusterId = $cluster->id;
        Dashboard::create([
            'cluster_id' => $clusterId,
            'name' => 'Dshboard-' . $request->cluster_name,
            'description' => 'Description ' . $request->cluster_name,
            'icon_name' => $request->input('icon'),
        ]);
        return redirect()->back()->with('success', "Berhasil Membuat Cluster Baru: $request->cluster_name");
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

        // Get first dashboard in cluster that's allowed for user
        $userDashboardIDs = Permission::where('user_id', Auth()->user()->id)
            ->pluck('dashboard_id');
        if (Auth()->user()->role->name === 'Admin') {
            $dashboard = Dashboard::where('cluster_id', $cluster_id)->first();
        } else {
            $dashboard = Dashboard::where('cluster_id', $cluster_id)
                ->whereIn('id', $userDashboardIDs)->first();
        }

        // if user forces cluster without any allowed dashboards
        if (is_null($dashboard)) {
            abort(403);
        }

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
        $cluster->update([
            'name' => $request->cluster_name,
            'icon_name' => $request->icon
        ]);
        return redirect()->back()->with('success', "Berhasil Memperbaharui Cluster: $request->cluster_name");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cluster $cluster)
    {
        Cluster::destroy($cluster->id); // remove all cluster
        $dashboards = Dashboard::where('cluster_id', $cluster->id)->get();
        foreach ($dashboards as $dashboard) {
            Share::where('dashboard_id', $dashboard->id)->delete(); // remove all shares that have dashboard_id
            Content::where('dashboard_id', $dashboard->id)->delete(); // remove all contents that have dashboard_id
        }
        Dashboard::where('cluster_id', $cluster->id)->delete(); // remove all dashboard in the cluster

        return redirect()->back()->with('deleted', "Cluster $cluster->name berhasil dihapus !");
    }
    public function update_cluster_position(Request $request)
    {
        $cluster_ids = $request->input('cluster_ids');
        for ($i = 0; $i < count($cluster_ids); $i++) {
            Cluster::where('id', $cluster_ids[$i])->update(['position' => $i]);
        }
        return response()->json(['success' => true]);
    }
}
