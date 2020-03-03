<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    protected $fillable = ['media_id', 'category_type_id', 'type', 'emoji'];



    public function translate() {

        return $this->hasOne('App\Models\CategoryTranslation')->where('code', \App::getLocale());

    }

    public function translations() {

        return $this->hasMany('App\Models\CategoryTranslation');

    }

    public function media() {

        return $this->belongsTo('App\Models\Media');

    }



}
