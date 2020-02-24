<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Showcase extends Model
{


  public $fillable = [
      'type', 'items'
  ];



  public function pickups() {

      return $this->belongsToMany('App\Models\Pickup');

  }

  public function translate() {

      return $this->hasOne('App\Models\ShowcaseTranslation')->where('code', \App::getLocale());

  }

  public function translations() {

      return $this->hasMany('App\Models\ShowcaseTranslation');

  }


}
