<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Carts extends Model
{
  protected $fillable = [
        'customer_ip',
       'customer_id',
       'medicine_id',
       'quantity',
       'price',
   ];
   public $timestamps = false;

   function cart_items()
    {
      return $this->hasOne('App\Medicines','id','medicine_id');
    }
}
