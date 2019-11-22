<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    //

    protected $fillable = ['brand_id', 'name', 'file'];

    protected $appends = ['thumbnail', 'extension', 'brand_name'];


    public function brand() {

          return $this->belongsTo('App\Models\Brand');

    }



    public function getImageSize($size = 'original') {

          switch($size) {

              case 'original':
                  $path = '/storage/media/';
              break;

              case 'large':
                  $path = '/storage/media/large/';
              break;

              case 'thumbnail':
                  $path = '/storage/media/thumbnail/';
              break;

              default:
                  $path = '/storage/media/';
              break;

          }

          return asset( $path . $this->file);

    }



    public function getExtensionAttribute() {

          $aux = (explode('.', $this->file));
          $ext = end($aux);
          return strtoupper($ext);

    }


    public function getBrandNameAttribute() {

          return $this->brand->name;

    }


    public function foreign_id($field) {

          $id = $field . '_id';
          return $this->$id;

    }
}
