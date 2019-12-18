<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Showcases extends Model
{


  public $fillable = [
      'title'
  ];



  public function pickUps() {

        return $this->hasMany('App\Models\PickUp');

  }


  public function timeSlots() {

        return $this->hasMany('App\Models\TimeSlot');

  }



}
