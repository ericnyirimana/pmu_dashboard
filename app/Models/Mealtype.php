<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mealtype extends Model
{



  public function translate() {

      return $this->hasOne('App\Models\MealtypeTranslation')->where('code', \App::getLocale());

  }

  public function translations() {

      return $this->hasMany('App\Models\MealtypeTranslation');

  }


  public function getNameAttribute() {

        return $this->translate->name;
  }

}
