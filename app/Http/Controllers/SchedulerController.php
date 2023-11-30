<?php

namespace App\Http\Controllers;

use App\Models\Clean;
use App\Models\Dashboard;
use App\Models\Database;
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
        return view('scheduler.scheduler', [
            'schedulers' => Scheduler::all(),
            'databases' => Database::all(),
            'currentParentPage' => 'Admin',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $scheduler_name = $request->input('schedulerName');
        Scheduler::create([
            'name' => $scheduler_name,
            'query' => $request->input('schedulerQuery'),
            'database_id' => $request->input('schedulerDatabaseID'),
        ]);
        return redirect('scheduler')->with('success', "Query $scheduler_name berhasil ditambahkan!");
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
        return redirect('scheduler')->with('success', "Query $scheduler->name berhasil ditambahkan!");
    }
    public function destroy(Request $request): RedirectResponse
    {
        $deleteSchedulerID = $request->input('schedulerID');
        $scheduler = Scheduler::where('id', $deleteSchedulerID)->first();
        Scheduler::destroy($deleteSchedulerID);
        error_log("deleted scheduler with id $deleteSchedulerID");
        return redirect('scheduler')->with('deleted', "Query $scheduler->name berhasil dihapus!");
    }
    public function execute(Request $request)
    {
        $schedulerID = $request->query('schedulerID');
        $scheduler = Scheduler::find($schedulerID);

        try { // should move this to services
            $schedulerDatabase = $scheduler->database;
            if ($schedulerDatabase) {
                (new DatabaseController())->changeDatabaseConnection('scheduler', $schedulerDatabase);
                $queryResult = DB::connection('scheduler')->select($scheduler->query);
            } else {
                $queryResult = DB::select($scheduler->query);
            }
            date_default_timezone_set('Asia/Jakarta');

            $currentTimestamp = date('Y-m-d H:i:s'); // each time scheduler executed, use same TimeStamp to filter the data in next_edit_chart
            foreach ($queryResult as $row) {
                Clean::where('kelompok', $row->kelompok)
                    ->where('data', $row->data)
                    ->where('judul', $row->judul)
                    ->where('keterangan', $row->keterangan)
                    ->update(['newest' => False]);
                Clean::create([
                    'kelompok' => $row->kelompok,
                    'data' => $row->data,
                    'judul' => $row->judul,
                    'keterangan' => $row->keterangan,
                    'jumlah' => $row->jumlah,
                    'created_at' => $currentTimestamp
                ]);
            }
        } catch (Exception $ex) {
            $errorMessage = substr($ex, 0, 200);
            error_log("Failed to execute query: " . $errorMessage);
            $scheduler->status = "Failed to run: " . $errorMessage;
            $scheduler->save();
            return redirect('scheduler')->with('warning', "Query $scheduler->name tidak berhasil dijalankan!");
        }
        $scheduler->status = "Ran successfully!";
        $scheduler->save();
        return redirect('scheduler')->with('success', "Query $scheduler->name berhasil dijalankan!");
    }
    public function remove_cleans(Request $request)
    {
        Clean::where('judul', $request->judul_data)->delete();
        return redirect()->back()->with('deleted', "Data $request->judul_data berhasil dihapus!");
    }
}
