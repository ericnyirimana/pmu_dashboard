<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UserCanTrait;


class Product extends Model
{

    use UserCanTrait, \Staudenmeir\EloquentHasManyDeep\HasRelationships;



    protected $fillable = ['restaurant_id', 'menu_section_id', 'status', 'price', 'type', 'position'];


    public function translation() {

        return $this->hasOne('App\Models\ProductTranslation')->where('code', \App::getLocale());

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



    public function translations() {

        return $this->hasMany('App\Models\ProductTranslation');

    }

    public function media() {

          return $this->belongsToMany('App\Models\Media', 'products_media');

    }

    public function section() {

        return $this->belongsTo('App\Models\MenuSection', 'menu_section_id');

    }

    public function menu() {

        return $this->section->menu;

    }


    public function brand() {

          return $this->restaurant->brand();

    }

    public function restaurant() {

          return $this->belongsTo('App\Models\Restaurant');

    }


    public function getColorTypeAttribute() {

        if($this->type == 'Dish') {
          return 'primary';
        } else {
          return 'success';
        }

    }




}
