<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{


    public function user() {

          return $this->hasOne('App\Models\User');

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
