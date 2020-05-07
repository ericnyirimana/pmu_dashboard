<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPickup extends Model
{

    public function order() {
        return $this->belongsTo('App\Models\Order');
    }

    public function pickup() {
        return $this->belongsTo('App\Models\Pickup');
    }

}
