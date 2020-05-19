<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Libraries\FileManager;
use App\Models\Media;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Image;

use Auth;

class MediaController extends Controller
{


    protected $folder = 'media';


    public function __construct()
    {

        $this->authorizeResource(Media::class);

    }


    public function validation(Request $request, $media = null)
    {

        $request->validate(
            [
                'file' => (empty($media) ? 'required|' : '') . 'file|mimes:jpeg,bmp,png',
                'name' => 'required',
                'brand_id',
                'restaurant_id',
                'status_media'
            ]
        );

    }


    public function index()
    {

        if (Auth::user()->is_super) {
            $media = Media::orderBy('status_media', 'DESC')->get();
            $brands = Company::all();
        } else {
            if (Auth::user()->is_owner) {
                $mediaCompany = Media::where('brand_id', Auth::user()->brand->first()->id)->orderBy('status_media', 'DESC')->get();
            } else if (Auth::user()->is_restaurant) {
                $mediaCompany = Media::where('restaurant_id', Auth::user()->restaurant->first()->id)->orderBy('status_media', 'DESC')->get();
            }

            $media = $mediaCompany;

            $brands = Auth::user()->brand;

        }

        return view('admin.media.index')
            ->with(compact('media'))
            ->with(compact('brands'));

    }


    public function show(Media $media)
    {

        $companies = Company::all();

        return view('admin.media.view')->with([
                'media' => $media,
                'companies' => $companies
            ]
        );

    }


    public function create()
    {

        $media = null;
        $companies = Company::all();

        return view('admin.media.create')->with([
                'media' => $media,
                'companies' => $companies
            ]
        );

    }


    public function store(Request $request)
    {

        $this->validation($request);

        $fields = $request->all();

        $image = $request->file('file');

        $fields['file'] = FileManager::saveImage($this->folder, $image);

        Media::create($fields);

        // if media is only updated set to PENDING status
        if (!isset($fields['status_media'])) {
            $fields['status_media'] = 'PENDING';
        }

        return redirect()->route('media.index')->with([
            'notification' => 'Media saved with success!',
            'type-notification' => 'success'
        ]);

    }


    public function edit(Media $media)
    {

        if (Auth::user()->is_super) {
            $brands = Company::all();
        } else {

            $brands = Auth::user()->brand;

        }

        return view('admin.media.edit')->with([
                'media' => $media,
                'brands' => $brands
            ]
        );

    }


    public function update(Request $request, Media $media)
    {

        $this->validation($request, $media);

        $fields = $request->all();

        if ($request->file) {

            $image = $request->file('file');

            // remove old image
            FileManager::removeImage($this->folder, $media->file);

            $fields['file'] = FileManager::saveImage($this->folder, $image);

        }

        // if media is only updated set to PENDING status
        if (!isset($fields['status_media'])) {
            $fields['status_media'] = 'PENDING';
        }

        $media->update($fields);

        return redirect()->route('media.index')->with([
            'notification' => 'Media saved with success!',
            'type-notification' => 'success'
        ]);

    }


    public function destroy(Media $media)
    {

        FileManager::removeImage($this->folder, $media->file);
        $media->delete();

        return redirect()->route('media.index')->with([
            'notification' => 'Image removed with success!',
            'type-notification' => 'warning'
        ]);

    }


    protected function saveImage($image)
    {

        $name = $name = $image->getClientOriginalName();

        Storage::disk('s3')->put('media/' . $name, file_get_contents($image));

        $this->resizeImage($name, $image);

        return $name;
    }


    public function viewImageData(Media $media)
    {

        if ($media) {

            $files = FileManager::getImage($this->folder, $media->file);

            $image['id'] = $media->id;
            $image['name'] = $media->name;
            $image['brand_id'] = $media->brand_id;
            $image['files'] = $files;
            $image['canEdit'] = $media->userCanEdit(Auth::user());
            return response()->json($image, 200);
        } else {
            return response()->json(['error' => 'No image found'], 404);
        }

    }

    public function approve(Media $media)
    {
        $media->status_media = 'APPROVE';
        return $this->changeStatus($media);
    }

    public function pending(Media $media)
    {

        $media->status_media = 'PENDING';
        return $this->changeStatus($media);
    }

    protected function changeStatus(Media $media)
    {
        try {
            $media->save();
            return response()->json($media, 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Something was worng'], 500);
        }
    }

}
