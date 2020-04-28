<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Showcase extends Model
{

    public $fillable = ['id', 'title', 'type', 'items'];

    public function translate() {

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

        return $this->belongsToMany('App\Models\Category', 'showcase_categories');

    }

    public function restaurants() {

        return $this->belongsToMany('App\Models\Restaurant', 'showcase_restaurants');

    }

    public function timeslots() {

        return $this->belongsToMany('App\Models\Timeslot', 'showcase_timeslots');

    }

    public function mealtypes() {

        return $this->belongsToMany('App\Models\Mealtype', 'showcase_mealtypes');

    }

}
