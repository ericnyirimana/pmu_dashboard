<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;



    protected $fillable = ['restaurant_id', 'status', 'price', 'type', 'position'];


    public function translation() {

        return $this->hasOne('App\Models\ProductTranslation')->where('code', \App::getLocale());

    }

    public function translations() {

        return $this->hasMany('App\Models\ProductTranslation');

    }

    public function media() {

          return $this->belongsToMany('App\Models\Media', 'products_media');

    }

    public function sections() {

        return $this->belongsToMany('App\Models\MenuSection', 'product_menu_sections');

    }

    public function menus() {

        return $this->hasManyDeepFromRelations($this->sections(), (new MenuSection)->menu());

    }


    public function brand() {

          if ($this->restaurant) {
              return $this->restaurant->brand();
          }


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
