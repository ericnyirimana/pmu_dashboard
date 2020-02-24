<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{



      public function pickups() {

            return $this->hasMany('App\Models\Pickup');

      }


      public function mealtype() {

            return $this->belongsTo('App\Models\Mealtype');

      }



      public function getNameAttribute() {

            return $this->mealtype->name;

      }

      public function getFieldShowAttribute() {

          return $this->name;

      }



      public function getUpdatedAtAttribute() {

            return $this->updated_at->timestamp ?? '';

      }


}
