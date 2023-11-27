<?php

namespace App\Http\Controllers;

use App\Models\Database;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use PDO;

class DatabaseController extends Controller
{
    public array $blacklist = ['sqlite', 'mysql', 'pgsql', 'sqlsrv'];
    public function show(Request $request): View
    {
        return view('database.database', [
            'databases' => Database::all(),
            'currentParentPage' => 'Admin',
        ]);
    }
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|unique:databases|max:255|not_in:'.implode(',', $this->blacklist),
        ]);

        $database = Database::create([
            'name' => $request->name,
            'url' => $request->url,
            'driver' => $request->driver,
            'host' => $request->host,
            'port' => $request->port,
            'database' => $request->database,
            'username' => $request->username,
            'password' => $request->password,
        ]);

        return redirect('database');
    }

    public function update(Request $request): RedirectResponse
    {
        $updateDatabaseID = $request->input('databaseID');
        $validated = $request->validate([
            'name' => 'required|unique:databases,name,'.$updateDatabaseID.'|max:255|not_in:'.implode(',', $this->blacklist),
        ]);

        $database = Database::find($updateDatabaseID);

        $database->name = $request->name;
        $database->url = $request->url;
        $database->driver = $request->driver;
        $database->host = $request->host;
        $database->port = $request->port;
        $database->database = $request->database;
        $database->username = $request->username;
        $database->password = $request->password;

        $database->save();

        return redirect('database');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $deleteDatabaseID = $request->input('databaseID');
        Database::destroy($deleteDatabaseID);
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
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
        ]);
    }

    public function testConnection(Request $request): RedirectResponse {
        $databaseID = $request->query('databaseID');
        $database = Database::find($databaseID);

        try {
            $this->changeDatabaseConnection($database->name, $database);
            $connectionStatus = DB::connection($database->name)->getPdo()->getAttribute(PDO::ATTR_CONNECTION_STATUS);
            $database->status = $connectionStatus;
            $database->save();

        } catch(Exception $ex){
            $errorMessage = substr($ex, 0, 200);
            $database->status = "Gagal untuk konek: " . $errorMessage;
            $database->save();
            return redirect('database');
        }
        return redirect('database');
    }
}

