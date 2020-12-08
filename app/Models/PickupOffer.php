<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PickupOffer extends Model
{

      use SoftDeletes;

      protected $fillable = ['quantity_offer', 'price', 'type_offer'];

      protected $dates = ['deleted_at'];

      protected $appends = ['pickup'];


      public function pickup() {

            return $this->belongsTo('App\Models\Pickup');

      }

      public function menus() {

            return $this->pickup->menus;
      }


      public function restaurant() {

            return $this->pickup->restaurant();

      }

      public function products() {

            return $this->pickup->products();

      }


}
