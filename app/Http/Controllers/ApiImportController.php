<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;

class ApiImportController extends Controller
{
    public function storeDataFromApi(Request $request)
    {
        // Get the API URL from the user input
        $url = $request->input('api_url');

        // Fetch JSON data from the API
        $jsonData = $this->fetchDataFromApi($url);

        // Generate a unique table name by combining the user input with a timestamp
        $tableName = $request->input('tableName') . '_' . time();

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

        // Redirect back to the previous page with a success message
        return redirect()->back()->with('success', 'Import successful, and a new table created: ' . $tableName);
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
}
