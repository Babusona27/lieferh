<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Model\admin\Images;
use App\Model\admin\ImageSetting;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;
use Image;

class MediaController extends Controller
{

    public function __construct(Images $Images, ImageSetting $ImageSetting)
    {
        $this->Images = $Images;
        $this->ImageSetting = $ImageSetting;
    }
    
    /******** image setting view *******/
    public function display()
    {
        $media_setting = DB::table('image_settings')
            ->where('image_settings_id',1)
            ->first();
        return view("admin.media.index")->with('media_setting', $media_setting);
    }
    /******** image setting view *******/

    /******** update image setting *******/
    public function updatemediasetting(Request $request)
    {
        $messages = "Content has been updated successfully!";

        try {
            $mediasetting = $this->ImageSetting->settingmedia($request);

            if(isset($request->regenrate) and $request->regenrate=='yes'){
                $regenrate = $this->Images->regenrateAll($request);
                $messages =  "Setting and Sizes are updated now";
            }    

            return redirect()->back()->with('update', $messages);

        } catch (Exception $e) {
            return \Illuminate\Support\Facades\Redirect::back()->withErrors($messages)->withInput($request->all());
        }

    }
    /******** update image setting *******/

    /******** image view *******/
    public function add()
    {
        $images = $this->Images->getimages();

        return view('admin.media.addimages')->with('images', $images);
    }
    /******** image view *******/

    /******** actual image upload *******/
    public function fileUpload(Request $request)
    {

        // Creating a new time instance, we'll use it to name our file and declare the path
        $time = Carbon::now();
        // Requesting the file from the form
        $image = $request->file('file');
        $extensions = $this->ImageSetting->imageType();
        if ($request->hasFile('file') and in_array($request->file->extension(), $extensions)) {

            // getting size
            $size = getimagesize($image);
            list($width, $height, $type, $attr) = $size;
            // Getting the extension of the file
            $extension = $image->getClientOriginalExtension();
            // Creating the directory, for example, if the date = 18/10/2017, the directory will be 2017/10/
            $directory = date_format($time, 'Y') . '/' . date_format($time, 'm');
            // Creating the file name: random string followed by the day, random number and the hour
            $filename = Str::random(5) . date_format($time, 'd') . rand(1, 9) . date_format($time, 'h') . "." . $extension;
            // This is our upload main function, storing the image in the storage that named 'public'
            // $upload_success = $image->storeAs($directory, $filename, 'public');
            $actulimgpath = 'public/images/media/' . $directory . '/';
            $upload_success = $image->move($actulimgpath, $filename);

            //store DB
            $Path = 'images/media/' . $directory . '/' . $filename;
            //$Images = new Images();
            $imagedata = $this->Images->imagedata($filename, $Path, $width, $height);

            $AllImagesSettingData = $this->Images->AllimagesHeightWidth();

            switch (true) {
                case ($width >= $AllImagesSettingData->large_width || $height >= $AllImagesSettingData->large_height):
                    $tuhmbnail = $this->storeThumbnial($Path, $filename, $directory, $filename);
                    $mediumimage = $this->storeMedium($Path, $filename, $directory, $filename);
                    $largeimage = $this->storeLarge($Path, $filename, $directory, $filename);
                    break;
                case ($width >= $AllImagesSettingData->medium_width || $height >= $AllImagesSettingData->medium_height):
                    $tuhmbnail = $this->storeThumbnial($Path, $filename, $directory, $filename);
                    $mediumimage = $this->storeMedium($Path, $filename, $directory, $filename);
                    
                    break;
                case ($width >= $AllImagesSettingData->thumbnail_width || $height >= $AllImagesSettingData->thumbnail_height):
                    $tuhmbnail = $this->storeThumbnial($Path, $filename, $directory, $filename);

                    break;
            }

        } else {
            return "Invalid Image";
        }

    }
    /******** actual image upload *******/

