<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealtypeTranslation extends Model
{

    protected $fillable = ['name', 'mealtype_id', 'update_at', 'created_at', 'code'];

}
