<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
  const ACTIVE = 1;
  const INACTIVE = 0;

  public function product()
  {
      return $this->belongsTo(Product::class);
  }
}
