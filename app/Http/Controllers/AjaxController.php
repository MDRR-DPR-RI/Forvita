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
        $cluster_id = $request->session()->get('cluster_id');

        $dashboards = Dashboard::where('cluster_id', $cluster_id)->with('cluster')->get();
        $dashboard_id = Permission::where('user_id', $user->id)->pluck('dashboard_id');

        return response()->json([
            'dashboards' => $dashboards,
            'dashboard_id' => $dashboard_id
        ]);
    }
}
