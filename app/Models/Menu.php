<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UserCanTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{

    use UserCanTrait, SoftDeletes;

    protected $table = 'menus';

    protected $fillable = ['name', 'restaurant_id', 'status_menu', 'has_products_in_active_pickup'];

    protected $dates = ['deleted_at'];

    public function company() {

          return $this->restaurant->company();

    }

    public function restaurant() {

          return $this->belongsTo('App\Models\Restaurant');

    }

    public function sections() {

          return $this->hasMany('App\Models\MenuSection')->orderBy('position', 'ASC');

    }

    public function sectionsDish() {

          return $this->hasMany('App\Models\MenuSection')->where('type', 'Dish')->orderBy('position', 'ASC');

    }
    
    public function sectionsDrink() {

          return $this->hasMany('App\Models\MenuSection')->where('type', 'Drink')->orderBy('position', 'ASC');

    }

    public function products() {

          return $this->restaurant->products();

    }


    public function getIsApprovedAttribute() {

        return ($this->status_menu == 'APPROVED');

    }

    public function getIsWaitingAttribute() {

        return ($this->status_menu == 'PENDING');

    }

    public function getIsDisabledAttribute() {

        return ($this->status_menu == 'DISABLED');

    }

    public function getIsDraftAttribute() {

        return ($this->status_menu == 'DRAFT');

    }

    public function getHasProductsInActivePickupAttribute() {
        foreach ($this->products as $product) {
            if ($product->hasActivePickups()) {
                return true;
            }
        }
        return false;
    }
}
