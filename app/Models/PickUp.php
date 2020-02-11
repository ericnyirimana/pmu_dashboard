<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{


  public function offer() {

        return $this->hasOne('App\Models\PickupOffer');

  }


  public function subscripton() {

        return $this->hasOne('App\Models\PickupSubscription');

  }


  public function products() {

        return $this->belongsToMany('App\Models\Product', 'pickup_products');

  }


  public function restaurant() {

        return $this->belongsTo('App\Models\Restaurant');

  }


    public function translations() {

        return $this->hasMany('App\Models\PickupTranslation');

    }



    public function translate() {

        return $this->hasOne('App\Models\PickupTranslation')
        ->where('code', \App::getLocale())
        ->withDefault([
          'name' => '',
          'description' => ''
        ]);

    }



}
