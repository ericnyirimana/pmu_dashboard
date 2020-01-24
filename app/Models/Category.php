<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    protected $fillable = ['media_id', 'category_type_id'];



    public function type() {

        return $this->belongsTo('App\Models\CategoryType', 'category_type_id');

    }


    public function translation() {

        return $this->hasOne('App\Models\CategoryTranslation')->where('code', \App::getLocale());

    }

    public function translations() {

        return $this->hasMany('App\Models\CategoryTranslation');

    }

    public function media() {

        return $this->belongsTo('App\Models\Media');

    }


    public static function getCategoriesByType() {

        $categories = Category::all();

        $list['foods'] = array();
        $list['dietary'] = array();
        $list['allergens'] = array();

        foreach($categories as $cat) {
            if($cat->type->name == 'Food Category') {
                array_push($list['foods'], $cat->translation->name);
            }
            if($cat->type->name == 'Dietary') {
                array_push($list['dietary'], $cat->translation->name);
            }
            if($cat->type->name == 'Allergens') {
                array_push($list['allergens'], $cat->translation->name);
            }
        }

        return $list;

    }
}
