<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSection extends Model
{


    protected $fillable = ['menu_id', 'type', 'position', 'has_products_in_active_pickup'];

    protected $with = ['translate', 'menu'];


    public function translate() {

        return $this->hasOne('App\Models\MenuSectionTranslation')
            ->where('code', \App::getLocale())
            ->withDefault([
                'name' => ''
            ]);

    }

    public function translations() {

        return $this->hasMany('App\Models\MenuSectionTranslation');

    }

    public function products() {

        return $this->hasMany('App\Models\Product')->orderBy('position','ASC');

    }

    public function menu() {

        return $this->belongsTo('App\Models\Menu');

    }


    public function getNameAttribute() {

        return $this->translate->name;
    }

    public function getHasProductsInActivePickupAttribute() {
        foreach ($this->products as $product) {
            if ($product->hasActivePickups()) {
                return true;
            }
        }
        return false;
    }

    public function pickupSection() {

        return $this->hasMany('App\Models\PickupSection');

    }
}
