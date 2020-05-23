<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Stocks extends Model
{
  protected $fillable = [
      'medicine_id',
       'quantity',
       'pharmacist_id',
   ];
public $timestamps = false;
function stocks()
 {
   return $this->hasOne('App\Medicines','id','medicine_id');
 }

}
