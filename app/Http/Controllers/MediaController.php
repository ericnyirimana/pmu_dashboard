<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Media;
use App\Models\Brand;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Image;

class MediaController extends Controller
{
      /**
       * The attributes that set Datatable headers and fields.
       *
       * @var array
       */
      protected $datatableFields = [
          'Thumbnail'   => 'image:thumbnail',
          'ID'          => 'id',
          'Name'        => 'name',
          'Extension'   => 'extension',
          'Brand'       => 'brand_name',
      ];



      public function validation(Request $request, $media = null) {

        $request->validate(
          [
            'file'  => (empty($media)?'required|':'').'file|mimes:jpeg,bmp,png',
            'name'  => 'required',
            'brand_id'  => 'required|integer'
          ]
        );

      }



      public function index() {

          parent::index();

          $media = Media::all();


          return view('admin.media.index')
          ->with( compact('media') );

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

            // save original file
            $path = $image->store('public/media');

            $name = str_replace('public/media/', '', $path);

            $this->resizeImage($name);

            $fields['file'] = $name;

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
            $image = $request->file('file');

            if ($request->file) {

              // remove old image
              $this->removeImage($media->file);

              $fields['file'] = $this->saveImage($image);

            }




            $media->update($fields);

            return redirect()->route('media.index')->with([
                  'notification' => 'Media saved with success!',
                  'type-notification' => 'success'
                ]);

      }


      public function destroy(Media $media) {

            $this->removeImage($media->file);
            $media->delete();

            return redirect()->route('media.index')->with([
                  'notification' => 'Image removed with success!',
                  'type-notification' => 'warning'
                ]);

      }


      protected function saveImage($image) {

            $path = $image->store('public/media');
            $name = str_replace('public/media/', '', $path);

            $this->resizeImage($name);

            return $name;
      }



      protected function resizeImage($image) {

            $img = Image::make( storage_path() . '/app/public/media/' . $image);

            // save thumbnail
            $img->fit(100, 100)->save( storage_path() . '/app/public/media/thumbnail/' . $image);

            // save medium
            $img->resize(1000, 1000, function ($constraint) {
              $constraint->aspectRatio();
            })->save( storage_path() . '/app/public/media/medium/' . $image);



      }

      protected function removeImage($image) {

            Storage::disk('public')->delete('media/'.$image);
            Storage::disk('public')->delete('media/thumbnail/'.$image);
            Storage::disk('public')->delete('media/medium/'.$image);
            Storage::disk('public')->delete('media/large/'.$image);

      }

}
