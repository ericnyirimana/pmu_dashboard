<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantIntegration extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['restaurant_id', 'integration_type'];
    protected $table = 'restaurant_integrations';

    public function restaurant() {

        return $this->belongsToMany('App\Models\Restaurant');

    }
}