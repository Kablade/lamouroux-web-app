<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceItemHeader extends Model
{
  protected $table = 'service_item_header';
  protected $primaryKey = 'order_no';
  public $incrementing = false;
  public $timestamps = false;

  //Relation One To Many
  public function interventions()
  {
    return $this->hasMany('App\Models\Intervention', 'order_no', 'order_no');
  }

  //Relation One To Many
  public function serviceItemLine()
  {
    return $this->hasMany('App\Models\ServiceItemLine');
  }
}
