<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'promo';

    public function getPromoConfig() {

        return $this->hasOne('App\Models\PromoConfig');

    }
}
