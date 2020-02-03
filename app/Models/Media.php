<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Traits\UserCanTrait;

class Media extends Model
{


    use UserCanTrait;

    protected $fillable = ['brand_id', 'name', 'file'];

    protected $appends = [ 'extension', 'brand_name'];


    public function brand() {

          return $this->belongsTo('App\Models\Brand');

    }


    public function media() {

          return $this->hasMany('App\Models\Media');

    }


    public function getImageSize($size) {

          $folder = 'media/'.$size.'/';

          return Storage::disk('s3')->url($folder . $this->file);

    }



    public function getExtensionAttribute() {

          $aux = (explode('.', $this->file));
          $ext = end($aux);
          return strtoupper($ext);

    }


    public function getBrandNameAttribute() {

          if (isset($this->brand)) {
            return $this->brand->name;
          }

          return '';


    }


    public function foreign_id($field) {

          $id = $field . '_id';
          return $this->$id;

    }
}
