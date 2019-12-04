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
                  $folder = 'media';
              break;

              case 'large':
                  $folder = 'media/large/';
              break;

              case 'thumbnail':
                  $folder = 'media/thumbnail/';
              break;

              default:
                  $folder = 'media/';
              break;

          }

          return Storage::disk('s3')->url($folder . $this->file);

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
