<?php

namespace App\Models;

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

    public function getIsApprovedAttribute() {

        return ($this->status == 'APPROVED');

    }

    public function getIsWaitingAttribute() {

        return ($this->status == 'PENDING');

    }

    public function getIsRejectedAttribute() {

        return ($this->status == 'REJECTED');

    }

}
