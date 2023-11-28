<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelModel extends Model
{
    protected $table = "excel_model";
    protected $primaryKey = "id";
    protected $fillable = [
        'dbname', 'svname', 'appname'
    ];
}
