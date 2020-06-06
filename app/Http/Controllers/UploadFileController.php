<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\FileManager;
use App\Models\Media;
use Auth;

class UploadFileController extends Controller
{

    protected $folder = 'media';

    public function upload(Request $request) {


      $request->validate(
        [
          'file'  => (empty($media)?'required|':'').'file|mimes:jpeg,bmp,png',
        ]
      );

      $image = $request->file('file');
      $name = $image->getClientOriginalName();

      $file = FileManager::saveImage( $this->folder, $image );

      $fields['file'] = $file;
      $fields['name'] = $name;
      if (Auth::user()->is_super) {
          $fields['status_media'] = 'APPROVE';
      }
      try {
          $media = Media::create($fields);
      } catch(\Illuminate\Database\QueryException $e) {
            return response()->json($e,401);
      }

      $media->url = $media->getImageSize('thumbnail');
      
      return response()->json($media, 200);


    }
}
