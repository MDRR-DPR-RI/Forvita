<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function content()
    {
        return $this->hasMany(Content::class);
    }
    public function cluster()
    {
        return $this->belongsTo(Cluster::class);
    }
}
