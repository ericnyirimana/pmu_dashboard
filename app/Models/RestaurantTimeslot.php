<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantTimeslot extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['restaurant_id', 'timeslots', 'created_at', 'updated_at', 'deleted_at'];
    protected $table = 'restaurant_timeslots';

    protected $casts = [
        'timeslots' => 'array'
    ];

    public function restaurant() {

        return $this->hasOne('App\Models\Restaurant');

    }
}
