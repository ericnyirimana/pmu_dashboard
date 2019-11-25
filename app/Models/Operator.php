<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{



    public function getFieldShowAttribute() {

      return $this->name . ' ' . $this->last_name;
    }
}
