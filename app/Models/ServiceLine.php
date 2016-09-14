<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceLine extends Model
{
  protected $table = 'service_line';
  public $timestamps = false;
  protected $appends = array('type_str');

  //Relation inverse
  public function serviceItemLine()
  {
    return $this->belongsTo('app/Models/ServiceItemLine');
  }

  public function getTypeStrAttribute() {
    $str = '';

    switch($this->type) {
      case 1: $str = 'Article'; break;
      case 2: $str = 'Ressource'; break;
    }

    return $str;
  }
}
