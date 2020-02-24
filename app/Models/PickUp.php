<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pickup extends Model
{


    protected $fillable = ['type_pickup', 'timeslot_id', 'restaurant_id', 'media_id', 'status'];


    public function offer() {

          return $this->hasOne('App\Models\PickupOffer');

    }


    public function subscripton() {

          return $this->hasOne('App\Models\PickupSubscription');

    }


    public function products() {

          return $this->belongsToMany('App\Models\Product', 'pickup_products')->withPivot('quantity_offer', 'quantity_remain');

    }


    public function brand() {

          return $this->restaurant->brand();

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


    public function getDateAttribute() {

          return Carbon::create($this->data_ini)->format('d/m/Y') . ' - ' . Carbon::create($this->data_end)->format('d/m/Y');

    }


    public function getSectionsAttribute() {


          foreach($this->products as $product) {
                $pos = $product->section->name;
                if (empty($list[$pos])) $list[$pos] = array();

                array_push($list[$pos], $product);

          }

          return $list;


    }

    public function getNameAttribute() {

        return $this->translate->name;
    }



}
