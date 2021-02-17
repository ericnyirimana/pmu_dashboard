<?php

namespace App\Models;

use App\Traits\OrganizeJsonTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delegate extends Model
{
    use OrganizeJsonTrait, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'delegates';

    public $jsonFields = [
        'identifier', 'email_to', 'created_at'
    ];

    protected $hidden = array('id', 'updated_at', 'deleted_at');

}
