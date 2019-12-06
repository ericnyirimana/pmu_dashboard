<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpeningHour extends Model
{



    public $fillable = ['restaurant_id', 'day_of_week', 'hour_from', 'hour_to', 'closed'];
}
