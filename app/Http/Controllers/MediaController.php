<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Libraries\FileManager;
use App\Models\Media;
use App\Models\Brand;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Image;

class MediaController extends Controller
{



      protected $folder = 'media';


      public function validation(Request $request, $media = null) {

          $request->validate(
            [
              'file'  => (empty($media)?'required|':'').'file|mimes:jpeg,bmp,png',
              'name'  => 'required',
            ]
          );

      }



      public function index() {

          $media = Media::all();


          return view('admin.media.index')
          ->with( compact('media') );

      }


      public function show(Media $media) {


            $brands = Brand::all();
            return view('admin.media.view')->with([
              'media' => $media,
              'brands' => $brands
            ]
            );

      }


      public function create() {

            $media = null;
            $brands = Brand::all();

            return view('admin.media.create')->with([
              'media' => $media,
              'brands' => $brands
            ]
            );

      }


      public function store(Request $request) {

            $this->validation($request);

            $fields = $request->all();

            $image = $request->file('file');

            $fields['file'] = FileManager::saveImage( $this->folder, $image );

            Media::create($fields);

            return redirect()->route('media.index')->with([
                  'notification' => 'Media saved with success!',
                  'type-notification' => 'success'
                ]);

      }


      public function edit(Media $media) {


            $brands = Brand::all();
            return view('admin.media.edit')->with([
              'media' => $media,
              'brands' => $brands
            ]
            );

      }


      public function update(Request $request, Media $media) {

            $this->validation($request, $media);

            $fields = $request->all();

            if ($request->file) {

              $image = $request->file('file');

              // remove old image
              FileManager::removeImage($this->folder, $media->file);

              $fields['file'] = FileManager::saveImage( $this->folder, $image );

            }

            $media->update($fields);

            return redirect()->route('media.index')->with([
                  'notification' => 'Media saved with success!',
                  'type-notification' => 'success'
                ]);

      }


      public function destroy(Media $media) {

            FileManager::removeImage($this->folder, $media->file);
            $media->delete();

            return redirect()->route('media.index')->with([
                  'notification' => 'Image removed with success!',
                  'type-notification' => 'warning'
                ]);

      }


      protected function saveImage($image) {

            $name = $name = $image->getClientOriginalName();

            Storage::disk('s3')->put('media/'.$name, file_get_contents($image) );

            $this->resizeImage($name, $image);

            return $name;
      }


      public function viewImageData(Request $request) {


            $media = Media::where('file', $request->file)->first();

            if ($media) {

                $files = FileManager::getImage($this->folder, $media->file);

                $image['id'] = $media->id;
                $image['name'] = $media->name;
                $image['brand_id'] = $media->brand_id;
                $image['brand_id'] = $media->brand_id;
                $image['files'] = $files;

                return response()->json($image, 200);
            } else {
                return response()->json(['error' => 'No image found'], 404);
            }




      }




}
