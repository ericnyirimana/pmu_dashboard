<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSection extends Model
{


    protected $fillable = ['menu_id', 'type', 'position'];

    protected $with = ['translation', 'menu'];


    public function translation() {

        return $this->hasOne('App\Models\MenuSectionTranslation')->where('code', \App::getLocale());

    }

    public function translations() {

        return $this->hasMany('App\Models\MenuSectionTranslation');

    }

    public function products() {

        return $this->hasMany('App\Models\Product')->orderBy('position','ASC');

    }

    public function menu() {

        return $this->belongsTo('App\Models\Menu');

    }
}
