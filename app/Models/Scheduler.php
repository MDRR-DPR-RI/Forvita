<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public function database(): BelongsTo
    {
        return $this->belongsTo(Database::class);
    }
}
