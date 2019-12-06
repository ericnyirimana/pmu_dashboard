<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function openingHours() {

          return $this->hasMany('App\Models\OpeningHour')->orderBy('hour_from');

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
                      array_push($openings[$item->day_of_week], ['from' => $item->hour_from, 'to' => $item->hour_to]);
                  }

            }

            return $openings;

    }

}
