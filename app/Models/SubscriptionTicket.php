<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SubscriptionTicket extends Model
{
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
}
