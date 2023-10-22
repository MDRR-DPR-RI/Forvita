<?php

namespace App\Http\Controllers;

use App\Models\Database;
use App\Models\Dashboard;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use PDO;

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
        $database->database = $request->input('databaseDatabase');
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

    // Function to change a database connection and config (should probably move this to services)
    public function changeDatabaseConnection(String $connectionName, Database $database): void {
        DB::purge($connectionName); // Kill DB connection and purge cache first

        Config::set('database.connections.' . $connectionName, [
            'driver' => $database->driver,
            'url' => $database->url,
            'host' => $database->host,
            'port' => $database->port,
            'database' => $database->database,
            'username' => $database->username,
            'password' => $database->password,
        ]);
    }

    public function testConnection(Request $request): RedirectResponse {
        $databaseID = $request->query('databaseID');
        $database = Database::find($databaseID);

        try {
            $this->changeDatabaseConnection('scheduler', $database);
            $connectionStatus = DB::connection('scheduler')->getPdo()->getAttribute(PDO::ATTR_CONNECTION_STATUS);
            $database->status = $connectionStatus;
            $database->save();

        } catch(Exception $ex){
            $errorMessage = substr($ex, 0, 200);
            error_log("Failed to connect: " . $errorMessage);
            $database->status = "Failed to connect: " . $errorMessage;
            $database->save();
            return redirect('database');
        }
        return redirect('database');
    }
}