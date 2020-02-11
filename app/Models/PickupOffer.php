<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupOffer extends Model
{



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
