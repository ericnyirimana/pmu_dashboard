<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoConfig extends Model
{
    protected $table = 'promo_config';

    public function getPromo() {

        return $this->belongsTo('App\Models\Promo');

    }

    public function getPromoValidation() {

        return $this->belongsTo('App\Models\PromoValidation');

    }
}
