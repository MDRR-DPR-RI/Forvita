<?php

namespace App\Services;

use App\Models\Database;
use Illuminate\Database\Eloquent\Collection;

class DatabaseService
{
    protected Database $database;

    public function searchDatabase(string $searchDatabaseQuery): Collection
    {
        return Database::where('name','LIKE', '%'.$searchDatabaseQuery.'%')
            ->get();
    }
}
