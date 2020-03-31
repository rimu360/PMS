<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineCategories extends Model
{
  protected $fillable = [
       'name',
       'description',
   ];

}
