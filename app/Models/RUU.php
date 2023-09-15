<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function bulan()
    {
        $this->belongsTo(Bulan::class);
    }
}
