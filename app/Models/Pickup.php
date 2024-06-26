<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Monolog\Handler\IFTTTHandler;

class Pickup extends Model
{

    use SoftDeletes;

    protected $fillable = ['identifier', 'type_pickup', 'timeslot_id', 'restaurant_id', 'media_id', 'status', 'date_ini', 'date_end', 'suspended'];

    protected $dates = ['date_ini', 'date_end', 'deleted_at'];


    public function offer()
    {

        return $this->hasOne('App\Models\PickupOffer')->withTrashed();

    }


    public function subscription()
    {

        return $this->hasOne('App\Models\PickupSubscription')->withTrashed();

    }


    public function products()
    {

        return $this->belongsToMany('App\Models\Product', 'pickup_products')->withPivot('quantity_offer', 'quantity_remain');

    }

    public function orders()
    {

        return $this->hasMany('App\Models\OrderPickup');

    }

    public function ordersToday()
    {

        //return $this->hasMany('App\Models\OrderPickup')->where('date', '=', date('Y-m-d'));
        return $this->hasMany('App\Models\OrderPickup')
            ->where('date', '=', date('Y-m-d'))
            ->where('restaurant_status', '<>', 'CANCELED');

    }

    public function company()
    {

        return $this->restaurant->company();

    }

    public function restaurant()
    {

        return $this->belongsTo('App\Models\Restaurant');

    }

    public function timeslot()
    {
        return $this->belongsTo('App\Models\Timeslot');
    }


    public function translations()
    {

        return $this->hasMany('App\Models\PickupTranslation');

    }

    public function translate()
    {

        return $this->hasOne('App\Models\PickupTranslation')
            ->where('code', \App::getLocale())
            ->withDefault([
                'name' => '',
                'description' => ''
            ]);

    }

    public function media()
    {

        return $this->belongsToMany('App\Models\Media', 'pickup_media');

    }

    public function getDateAttribute()
    {

        return Carbon::parse($this->date_ini)->format('d-m-Y') . ' | ' . Carbon::parse($this->date_end)->format('d-m-Y');

    }

    public function getDateIniFormattedAttribute()
    {

        return Carbon::parse($this->date_ini)->format('d-m-Y');

    }

    public function getDateEndFormattedAttribute()
    {

        return Carbon::parse($this->date_end)->format('d-m-Y');

    }

    public function pickupSection()
    {

        return $this->hasMany('App\Models\PickupSection');

    }

    public function getSectionsAttribute()
    {

        if ($this->products->count() > 0) {
            foreach ($this->products as $product) {
                $pos = $product->section->name;
                if (empty($list[$pos])) $list[$pos] = array();

                array_push($list[$pos], $product);

            }

            return $list;
        }

    }

    public function getNameAttribute()
    {

        return $this->translate->name;
    }

    public function getPickUpTypeAttribute()
    {

        return $this->type_pickup;

    }

    public function getCoverImageAttribute()
    {

        if ($this->media) {

            return $this->media->getImageSize('medium');
        }

    }


    public function getPriceAttribute()
    {

        if ($this->type_pickup == 'offer') {
            return $this->offer->price;
        } else {
            return $this->subscription->price;
        }

    }

    public function getTypeOfferAttribute()
    {

        if ($this->type_pickup == 'offer') {
            return $this->offer->type_offer;
        } else {
            return $this->subscription->type_offer;
        }

    }

    public function getQuantityOfferAttribute()
    {

        if ($this->type_pickup == 'offer') {
            return $this->offer->quantity_offer;
        } else {
            return $this->subscription->quantity_offer;
        }

    }

    public function getQuantityRemainAttribute()
    {

        if ($this->type_pickup == 'offer') {
            $quantity = $this->offer->quantity_offer;
        } elseif ($this->type_pickup == 'subscription') {
            $quantity = $this->subscription->quantity_offer;
        }
        $sumTmp = 0;
        foreach ($this->ordersToday as $dailyOrder) {
            $sumTmp += $dailyOrder->quantity;
        }
        return $quantity - $sumTmp;

    }

