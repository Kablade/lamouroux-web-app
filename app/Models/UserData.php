<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
  protected $table = 'user_data';
  protected $primaryKey = 'user_id';
  public $timestamps = false;

  //Relation inverse
  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }
}
