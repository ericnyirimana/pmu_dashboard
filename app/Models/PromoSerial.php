<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoSerial extends Model
{
    protected $table = 'promo_serial';
    public $scope;

    public function getPromo() {
        return $this->belongsTo('App\Models\Promo','promo_id', 'id');
    }

    public function getSubset() {
        return $this->belongsTo('App\Models\PromoSubset','promo_subset_id', 'id');
    }
}
