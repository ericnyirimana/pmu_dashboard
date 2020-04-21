<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShowcaseTranslation extends Model
{

    protected $fillable = ['id', 'identifier', 'type', 'items', 'update_at', 'created_at', 'deleted_at', 'title'];

}
