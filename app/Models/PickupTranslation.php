<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupTranslation extends Model
{

    protected $fillable = ['pickup_id', 'name', 'description', 'code'];
}
