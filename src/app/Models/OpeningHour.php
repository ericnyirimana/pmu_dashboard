<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpeningHour extends Model
{



    public $fillable = ['restaurant_id', 'day_of_week', 'hour_ini', 'hour_end', 'closed'];
}
