<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bulan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function ruu()
    {
        $this->hasMany(RUU::class);
    }
}
