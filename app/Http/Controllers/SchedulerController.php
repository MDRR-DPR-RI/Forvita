<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Scheduler;
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
        return view('scheduler.scheduler', [
            'dashboards' => Dashboard::all(),
            'schedulers' => Scheduler::all(),
            'currentParentPage' => 'Admin',
            'currentPage' => 'Scheduler',
            'content' => True,
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
        error_log("Execute: Got scheduler with ID " . $schedulerID);

        $scheduler = Scheduler::find($schedulerID);
        error_log("Type of schedulerResult is " . gettype($scheduler));

        DB::insert($scheduler->query);
        error_log("Execute: SUCCESS JANCOK");
        return redirect('scheduler');
    }
}
