<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mealtype extends Model
{

    use SoftDeletes;

    public $fillable = ['id', 'hour_ini', 'hour_end', 'all_day'];

    protected $dates = ['deleted_at'];

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

  public function pickup_mealtype() {

        return $this->hasMany('App\Models\PickupMealtype');

  }

}
