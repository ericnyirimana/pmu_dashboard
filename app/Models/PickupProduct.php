<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupProduct extends Model
{
    protected $fillable = ['product_id', 'pickup_id', 'quantity_offer', 'quantity_remain'];
}
