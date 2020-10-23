<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->hasone(User::class,'id','created_by');
    }
    public static function getStatus($active_id){
      switch($active_id) {
              case 0    : return "Not Approved";
              case 1    : return "Approved";
          }
    }
}
