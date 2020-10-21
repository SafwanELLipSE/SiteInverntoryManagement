<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock_record extends Model
{
  public function stock()
  {
      return $this->belongsTo(Stock::class);
  }
}
