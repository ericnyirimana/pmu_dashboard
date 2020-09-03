<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PickupMealtype extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'pickup_mealtypes';
    protected $fillable = ['pickup_id', 'mealtype_id'];

    public $jsonFields = [
        'id', 'mealtype_id'
    ];

    public function mealtype() {

        return $this->belongsTo('App\Models\Mealtype');

    }

    public function pickup() {

        return $this->belongsToMany('App\Models\Pickup');

    }

    public function getTimeslot(){
        return $this->mealtype->name;
    }
}
