<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UserCanTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


class LoyaltyCardProduct extends Model
{

    use SoftDeletes;

    public $appends = [
        'field_show'
    ];

    protected $fillable = ['id', 'price', 'type'];


    protected $dates = ['deleted_at'];


    public function translate()
    {

        return $this->hasOne('App\Models\LoyaltyCardProductTranslations')
            ->where('code', \App::getLocale())
            ->withDefault([
                'name' => ''
            ]);

    }

    public function translations()
    {

        return $this->hasMany('App\Models\LoyaltyCardProductTranslations');

    }

    public function product_restaurant()
    {

        return $this->hasMany('App\Models\LoyaltyCardProductRestaurant');

    }


    public function getNameAttribute()
    {

        return $this->translate->name;
    }

    public function getFieldShowAttribute() {

        return $this->translate->name;

    }

    public function categories()
    {

        return $this->belongsToMany('App\Models\Category', 'loyalty_card_product_categories');

    }

}