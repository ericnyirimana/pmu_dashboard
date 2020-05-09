<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Traits\UserCanTrait;

class Media extends Model
{


    use UserCanTrait;

    protected $fillable = ['brand_id', 'name', 'file'];

    protected $appends = [ 'extension', 'company_name'];


    public function company() {

          return $this->belongsTo('App\Models\Company', 'brand_id');

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


    public function getCompanyNameAttribute() {

          if (isset($this->company)) {
            return $this->company->name;
          }

          return '';


    }


    public function foreign_id($field) {

          $id = $field . '_id';
          return $this->$id;

    }
}
