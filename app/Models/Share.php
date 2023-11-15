<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
  use HasFactory;
  protected $guarded = ['id'];

  public function dashboard()
  {
    return $this->belongsTo(Dashboard::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
