<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    const ACCESS_LEVEL_SUPPLIER = 'Supplier';
    const ACCESS_LEVEL_ACCOUNT = 'Account';

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
