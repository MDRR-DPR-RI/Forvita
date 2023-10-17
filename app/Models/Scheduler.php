<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheduler extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'name',
            'query',
            'status',
        ];
    protected $attributes = [
        'status' => "not executed yet",
        'database_id' => null,
    ];
    public function database()
    {
        return $this->belongsTo(Database::class);
    }
}
