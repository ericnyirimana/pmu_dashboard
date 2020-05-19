<?php

namespace App\Observers;

use Auth;
class MediaObserver
{



  public function saving(\App\Models\Media $media) {

        if( empty($media->brand_id) && !Auth::user()->is_super) {

            $media->brand_id = Auth::user()->brand->first()->id;
            if (Auth::user()->is_restaurant) {
                $media->restaurant_id = Auth::user()->restaurant->first()->id;
            }
        }

  }


}
