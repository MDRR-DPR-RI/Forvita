<?php

namespace App\Http\Controllers;

use App\Models\Database;
use App\Models\Dashboard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
class DatabaseController extends Controller
{

    public function show(Request $request): View
    {
        $cluster_id = session()->get('cluster');

        return view('database.database', [
            'dashboards' => Dashboard::where('cluster_id', $cluster_id)->get(),
            'databases' => Database::all(),
            'currentParentPage' => 'Admin',
            'currentPage' => 'Database',
        ]);
    }
    public function store(Request $request): RedirectResponse
    {
        $database = Database::create([
            'name' => $request->input('databaseName'),
            'url' => $request->input('databaseUrl'),
            'driver' => $request->input('databaseDriver'),
            'host' => $request->input('databaseHost'),
            'port' => $request->input('databasePort'),
            'database' => $request->input('databaseDatabase'),
            'username' => $request->input('databaseUsername'),
            'password' => $request->input('databasePassword'),
        ]);

        return redirect('database');
    }

    public function update(Request $request): RedirectResponse
    {
        $updateDatabaseID = $request->input('databaseID');
        $database = Database::find($updateDatabaseID);

        $database->name = $request->input('databaseName');
        $database->url = $request->input('databaseUrl');
        $database->driver = $request->input('databaseDriver');
        $database->host = $request->input('databaseHost');
        $database->port = $request->input('databasePort');
        $database->username = $request->input('databaseUsername');
        $database->password = $request->input('databasePassword');

        $database->save();

        error_log("Updated database with id $updateDatabaseID");
        return redirect('database');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $deleteDatabaseID = $request->input('databaseID');
        Database::destroy($deleteDatabaseID);
        error_log("deleted database with id $deleteDatabaseID");
        return redirect('database');
    }
}