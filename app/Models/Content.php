<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function chart()
    {
        return $this->belongsTo(Chart::class);
    }
    public function dashboard()
    {
        return $this->belongsTo(Dashboard::class);
    }
    public function prompt()
    {
        return $this->belongsTo(Prompt::class);
    }
}
