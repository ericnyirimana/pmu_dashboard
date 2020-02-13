<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{


  protected $fillable = ['product_id', 'name', 'description', 'ingredients', 'code'];



}
