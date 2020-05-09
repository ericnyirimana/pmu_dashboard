<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mealtype extends Model
{

    public $fillable = ['id', 'hour_ini', 'hour_end'];

  public function translate() {

      return $this->hasOne('App\Models\MealtypeTranslation')
          ->where('code', \App::getLocale())
          ->withDefault([
              'name' => ''
          ]);

  }

  public function translations() {

      return $this->hasMany('App\Models\MealtypeTranslation');

  }


  public function getNameAttribute() {

        return $this->translate->name;
  }

}
