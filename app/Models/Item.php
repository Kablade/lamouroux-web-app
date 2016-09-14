<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';
    public $incrementing = false;
    public $timestamps = false;

    //Relation polymorphique
    public function serviceItemLine()
    {
      return $this->morphMany('app/Models/ServiceItemLine', 'from');
    }
}
