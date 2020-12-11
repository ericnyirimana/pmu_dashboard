<?php


namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SubscriptionTicket extends Model
{
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    public function order() {
        return $this->belongsTo('App\Models\Order');
    }

    public function pickup()
    {
        return $this->belongsTo('App\Models\Pickup')->withTrashed();;

    }

    public function products() {
        return $this->belongsToMany('App\Models\Product', 'subscription_ticket_products')->withPivot('quantity');
    }

    public function getCloseUrlAttribute() {
        return route('ticket.close_ticket_sub', ['id' => $this->id]);
    }

    public function getDateFormatAttribute() {

        return Carbon::parse($this->created_at)->format('d/m/Y');

    }

    public function getHourFormatAttribute() {

        return Carbon::parse($this->created_at)->format('H:i');

    }

    public function getIdFormattedAttribute() {
        return $this->id;
    }

    public function getPickupNameAttribute() {
        return $this->pickup() ? '[ABBONAMENTO] - '.$this->pickup()->first()->name : 'No Pickup found';
    }

    public function getRestaurantNameAttribute(){
        return $this->pickup()->first()->restaurant_name;
    }

    public function getIsClosedAttribute() {
        return $this->closed == 0 ? 'FALSE' : 'TRUE';
    }

}
