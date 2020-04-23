<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Showcase extends Model
{

    public $fillable = ['id', 'title', 'type', 'items'];

    public function translate()
    {

        return $this->hasOne('App\Models\ShowcaseTranslation')
            ->where('code', \App::getLocale())
            ->withDefault([
                'name' => '',
            ]);

    }

    public function translations()
    {

        return $this->hasMany('App\Models\ShowcaseTranslation');

    }

    public function getNameAttribute() {

        return $this->translate->name;
    }

    public function categories() {

        return $this->belongsToMany('App\Models\Category', 'categories')->where('type', 'categories');

    }

    public function restaurants() {

        return $this->belongsToMany('App\Models\Restaurant', 'restaurants')->where('type', 'restaurants');

    }

    public function timeslots() {

        return $this->belongsToMany('App\Models\Timeslot', 'timeslots')->where('type', 'timeslots');

    }

}
