<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderPickup extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $appends = ['created_at', 'updated_at'];
    public function order() {
        return $this->belongsTo('App\Models\Order');
    }

    public function pickup() {
        return $this->belongsTo('App\Models\Pickup')->withTrashed();
    }

    public function getDateFormatAttribute() {

        return $this->created_at ? Carbon::parse($this->created_at)->format('d/m/Y') : '';

    }

    public function getHourFormatAttribute() {

        return $this->created_at ? Carbon::parse($this->created_at)->format('H:i') : '';

    }

    public function getIdFormattedAttribute() {
        return $this->id;
    }

    public function getIsClosedAttribute() {
        return $this->closed == 0 ? 'FALSE' : 'TRUE';
    }

    public function getPickupNameAttribute() {
        return $this->pickup() ? $this->pickup()->first()->name : 'No Pickup found';
    }

    public function getRestaurantNameAttribute(){
        return $this->pickup()->first()->restaurant_name;
    }

}
