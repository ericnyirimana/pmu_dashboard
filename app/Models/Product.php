<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UserCanTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{

    use UserCanTrait, \Staudenmeir\EloquentHasManyDeep\HasRelationships, SoftDeletes;

    protected $fillable = ['restaurant_id', 'menu_section_id', 'status', 'price', 'type', 'position', 'status_product'];



    protected $dates = ['deleted_at'];


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

    public function hasActivePickups() {
        foreach ($this->pickups as $pickupProduct) {
            $pickup = Pickup::find($pickupProduct->pickup_id);
            if ($pickup && $pickup->is_active_today) {
                return true;
            }
        }

        return false;
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

        return ($this->status_product == 'APPROVED');

    }

    public function getIsWaitingAttribute() {

        return ($this->status_product == 'PENDING');

    }

    public function getIsDisabledAttribute() {

        return ($this->status_product == 'DISABLED');

    }

    public function getIsDraftAttribute() {

        return ($this->status_product == 'DRAFT');

    }

}
