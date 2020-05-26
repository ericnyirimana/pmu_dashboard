<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderPickup extends Model
{

    protected $appends = ['created_at', 'updated_at'];
    public function order() {
        return $this->belongsTo('App\Models\Order');
    }

    public function pickup() {
        return $this->belongsTo('App\Models\Pickup')->withTrashed();
    }

    public function getDateFormatAttribute() {

        return $this->updated_at ? Carbon::parse($this->updated_at)->format('d/m/Y') : '';

    }

    public function getHourFormatAttribute() {

        return $this->updated_at ? Carbon::parse($this->updated_at)->format('H:i') : '';

    }

    public function getIdFormattedAttribute() {
        return $this->id;
    }
}
