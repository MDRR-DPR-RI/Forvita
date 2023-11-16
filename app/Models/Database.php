<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'name',
            'url',
            'driver',
            'host',
            'port',
            'database',
            'username',
            'password',
            'status',
        ];

    protected $attributes = [
        'status' => "Koneksi belum dicoba.",
    ];
}
