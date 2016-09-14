<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceItemLineComment extends Model
{
  protected $table = 'service_item_comment_line';
  public $timestamps = false;

  //Relation inverse
  public function serviceItemLine()
  {
    return $this->belongsTo('app/Models/ServiceItemLine');
  }
}
