<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Orders extends Model
{
  protected $fillable = [
        'customer_id',
       'address',
       'total_price',
       'pm',
       'payment_status',
   ];
   function customers()
    {
      return $this->hasOne('App\User','id','customer_id');
    }


}
