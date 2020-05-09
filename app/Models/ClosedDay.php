<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClosedDay extends Model
{


    public $fillable = ['restaurant_id', 'name', 'date', 'repeat'];
}
