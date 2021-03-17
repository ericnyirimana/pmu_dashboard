<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderPickup extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    // protected $appends = ['created_at', 'updated_at'];
    public $fillable = ['closed'];
    public function order() {
        return $this->belongsTo('App\Models\Order');
    }

    public function pickup() {
        return $this->belongsTo('App\Models\Pickup')->withTrashed();
    }



    public function delegate()
    {
        return $this->belongsTo('App\Models\Delegate');

    }

    public function user()
    {

        return $this->belongsTo('App\Models\User');

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
        return $this->restaurant()->restaurant_name;
    }
    
    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function company()
    {
        return $this->restaurant->company();
    }

    public function getExpiryStatusAttribute()
    {
        $pickup = $this->pickup->first();
        if($pickup->type_pickup == 'subscription'){

            $pickup_valididty = $pickup->validate_months;

            $order_pickup_date = $this->created_at;

            $pickup_creation_date = $pickup->created_at;
        
            $interval = date_diff($pickup_creation_date, $order_pickup_date);
        
            $interval_month = $interval->format('%m');

            if($interval_month >= $pickup_valididty){
                return trans('labels.order_pickup_status.expired');
            }
            return trans('labels.order_pickup_status.enabled');
        }
    }

    public function getValidityDateIntervalAttribute()
    {
        $pickup = $this->pickup->first();
        if($pickup->type_pickup == 'subscription'){
            $order_pickup_date = $this->created_at ? Carbon::parse($this->created_at)->format('Y-m-d') : '';
            $pickup_creation_date = $pickup->created_at ? Carbon::parse($pickup->created_at)->format('Y-m-d') : '';

            return $pickup_creation_date.' | '.$order_pickup_date;
        }
    }

}
