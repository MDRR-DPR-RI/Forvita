<?php

namespace App\Http\Controllers;

use App\Models\Database;
use App\Services\DatabaseService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use PDO;

class DatabaseController extends Controller
{
    protected DatabaseService $databaseService;

    public function __construct()
    {
        $this->databaseService = new DatabaseService();
    }

    public function show(Request $request): View
    {
        return view('database.database', [
            'databases' => $this->databaseService->getAllDatabases(),
        ]);
    }
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'url' => '',
            'driver' => '',
            'host' => '',
            'port' => 'numeric',
            'database' => '',
            'username' => '',
            'password' => '',
        ]);

        Database::create($validated);

        return redirect('database');
    }

    public function update(Request $request): RedirectResponse
    {
        $updateDatabaseID = $request->input('databaseID');
        $database = Database::find($updateDatabaseID);

        $validated = $request->validate([
            'name' => 'required',
            'url' => '',
            'driver' => '',
            'host' => '',
            'port' => 'numeric',
            'database' => '',
            'username' => '',
            'password' => '',
        ]);

        $database->update($validated);
        $database->save();

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
            $connectionStatus = DB::connection('scheduler')
                ->getPdo()->getAttribute(PDO::ATTR_CONNECTION_STATUS);
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

