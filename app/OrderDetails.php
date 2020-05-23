<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class OrderDetails extends Model
{
  protected $fillable = [
        'medicine_id',
       'order_id',
       'quantity',

   ];
   public $timestamps = false;

   function medicines()
    {
      return $this->hasOne('App\Medicines','id','medicine_id');
    }

}
