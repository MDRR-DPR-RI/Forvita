<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'database_url',
            'database_user',
            'database_password',
        ];
}
