<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pickup extends Model
{

    use SoftDeletes;

    protected $fillable = ['identifier', 'type_pickup', 'timeslot_id', 'restaurant_id', 'media_id', 'status', 'date_ini', 'date_end'];

    protected $dates = ['date_ini', 'date_end', 'deleted_at'];


    public function offer()
    {

        return $this->hasOne('App\Models\PickupOffer');

    }


    public function subscription()
    {

        return $this->hasOne('App\Models\PickupSubscription');

    }


    public function products()
    {

        return $this->belongsToMany('App\Models\Product', 'pickup_products')->withPivot('quantity_offer', 'quantity_remain');

    }

    public function orders()
    {

        return $this->hasMany('App\Models\OrderPickup');

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


    public function getDateAttribute()
    {

        return Carbon::parse($this->date_ini)->format('d-m-Y') . ' | ' . Carbon::parse($this->date_end)->format('d-m-Y');

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

    public function media()
    {

        return $this->belongsToMany('App\Models\Media', 'pickup_media');

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
            return $this->offer->quantity_remain;
        } else {
            return $this->subscription->quantity_remain;
        }

    }

    public function getValidateDaysAttribute()
    {

        return $this->subscription->validate_days;

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

    public function getIsActiveTodayAttribute()
    {
        $today = Carbon::now();
        return ($today->gte($this->date_ini) &&  $today->lte($this->date_end));
    }

}
