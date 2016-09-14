<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class User extends Model implements AuthenticatableContract
{
  use Authenticatable;

  protected $table = 'user';
  public $timestamps = false;

  //Relation One To One
  public function userData()
  {
    return $this->hasOne('App\Models\UserData', 'user_id', 'id');
  }
}
