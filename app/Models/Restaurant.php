<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Restaurant extends Model
{


  public $appends = [
      'field_show'
  ];

  public $fillable = [
      'name', 'brand_id', 'logo', 'image', 'merchant_stripe', 'address', 'latitude', 'longitude',
      'billing_address', 'billing_latitude', 'billing_longitude', 'iva', 'iban', 'fee', 'pec', 'id_code', 'stripe_account_id'
  ];




      public function translations() {

          return $this->hasMany('App\Models\RestaurantTranslation');

      }

      public function translate() {

          return $this->hasOne('App\Models\RestaurantTranslation')
          ->where('code', \App::getLocale())
          ->withDefault([
            'description' => ''
          ]);

      }

    public function company() {

          return $this->belongsTo('App\Models\Company', 'brand_id');

    }

    public function products() {

          return $this->hasMany('App\Models\Product');

    }

    public function menu() {

          return $this->hasOne('App\Models\Menu');

    }

//    public function user() {
//
//        return $this->hasMany('App\Models\User');
//
//    }

    public function orders() {

          return $this->hasMany('App\Models\Order');

    }

    public function timeslots() {

          return $this->hasMany('App\Models\Timeslot');

    }


    public function media() {

          return $this->belongsToMany('App\Models\Media', 'restaurant_media');

    }

    public function openingHours() {

          return $this->hasMany('App\Models\OpeningHour')->orderBy('hour_ini');

    }

    public function closedDays() {

          return $this->hasMany('App\Models\ClosedDay')->orderBy('date');

    }


    public function getFieldShowAttribute() {

        return $this->name;

    }


    /**
    * [
    *  'monday' => [['from' => '10:00',  'to': '14:00']]
    *  'tuesday' => []
    * ]
    *
    **/
    public function getListOpeningHoursAttribute() {

            $openings = array();

            foreach ($this->openingHours as $item) {

                  if ( !isset($openings[$item->day_of_week]) ) {
                        $openings[$item->day_of_week] = array();
                  }

                  // only return if it is open
                  if (!$item['closed']) {
                      array_push($openings[$item->day_of_week], ['from' => $item->hour_ini, 'to' => $item->hour_end]);
                  }

            }

            return $openings;

    }


    /**
    * [
    *  'monday' => [['from' => '10:00',  'to': '14:00']]
    *  'tuesday' => []
    * ]
    *
    **/
    public function getListClosedDaysAttribute() {

            $closedDays = array();

            foreach ($this->closedDays as $item) {

                  array_push($closedDays, ['name' => $item->name, 'date' => Carbon::create($item->date)->format('d-m-Y'), 'repeat' => $item->repeat ]);


            }

            return $closedDays;

    }

}
