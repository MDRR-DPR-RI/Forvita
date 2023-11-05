<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cluster_id = $request->session()->get('cluster_id'); // take cluster_id from variable that storing in session

        // this will show all permission based on cluster_id (column in dashboards table). (permission table does not has cluster_id column) 
        $permissions = Permission::whereHas('dashboard', function ($query) use ($cluster_id) {
            $query->where('cluster_id', $cluster_id);
        })->get();
        return view('dashboard.contents.permission', [
            'permissions' => $permissions,
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
        $cluster_id = $request->session()->get('cluster_id'); // take cluster_id from variable that storing in session

        $user_id = User::where('email', $request->userEmailModal)->value('id'); // take user_id based on user email(admin inputed)

        $dashboard_ids = [];

        if ($request->dashboard_ids) {
            $dashboard_ids = array_merge($dashboard_ids, $request->dashboard_ids);
        }
        if ($dashboard_ids) {
            // loop to store multiple  permission into db
            for ($i = 0; $i < count($dashboard_ids); $i++) {
                /*
                |--------------------------------------------------------------------------
                | store data in the database only if it doesn't already exist
                |--------------------------------------------------------------------------
                |
                | The firstOrCreate method will try to find a record in the permissions 
                | table with the given user_id and dashboard_id. If it doesn't find a record
                | with those values, it will create a new one. If a matching record already
                | exists, it won't create a duplicate
                | 
                */
                Permission::firstOrCreate([
                    'user_id' => $user_id,
                    'dashboard_id' => $dashboard_ids[$i],
                ]);
            }
        }
        // use the whereNotIn method, which selects records where the dashboard_id is not present in the dashboard_ids array. then delete if the dashboard_id is not present dashboard_ids
        // delete permission that only in/basedNn clutser_id 
        Permission::where('user_id', $user_id)
            ->whereNotIn('dashboard_id', $dashboard_ids)
            ->whereHas('dashboard', function ($query) use ($cluster_id) {
                $query->where('cluster_id', $cluster_id);
            })->delete();
        return redirect('/permission');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
