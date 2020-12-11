<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PickupSubscription extends Model
{

      use SoftDeletes;

  protected $fillable = ['pickup_id', 'quantity_offer', 'quantity_per_subscription', 'validate_months', 'price', 'type_offer', 'total_amount', 'discount', 'usable_company'];

  protected $dates = ['deleted_at'];

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

  public function getPriceAttribute(){

      $discountSubscription =  round(($this->discount / 100) * $this->total_amount,2);
      $subTotalAmount = $this->total_amount - $discountSubscription;

      return $subTotalAmount;

  }

}
