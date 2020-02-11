<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Restaurant extends Model
{


  public $appends = [
      'field_show', 'latitude', 'longitude',
  ];

  public $fillable = [
      'name', 'brand_id', 'logo', 'image', 'merchant_stripe', 'location', 'coordinates'
  ];



    public function brand() {

          return $this->belongsTo('App\Models\Brand');

    }

    public function products() {

          return $this->hasMany('App\Models\Product');

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


    public function getLatitudeAttribute() {

        $coord = explode(',', $this->coordinates);

        if ( count($coord) > 2 ) {
              return trim($coord[0]);
        }

    }



    public function getLongitudeAttribute() {

        $coord = explode(',', $this->coordinates);

        if ( count($coord) > 2 ) {
              return trim($coord[1]);
        }

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
