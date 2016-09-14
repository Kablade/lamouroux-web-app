<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
  protected $table = 'structure';
  public $timestamps = false;

  //Relation inverse
  public function serviceItemLine()
  {
    return $this->morphMany('app/Models/ServiceItemLine', 'from');
  }
}
