<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excels extends Model
{
    protected $table = "excel";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama', 'alamat', 'tgllhr', 'telp'
    ];
}
