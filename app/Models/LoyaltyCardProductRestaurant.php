<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UserCanTrait;


class LoyaltyCardProductRestaurant extends Model
{

    protected $fillable = ['restaurant_id', 'product_id', 'loyalty_card_product_id'];

    public $timestamps = false;

    
    public function company()
    {

        return $this->restaurant->company();


    }

    public function restaurant()
    {

        return $this->belongsTo('App\Models\Restaurant');

    }

    public function product()
    {

        return $this->belongsTo('App\Models\Product');

    }

    public function loyalty_card_product()
    {

        return $this->belongsTo('App\Models\LoyaltyCardProduct');

    }

}