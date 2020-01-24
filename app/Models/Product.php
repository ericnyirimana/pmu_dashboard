<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    protected $fillable = ['position'];


    public function translation() {

        return $this->hasOne('App\Models\ProductTranslation')->where('code', \App::getLocale());

    }

    public function translations() {

        return $this->hasMany('App\Models\ProductTranslation');

    }


    public function section() {

        return $this->belongsTo('App\Models\Section');

    }
}
