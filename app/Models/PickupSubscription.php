<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupSubscription extends Model
{


  protected $fillable = ['pickup_id', 'quantity_offer', 'quantity_per_subscription', 'validate_months', 'price', 'type_offer', 'total_amount', 'discount'];

  protected $appends = ['pickup'];


  public function pickup() {

        return $this->belongsTo('App\Models\Pickup');

  }

  public function menus() {

        return $this->pickup->menus;
  }


  public function restaurant() {

        return $this->pickup->restaurant();

  }

  public function products() {

        return $this->pickup->products();

  }

  public function getOffersPurchasedAttribute() {
      return SubscriptionTicket::where('pickup_id', $this->pickup->id)->get()->sum('quantity');
  }
}
