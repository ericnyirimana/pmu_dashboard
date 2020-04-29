<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UserCanTrait;


class Product extends Model
{

    use UserCanTrait, \Staudenmeir\EloquentHasManyDeep\HasRelationships;


    protected $fillable = ['restaurant_id', 'menu_section_id', 'status', 'price', 'type', 'position', 'status_product'];


    public function translate() {

        return $this->hasOne('App\Models\ProductTranslation')
            ->where('code', \App::getLocale())
            ->withDefault([
                'name' => ''
            ]);

    }

    public function translations() {

        return $this->hasMany('App\Models\ProductTranslation');

    }

    public function categories() {

        return $this->belongsToMany('App\Models\Category', 'products_categories');

    }

    public function foods() {

        return $this->belongsToMany('App\Models\Category', 'products_categories')->where('type', 'Food');

    }

    public function allergens() {

        return $this->belongsToMany('App\Models\Category', 'products_categories')->where('type', 'Allergen');

    }

    public function dietaries() {

        return $this->belongsToMany('App\Models\Category', 'products_categories')->where('type', 'Dietary');

    }

    public function media() {

          return $this->belongsToMany('App\Models\Media', 'products_media');

    }

    public function section() {

        return $this->belongsTo('App\Models\MenuSection', 'menu_section_id');

    }

    public function pickups() {
        return $this->hasMany('App\Models\PickupProduct');
    }

    public function menu() {

        return $this->section->menu;

    }

    public function company() {

          return $this->restaurant->company();

    }

    public function restaurant() {

          return $this->belongsTo('App\Models\Restaurant');

    }

    public function getNameAttribute() {

        return $this->translate->name;
    }


    public function getColorTypeAttribute() {

        if($this->type == 'Dish') {
          return 'primary';
        } else {
          return 'success';
        }

    }


    public function getIsApprovedAttribute() {

        return ($this->status_product == 'Approved');

    }

    public function getIsWaitingAttribute() {

        return ($this->status_product == 'Pending approved');

    }

    public function getIsDisabledAttribute() {

        return ($this->status_product == 'Disabled');

    }

//    public function getColorStatusAttribute() {
//
//        if($this->status_product == 'Approved') {
//            return 'success';
//        } elseif($this->status_product == 'Pending approved') {
//            return 'primary';
//        } else {
//            return 'danger';
//        }
//
//    }



}
