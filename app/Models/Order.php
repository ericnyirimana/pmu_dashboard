<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    //protected $fillable = ['total_commission', 'total_amount', 'subtotal_amount', 'discounted_price'];

    public function user() {

          return $this->hasOne('App\Models\User');

    }

    public function payment() {

        return $this->hasOne('App\Models\Payment');

    }


    public function restaurant() {

          return $this->hasOne('App\Models\Restaurant');

    }


    public function pickup() {

          return $this->hasOne('App\Models\Pickup');

    }



    public function products() {

          return $this->hasMany('App\Models\Product');

    }

}
