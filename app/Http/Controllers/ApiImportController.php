<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use App\Models\ListImport;

class ApiImportController extends Controller
{
    public function show()
    {
        return view('etc.tables.api-list', ['apiLists' => ListImport::where('type', 'api')->get()]);
    }

    public function import(Request $request)
    {
        $url = $request->input('api_url');
        $tableName = $request->input('tableName') . '_' . time();

        if (Schema::hasTable($tableName)) {
            return redirect()->back()->with('deleted', 'Failed to import! The name is exits from tables!');
        }

        $isExists = ListImport::where('name', $tableName)->exists();
        if ($isExists) {
            return redirect()->back()->with('deleted', 'API imported failed because name is exits!');
        } else {
            DB::table('list_imports')->insert([
                'name' => $tableName,
                'file' => $url,
                'type' => 'api',
            ]);

            return redirect()->back()->with('success', 'API imported successfully with name : ' . $tableName);
        }
    }

    public function createTable(Request $request)
    {
        $request->validate(['id' => 'required']);
        $idImport = $request->query('id');
        $data = ListImport::find($idImport);
        if ($data) {
            $tableName = $data->name;
            $url = $data->file;
            // Fetch JSON data from the API
            $jsonData = $this->fetchDataFromApi($url);

            // Initialize variables to hold column names
            $firstRow = reset($jsonData); // Get the first element of the JSON data
            $columnNames = [];

            // Check the data type of the first element (object or string)
            if (gettype($firstRow) == 'string') {
                // If it's a string, extract column names from the JSON keys
                $columnNames = array_keys($jsonData);
            } else {
                // If it's an array, assume nested JSON and extract column names from the second row
                if (gettype($firstRow) == 'array') {
                    $secondRow = reset($firstRow); // Get the first element of the nested array
                    $columnNames = array_keys($secondRow);
                }
            }

            // Create a new database table with the generated table name and dynamic columns
            Schema::create($tableName, function (Blueprint $table) use ($columnNames) {
                $table->id();
                $table->timestamps();

                // Create table columns based on the extracted column names
                foreach ($columnNames as $columnName) {
                    $table->string($columnName, 1000); // Define a string column with a maximum length of 1000 characters
                }
            });

            // Insert JSON data into the newly created table
            if (gettype($firstRow) == 'string') {
                // If it's a string, insert the whole JSON object as a single row
                DB::table($tableName)->insert($jsonData);
            } else {
                // If it's an array, insert each nested JSON object as separate rows
                if (gettype($firstRow) == 'array') {
                    foreach ($firstRow as $row) {
                        DB::table($tableName)->insert($row);
                    }
                }
            }
            $data->action = 1;
            $data->save();

            // Redirect back to the previous page with a success message
            return redirect()->back()->with('success', 'Import successful, and a new table created: ' . $tableName);
        } else {
            return redirect()->back()->with('deleted', 'Data not valid!');
        }
    }

    public function handleFile(Request $request)
    {
        // Coba membuat tabel baru
        $request->validate(['id' => 'required']);
        $idImport = $request->query('id');
        $data = ListImport::find($idImport);
        if ($data) {
            $tableName = $data->name;
            $fileName = $data->file;
            $filePath = storage_path("app/api/{$fileName}");
            if (file_exists($filePath)) {
                $content = file_get_contents($filePath);

                return response($content)
                    ->header('Content-Type', 'text/api')
                    ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
            }
        }

        abort(404, 'API file not found');
    }


    public function viewTable(Request $request)
    {
        // Coba membuat tabel baru
        $request->validate(['id' => 'required']);
        $idImport = $request->query('id');
        $data = ListImport::find($idImport);
        if ($data) {
            return view('etc.view.api-view', [
                'dataAPI' => $data
            ]);
        } else {
            return redirect()->back()->with('deleted', 'Error to view Data!');
        }
    }

    public function fetchDataFromApi($apiUrl)
    {
        $response = Http::get($apiUrl);

        if ($response->successful()) {
            // If the request was successful, you can extract the JSON data.
            $jsonData = $response->json();

            // Now, $jsonData contains the JSON response data from the API.
            return $jsonData;
        } else {
            // Handle the case where the request was not successful (e.g., error handling).
            return null;
        }
    }

    public function deleteList(Request $request)
    {
        // Coba membuat tabel baru
        $request->validate(['id' => 'required']);
        $idImport = $request->query('id');
        $data = ListImport::find($idImport);
        if ($data) {
            $data->delete();
            return redirect()->back()->with('success', 'API list success deleted!');
        } else {
            return redirect()->back()->with('deleted', 'Data not valid!');
        }
    }

    public function deleteTable(Request $request)
    {
        // Coba membuat tabel baru
        $request->validate(['id' => 'required']);
        $idImport = $request->query('id');
        $data = ListImport::find($idImport);
        if ($data) {
            try {
                Schema::dropIfExists($data->name);
                $data->action = 0;
                $data->save();
                return redirect()->back()->with('success', 'API table success deleted!');
            } catch (\Exception $e) {
                return redirect()->back()->with('success', 'API table error deleted!');
            }
        } else {
            return redirect()->back()->with('deleted', 'Data not valid!');
        }
    }
}
