<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Storage;
use Image;


class FileManager
{


      private static $sizes = [
          'thumbnail' => ['folder' => 'thumbnail', 'w' => 300, 'h' => 200, 'type' => 'ratio'],
          'small' => ['folder' => 'small', 'w' => 100, 'h' => 100, 'type' => 'crop'],
          'medium' => ['folder' => 'medium', 'w' => 600, 'h' => null, 'type' => 'ratio']
        ];


      public static function saveImage( string $mainFolder , $image ): string {

            $name = uniqid() . $image->getClientOriginalName();

            Storage::disk('s3')->put( $mainFolder . $name, file_get_contents($image) );

            foreach(self::$sizes as $key => $size) {
                self::saveResizeImage( $key, $mainFolder, $name, $image );
            }


            return $name;
      }




      protected static function saveResizeImage( $size, $folder, $name, $image ){

            $img = Image::make( $image );

            if (self::$sizes[$size]['type'] == 'crop') {

                $file = $img->fit(self::$sizes[$size]['w'], self::$sizes[$size]['h'])->encode($image->getClientOriginalExtension());

            } else {

                $file = $img->resize(self::$sizes[$size]['w'], self::$sizes[$size]['h'], function ($constraint) {
                    $constraint->aspectRatio();
                })->encode($image->getClientOriginalExtension());

            }


            Storage::disk('s3')->put( $folder . '/' . self::$sizes[$size]['folder'] . '/' . $name, $file->getEncoded() );


      }



      public static function removeImage( $folder, $name ) {

        Storage::disk('s3')->delete($folder . $name);

        foreach(self::$sizes as $key => $size) {
            Storage::disk('s3')->delete($folder . '/' . $size['folder'] . '/' . $name);
        }


      }



}
