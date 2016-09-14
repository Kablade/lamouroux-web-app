<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
  protected $table = 'resource';
  public $timestamps = false;

  //Relation polymorphique
  public function serviceItemLine()
  {
    return $this->morphMany('app/Models/ServiceItemLine', 'from');
  }
}
