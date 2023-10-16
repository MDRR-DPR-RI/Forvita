<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'commodity_id', 'district_id', 'date', 'price'
  ];

  protected $hidden = [];

  public function district()
  {
      return $this->belongsTo(District::class, 'district_id', 'id');
  }

  public function commodity()
  {
      return $this->belongsTo(Commodity::class, 'commodity_id', 'id');
  }
}
