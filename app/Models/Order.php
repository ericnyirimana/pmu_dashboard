<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{


    public $fillable = [
        'id', 'status', 'created_at',
    ];

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

    public function getDateFormatAttribute() {

        return Carbon::parse($this->created_at)->format('d/m/Y');

    }

    public function getHourFormatAttribute() {

        return Carbon::parse($this->created_at)->format('H:i');

    }

}
