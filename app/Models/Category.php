<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;

    protected $fillable = ['media_id', 'category_type_id', 'type', 'emoji', 'hide'];

    protected $dates = ['deleted_at'];

    public function translate() {

        return $this->hasOne('App\Models\CategoryTranslation')
            ->where('code', \App::getLocale())
            ->withDefault([
                'name' => ''
            ]);

    }

    public function translations() {

        return $this->hasMany('App\Models\CategoryTranslation');

    }

    public function media() {

        return $this->belongsTo('App\Models\Media');

    }



}
