<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{


    public $appends = [
        'field_show'
    ];

    public $fillable = [
        'name', 'image', 'corporate_name', 'vat', 'description', 'owner_id', 'status'
    ];



    public function restaurants() {

          return $this->hasMany('App\Models\Restaurant');

    }


    public function owner() {

          return $this->belongsTo('App\Models\Operator', 'owner_id');

    }


    public function getImageSize($size = 'original') {

          switch($size) {

              case 'original':
                  $path = '/storage/brands/';
              break;

              case 'large':
                  $path = '/storage/brands/large/';
              break;

              case 'thumbnail':
                  $path = '/storage/brands/thumbnail/';
              break;

              default:
                  $path = '/storage/brands/';
              break;

          }

          return asset( $path . $this->image);

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
