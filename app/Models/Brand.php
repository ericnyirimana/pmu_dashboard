<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{


    public $appends = [
        'field_show'
    ];

    public $fillable = [
        'name', 'media_id', 'corporate_name', 'vat', 'description', 'owner_id', 'status'
    ];



    public function products() {

          return $this->hasMany('App\Models\Product');

    }

    public function restaurants() {

          return $this->hasMany('App\Models\Restaurant');

    }


    public function owner() {

          return $this->belongsTo('App\Models\User', 'owner_id');

    }


    public function media() {

        return $this->belongsTo('App\Models\Media');

    }



    public function UserIsOwner(User $user) {

        return ($user->id == $this->owner_id);

    }



    public function getRestaurantsQuantityAttribute() {

        return $this->restaurants->count();

    }


    public function getFieldShowAttribute() {

        return $this->name;

    }


    public function getOwnerNameAttribute() {

        if (isset($this->owner)) {
            return $this->owner->name;
        }

    }


    public function getStatusNameAttribute() {

        if ($this->status) {
          return 'enable';
        }

        return 'disable';

    }

    public function getStatusColorAttribute() {

        if ($this->status) {
          return 'success';
        }

        return 'danger';

    }
}
