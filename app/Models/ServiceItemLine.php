<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceItemLine extends Model
{
  protected $table = 'service_item_line';
  protected $primaryKey = 'order_no';
  public $incrementing = false;
  public $timestamps = false;

  //Relation One to Many
  public function serviceLine()
  {
    return $this->hasMany('app/Models/ServiceLine');
  }

  //Relation One to Many
  public function serviceItemLineComment()
  {
    return $this->hasMany('app/Models/ServiceItemLineComment');
  }

  //Relation polymorphique
  public function from()
  {
    return $this->MorphTo();
  }

  //Relation inverse
  public function serviceItemHeader()
  {
    return $this->belongsTo('app/Models/ServiceItemHeader');
  }
}
