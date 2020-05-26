<?php


namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SubscriptionTicket extends Model
{
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    public function pickup()
    {
        return $this->belongsTo('App\Models\Pickup');

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
        return 'SUB' . $this->id;
    }

}
