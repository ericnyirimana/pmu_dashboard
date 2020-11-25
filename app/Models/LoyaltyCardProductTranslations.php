<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyCardProductTranslations extends Model
{


  protected $fillable = ['loyalty_card_product_id', 'name', 'description', 'ingredients', 'code'];



}