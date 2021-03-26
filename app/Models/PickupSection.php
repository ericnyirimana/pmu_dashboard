<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PickupSection extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'pickup_sections';
    protected $fillable = ['pickup_id', 'menu_section_id', 'menu_section_identifier', 'quantity_min_per_section', 'quantity_max_per_section'];

    public function pickup(){

        return $this->belongsTo('App\Models\Pickup');

    }

    public function section(){

        return $this->belongsTo('App\Models\MenuSection');

    }

}