    /******** thumbnail image upload *******/
    public function storeThumbnial($Path, $filename, $directory, $input)
    {
        
        $thumbnail_values = $this->Images->AllimagesHeightWidth();

        $originalImage = $Path;

        $destinationPath = public_path('images/media/' . $directory . '/');
        $thumbnailImage = Image::make($originalImage, array(

            'width' => $thumbnail_values->thumbnail_width,

            'height' => $thumbnail_values->thumbnail_height,

            'grayscale' => false));
        $namethumbnail = $thumbnailImage->save($destinationPath . 'thumbnail' . time() . $filename);

        $Path = 'images/media/' . $directory . '/' . 'thumbnail' . time() . $filename;
        $destinationFile = public_path($Path);
        $size = getimagesize($destinationFile);
        list($width, $height, $type, $attr) = $size;
        
        $storethumbnail = $this->Images->thumbnailrecord($input, $Path, $width, $height);

        return $namethumbnail;
    }
    /******** thumbnail image upload *******/

    /******** medium image upload *******/
    public function storeMedium($Path, $filename, $directory, $input)
    {
        $Medium_values = $this->Images->AllimagesHeightWidth();

        $originalImage = $Path;

        $destinationPath = public_path('images/media/' . $directory . '/');
        $thumbnailImage = Image::make($originalImage, array(

            'width' => $Medium_values->medium_width,

            'height' => $Medium_values->medium_height,

            'grayscale' => false));
        $namemedium = $thumbnailImage->save($destinationPath . 'medium' . time() . $filename);
        $Path = 'images/media/' . $directory . '/' . 'medium' . time() . $filename;

        $destinationFile = public_path($Path);
        $size = getimagesize($destinationFile);
        list($width, $height, $type, $attr) = $size;

        $storeMediumImage = $this->Images->Mediumrecord($input, $Path, $width, $height);

        return $namemedium;
    }
    /******** medium image upload *******/

    /******** large image upload *******/
    public function storeLarge($Path, $filename, $directory, $input)
    {
        
        $Large_values = $this->Images->AllimagesHeightWidth();

        $originalImage = $Path;

        $destinationPath = public_path('images/media/' . $directory . '/');
        $thumbnailImage = Image::make($originalImage, array(

            'width' => $Large_values->large_width,

            'height' => $Large_values->large_height,

            'grayscale' => false));
//        $upload_success = $thumbnailImage->save($directory, $filename, 'public');
        $namelarge = $thumbnailImage->save($destinationPath . 'large' . time() . $filename);

        $Path = 'images/media/' . $directory . '/' . 'large' . time() . $filename;
        $destinationFile = public_path($Path);
        $size = getimagesize($destinationFile);
        list($width, $height, $type, $attr) = $size;

        $storeLargeImage = $this->Images->Largerecord($input, $Path, $width, $height);

        return $namelarge;
    }
    /******** large image upload *******/

    /******** image details *******/
    public function detailImage($images_id)
    {
        $image_details = $this->Images->getImageDetail($images_id);

        return view('admin.media.detail')->with('image_details', $image_details);
    }
    /******** image details *******/

    /********** reganerate image **********/
    public function regenerateImage(Request $request)
    {
        $img_regenerate = $this->Images->regenerate($request->images_id, $request->image_categories_id, $request->images_width, $request->images_height);
        
        return redirect('admin/media/detail/'.$request->images_id)->with('success', "Image has been resized successfully!");
    }
    /********** reganerate image **********/

    /********** delete image **********/
    public function deleteImage(Request $request)
    {
        $images = explode(",", $request->images);
        foreach ($images as $image) {
            $imagedelete = $this->Images->imagedelete($image);
        }
        return 'success';
    }
    /********** delete image **********/

    /******** refresh image *********/
    public function refresh()
    {
        $allimage = $this->Images->getimages();
        return view("admin.media.loadimages")->with('allimage', $allimage);
    }
    /******** refresh image *********/







}
