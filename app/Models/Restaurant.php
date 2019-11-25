<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{


  public $appends = [
      'field_show'
  ];

  public $fillable = [
      'name', 'brand_id', 'logo', 'image', 'merchant_stripe', 'location', 'coordinates'
  ];



    public function restaurants() {

          return $this->hasMany('App\Models\Restaurant');

    }


    public function getFieldShowAttribute() {

        return $this->name;

    }

}
