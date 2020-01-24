<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{


    protected $fillable = ['menu_id', 'type', 'position'];


    public function translation() {

        return $this->hasOne('App\Models\SectionTranslation')->where('code', \App::getLocale());

    }

    public function translations() {

        return $this->hasMany('App\Models\SectionTranslation');

    }

    public function products() {

        return $this->hasMany('App\Models\Product')->orderBy('position','ASC');

    }
}
