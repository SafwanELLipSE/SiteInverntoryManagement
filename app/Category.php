<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function productBrands()
    {
        return $this->hasMany(Brand::class);
    }
}
