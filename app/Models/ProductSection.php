<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSection extends Model
{

    protected $table = 'product_menu_sections';

    protected $fillable = ['menu_section_id', 'product_id'];



    public function product() {

        return $this->belongsTo('App\Models\Product');

    }

    public function section() {

        return $this->belongsTo('App\Models\MenuSection');

    }
}
