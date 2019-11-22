<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{


  public $appends = [
    'foreign_id', 'field_show'
  ];



    public function getForeignIdAttribute() {

        return $this->brand_id;

    }


    public function getFieldShowAttribute() {

        return $this->name;

    }
}
