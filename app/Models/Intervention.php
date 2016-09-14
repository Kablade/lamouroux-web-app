<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
  protected $table = 'intervention';
  public $incrementing = false;
  public $timestamps = false;

  protected $guarded = [];

  //Relation inverse
  public function serviceItemHeader()
  {
    return $this->belongsTo('App\Models\ServiceItemHeader');
  }
}