    public function getValidateMonthsAttribute()
    {

        return $this->subscription->validate_months;

    }

    public function getQuantityPerSubscriptionAttribute()
    {

        return $this->subscription->quantity_per_subscription;

    }

    public function getPickupColorAttribute()
    {

        if ($this->type_pickup == 'offer') {
            return 'success';
        }

        return 'primary';

    }

    public function getRestaurantNameAttribute()
    {
        return $this->restaurant()->first()->name;
    }

    public function getIsActiveTodayAttribute()
    {
        if (!$this->restaurant->is_open_today) {
            return false; // RISTORANTE CHIUSO
        }
        if ($this->suspended) {
            return false; //SOSPESA
        }

        // Controllo informazioni offerta
        if (!isset($this->name) ||
            !isset($this->restaurant) ||
            $this->products->count() < 1) {
            return false; //BOZZA
        }

        //Controllo quantità
        if ($this->quantity_remain <= 0) {
            return false; //esaurita
        }

        $today = Carbon::now();
        if ($today->lt(Carbon::parse($this->date_ini))) {
            return false; //PROGRAMMATA
        } else {
            if (Carbon::parse($this->date_ini)->isToday() || $today->lt(Carbon::parse($this->date_end)) ||
                Carbon::parse($this->date_end)->isToday()) {
                //controllo orario timeslot
                $endTimeslot = Carbon::now();
                $endTimeslot->hour(Carbon::parse($this->timeslot->hour_end)->hour);
                $endTimeslot->minute(Carbon::parse($this->timeslot->hour_end)->minute);
                if ($today->lte($endTimeslot->subMinute(30))) {
                    return true; //IN CORSO
                } else {
                    return false; //SCADUTA SE PASSATI I 30MIN ALLA FINE
                }
            }
            return false; //SCADUTA
        }
    }


    public function getStatusPickupAttribute()
    {

        if ($this->suspended) {
            return trans('labels.pickup_status.suspended'); // SOSPESA
        }
        // Controllo informazioni offerta
        if (!isset($this->name) ||
            !isset($this->restaurant) ||
            $this->products->count() < 1) {
            return trans('labels.pickup_status.draft'); //BOZZA
        }

        //Controllo quantità
        if ($this->quantity_remain <= 0) {
            return trans('labels.pickup_status.exhausted'); //esaurita
        }

        $today = Carbon::now();
        if ($today->lt(Carbon::parse($this->date_ini))) {
            return trans('labels.pickup_status.scheduled'); //PROGRAMMATA
        } else {
            if (Carbon::parse($this->date_ini)->isToday() || $today->lt(Carbon::parse($this->date_end)) ||
                Carbon::parse($this->date_end)->isToday()) {
                return trans('labels.pickup_status.progress');
            }

            return trans('labels.pickup_status.expired'); //SCADUTA
        }
    }

    public function getIsExpiredAttribute() {
        $today = Carbon::now();
        if ($today->lt(Carbon::parse($this->date_ini))) {
            return false; //PROGRAMMATA
        } else {
            if (Carbon::parse($this->date_ini)->isToday() || $today->lt(Carbon::parse($this->date_end)) ||
                Carbon::parse($this->date_end)->isToday()) {
                return false;
            }

            return true; //SCADUTA
        }
    }


    public function getIsNotEditableAttribute() {
        if ($this->type_pickup == 'offer' && $this->ordersToday->count() > 0) {
            return true;
        } else if ($this->type_pickup == 'subscription' && $this->orders->count() > 0) {
            return true;
        }
        return false;
    }

    public function pickup_mealtype() {

        return $this->hasMany('App\Models\PickupMealtype');
        
    }

    public function getDiscountAttribute()
    {

        if ($this->type_pickup == 'subscription') {
            return $this->subscription->discount;
        }

    }

    public function getUsableCompanyAttribute()
    {

        if ($this->type_pickup == 'subscription') {
            return $this->subscription->usable_company;
        }

    }

}
