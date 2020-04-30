<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UserCanTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{

    use UserCanTrait;

    use SoftDeletes;

    protected $table = 'menus';

    protected $fillable = ['name', 'restaurant_id'];

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





}
