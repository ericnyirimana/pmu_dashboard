<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timeslot extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $fillable = ['restaurant_id', 'mealtype_id', 'hour_ini', 'hour_end', 'fixed', 'identifier'];

    protected $appends = ['name'];

    public function pickups()
    {

        return $this->hasMany('App\Models\Pickup');

    }


    public function mealtype()
    {

        return $this->belongsTo('App\Models\Mealtype');

    }

    public function restaurant()
    {

        return $this->belongsTo('App\Models\Restaurant');

    }

    public function getRestaurantNameAttribute()
    {
        return $this->restaurant->name;
    }

    public function getNameAttribute()
    {

        return $this->mealtype->name;

    }

    public function getFieldShowAttribute()
    {

        return $this->name;

    }


    public function getUpdatedAtAttribute()
    {

        return $this->updated_at->timestamp ?? '';

    }


}
