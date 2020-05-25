<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sub', 'email', 'password', 'role', 'profile', 'brand'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function company()
    {

        return $this->hasOne('App\Models\Company', 'owner_id');

    }

    public function brand() {
        return $this->belongsToMany('App\Models\Company', 'user_brands', 'user_id', 'brand_id');
    }

    public function restaurant()
    {
        return $this->belongsToMany('App\Models\Restaurant', 'user_restaurants', 'user_id', 'restaurant_id');
    }

    protected function getJsonAttributes()
    {

        return json_decode($this->profile);

    }

    public function getNameAttribute()
    {

        $profile = $this->getJsonAttributes();

        if ($profile) {
            return $profile->name;
        }


    }


    public function getFieldShowAttribute()
    {

        return $this->getNameAttribute();

    }


    public function getCreatedAtHFAttribute()
    {

        return $this->created_at->format('d-m-Y H:i') ?? '';

    }


    public function getUpdatedAtHFAttribute()
    {

        return $this->updated_at->format('d-m-Y H:i') ?? '';

    }


    public function getIsSuperAttribute()
    {

        return (($this->role == 'ADMIN') || ($this->role == 'PMU'));

    }


    public function getIsAdminAttribute()
    {

        return ($this->role == 'ADMIN');

    }

    public function getIsPmuAttribute()
    {

        return ($this->role == 'PMU');

    }

    public function getIsOwnerAttribute()
    {

        return ($this->role == 'OWNER');

    }

    public function getIsRestaurantAttribute()
    {

        return ($this->role == 'RESTAURATEUR');

    }

    public function getIsCustomerAttribute()
    {

        return ($this->role == 'CUSTOMER');

    }

    public function getIsManagerAttribute() {
        return ($this->is_owner ||
            $this->is_restaurant);
    }

//    public function getIsSalesAssistantAttribute()
//    {
//
//        return ($this->role == 'SALES ASSISTANT');
//
//    }


}
