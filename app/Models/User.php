<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function getFullNameAttribute() {

          return $this->name . ' ' . $this->last_name;

    }


    public function getCreatedAtHFAttribute() {

        return $this->created_at->format('d-m-Y H:i') ?? '';

    }

    public function getUpdatedAtHFAttribute() {

        return $this->updated_at->format('d-m-Y H:i') ?? '';

    }
}
