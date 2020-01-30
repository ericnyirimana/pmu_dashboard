<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{


    protected $table = 'menus';


    protected $fillable = ['name', 'restaurant_id'];


    public function brand() {

          return $this->restaurant->brand();

    }

    public function restaurant() {

          return $this->belongsTo('App\Models\Restaurant');

    }

    public function sections() {

          return $this->hasMany('App\Models\MenuSection')->orderBy('position', 'ASC');

    }


    public function userCanEdit(User $user) {

        return ($this->brand->owner_id == $user->id);

    }

    public function userCanView(User $user) {

        return ($this->brand->owner_id == $user->id);

    }


}
