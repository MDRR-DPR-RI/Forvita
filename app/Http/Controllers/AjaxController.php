<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dashboard;
use App\Models\Clean;
use App\Models\Content;
use App\Models\Permission;

class AjaxController extends Controller
{
    public function data_cleans(Request $request)
    {
        $cleanAll = Clean::where('judul', $request->selectedJudul) // take the cleans data based on selectedJudul
            ->where('newest', true) // take the newest data
            ->get();
        $xValue = Content::where('id', $request->contentId)->pluck('x_value'); // take the x_value based on content_id
        return response()->json([
            'value' => $cleanAll,
            'xValue' => $xValue
        ]);
    }

    public function data_dashboards(Request $request)
    {
        $user = User::where('email', $request->userEmail)->first(); // take user data after admin entering their email
        $cluster_id = $request->session()->get('cluster_id'); // take cluster_id from variable that storing in session

        $dashboards = Dashboard::where('cluster_id', $cluster_id)->with('cluster')->get(); // get the dashboards table with clusters table  to access cluster name

        /*
        |--------------------------------------------------------------------------
        | his code will give the dashboard_id values associated with the 
        | specified user and filtered by the cluster_id in the dashboards table.
        |--------------------------------------------------------------------------
        |
        | use the whereHas method to filter the results. Inside the whereHas callback,
        | define the relationship between the permissions and dashboards tables. then
        | specify the additional where clause to filter by the cluster_id in the dashboards table.
        | 
        */
        $dashboard_id = Permission::where('user_id', $user->id)
            ->whereHas('dashboard', function ($query) use ($cluster_id) {
                $query->where('cluster_id', $cluster_id);
            })
            ->pluck('dashboard_id'); // take the dashboard_id

        return response()->json([
            'dashboards' => $dashboards,
            'dashboard_id' => $dashboard_id
        ]);
    }
    public function filter_clean_by_date(Request $request)
    {
        $cleanDate = date('Y-m-d H:i:s', strtotime($request->clean_date));
        $result = Clean::where('created_at', $request->clean_date)->get();

        return response()->json([
            'data' => $result,
            'date' => $cleanDate
        ]);
    }
}
