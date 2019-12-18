<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Storage;
use Image;


class FileManager
{



      public static function saveImage( $folder , $image ): string {

            $name = uniqid() . $image->getClientOriginalName();

            Storage::disk('s3')->put( $folder . $name, file_get_contents($image) );

            self::saveThumbnailImage( $folder, $name, $image );

            self::saveMediumlImage( $folder , $name, $image );



            return $name;
      }

      public static function saveThumbnailImage( $folder, $name, $image ){

        $img = Image::make( $image );

        $thumb = $img->fit(100, 100)->encode($image->getClientOriginalExtension());

        Storage::disk('s3')->put( $folder . 'thumbnail/' . $name, $thumb->getEncoded() );

      }

      public static function saveMediumlImage( $folder, $name, $image ) {

          $img = Image::make( $image );

          $medium = $img->resize(1000, 1000, function ($constraint) {
            $constraint->aspectRatio();
          })->encode($image->getClientOriginalExtension());

          Storage::disk('s3')->put($folder . 'medium/' . $name, $medium->getEncoded() );


      }



      public static function removeImage( $folder, $name ) {

        Storage::disk('s3')->delete($folder . $name);
        Storage::disk('s3')->delete($folder . 'thumbnail/' . $name);
        Storage::disk('s3')->delete($folder . 'medium/' . $name);

      }



}
