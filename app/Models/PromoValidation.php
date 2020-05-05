<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoValidation extends Model
{
    protected $table = 'promo_validation';

    protected $casts = [
        'rules' => 'array'
    ];

    public function getPromoConfig() {

        return $this->hasOne('App\Models\PromoConfig');

    }
}
