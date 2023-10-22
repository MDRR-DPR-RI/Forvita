<?php

namespace App\Http\Controllers;

use App\Models\Clean;
use App\Models\Dashboard;
use App\Models\Scheduler;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SchedulerController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function show(Request $request): View
    {
        $cluster_id = session()->get('cluster');

        return view('scheduler.scheduler', [
            'dashboards' => Dashboard::where('cluster_id', $cluster_id)->get(),
            'schedulers' => Scheduler::all(),
            'currentParentPage' => 'Admin',
            'currentPage' => 'Scheduler',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $scheduler = Scheduler::create([
            'name' => $request->input('schedulerName'),
            'query' => $request->input('schedulerQuery'),
            'database_id' => $request->input('schedulerDatabaseID'),
        ]);

       return redirect('scheduler');
    }

    public function update(Request $request): RedirectResponse
    {
        $updateSchedulerID = $request->input('schedulerID');
        $scheduler = Scheduler::find($updateSchedulerID);

        $scheduler->name = $request->input('schedulerName');
        $scheduler->query = $request->input('schedulerQuery');
        $scheduler->database_id = $request->input('schedulerDatabaseID');
        $scheduler->save();

        error_log("Updated scheduler with id $updateSchedulerID");
        return redirect('scheduler');
    }
    public function destroy(Request $request): RedirectResponse
    {
        $deleteSchedulerID = $request->input('schedulerID');
        Scheduler::destroy($deleteSchedulerID);
        error_log("deleted scheduler with id $deleteSchedulerID");
        return redirect('scheduler');
    }
    public function execute(Request $request) {
        $schedulerID = $request->query('schedulerID');
        $scheduler = Scheduler::find($schedulerID);

        try {
            $queryResult = DB::select($scheduler->query);
            foreach($queryResult as $row) {
                Clean::updateOrCreate(
                    ['keterangan' => $row->keterangan],
                    [
                        'judul' => $row->judul,
                        'jumlah' => $row->jumlah,
                    ]
                );
            }
        } catch(Exception $ex){
            $errorMessage = substr($ex, 0, 200);
            error_log("Failed to execute query: " . $errorMessage);
            $scheduler->status = "Failed to run: " . $errorMessage;
            $scheduler->save();
            return redirect('scheduler');
        }

        $scheduler->status = "Ran successfully!";
        $scheduler->save();
        return redirect('scheduler');
    }
}
