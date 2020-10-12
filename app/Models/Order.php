<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    //protected $fillable = ['total_commission', 'total_amount', 'subtotal_amount', 'discounted_price'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $fillable = [
        'id', 'status', 'created_at',
    ];

    public function user() {

          return $this->hasOne('App\Models\User');

    }

    public function payment() {

        return $this->belongsTo('App\Models\Payment');

    }


    public function restaurant() {

          return $this->hasOne('App\Models\Restaurant');

    }


    public function pickup() {

          return $this->hasOne('App\Models\Pickup');

    }


    public function products() {

          return $this->hasMany('App\Models\Product');

    }

    public function orderProducts() {
        return $this->hasMany('App\Models\OrderProduct');
    }

    public function orderPickups() {
        return $this->hasMany('App\Models\OrderPickup');
    }

    public function getDateFormatAttribute() {

        return Carbon::parse($this->created_at)->format('d/m/Y');

    }

    public function getHourFormatAttribute() {

        return Carbon::parse($this->created_at)->format('H:i');

    }

    public function getRestaurantNameAttribute() {

        $orderPickup = $this->orderPickups()->first();
        if($orderPickup != null){
            return $orderPickup->restaurant->name;
        }
        return null;
    }
}
