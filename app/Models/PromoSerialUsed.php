<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoSerialUsed extends Model
{
    protected $table = 'promo_serial_used';

    public function promo() {

        return $this->hasOne('App\Models\Promo');

    }
}
