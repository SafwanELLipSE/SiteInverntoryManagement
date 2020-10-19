<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site_manager extends Model
{
  public function user()
  {
      return $this->belongsTo(User::class);
  }
  public static function getGender($active_id){
    switch($active_id) {
            case 0    : return "Male ";
            case 1    : return "Female";
        }
  }
}
