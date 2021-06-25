<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSubscription extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');

    }

    public function orderPickups() {
        return $this->belongsTo('App\Models\OrderPickup', 'order_pickup_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');

    }

}
