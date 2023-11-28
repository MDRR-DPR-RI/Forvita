<?php

namespace App\Imports;

use App\Models\ExcelModel;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ExcelModel([
            'dbname' => $row[1],
            'svname' => $row[2],
            'appname' => $row[3],
        ]);
    }
}
