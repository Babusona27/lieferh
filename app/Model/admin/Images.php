<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;

class Images extends Model
{
    
    
    public function getimages(){
       	$allimagesth = DB::table('images')
            ->leftJoin('image_categories','images.images_id','=','image_categories.images_id')
            ->select('images_path','images.images_id','images_type')
            ->where('image_categories.images_type','THUMBNAIL')
            ->orderby('images.images_id','DESC')
            ->get();
        $allimages = DB::table('images')
            ->leftJoin('image_categories','images.images_id','=','image_categories.images_id')
            ->select('images_path','images.images_id','images_type')
            ->where('image_categories.images_type','ACTUAL')
            ->orderby('images.images_id','DESC')
            ->get();

        $result =$allimages->merge($allimagesth)->keyBy('images_id');

       return $result;
    }

    /*************/
    public function imagedata($filename, $Path, $width, $height, $user_id = null){

        if(Auth::user()){
            $user_id = Auth::user()->id;
        }else{
            $user_id = $user_id;
        }

        $imagedata = DB::table('images')->insert([
            ['images_name' => $filename, 'user_id' => $user_id]
        ]);
        $getimage_id =  DB::table('images')->where('images_name', $filename)->first();

        $image_id = $getimage_id->images_id;

        $imagecatedata = DB::table('image_categories')->insert([
            ['images_id' => $image_id, 'images_type' => '1', 'images_height' =>$height,'images_width' =>$width,'images_path' =>$Path]
        ]);
        return $image_id;

    }
    /*************/

    /*************/
    public function AllimagesHeightWidth()
    {
        $AllImagessetting = DB::table('image_settings')->where('image_settings_id',1)->first();
        return $AllImagessetting;
    }
    /*************/

    /**************/
    public function thumbnailrecord($filename,$Path,$width,$height){
      $getimage_id =  DB::table('images')->where('images_name', $filename)->first();
      $image_id = $getimage_id->images_id;

      $imagecatedata = DB::table('image_categories')->insert([
        ['images_id' => $image_id, 'images_type' => '2', 'images_height' =>$height,'images_width' =>$width,'images_path' =>$Path,'updated_at'=> date('y-m-d H:i:s')]
      ]);
    }
    /***************/

    /***************/
    public function Mediumrecord($filename,$Path,$width,$height){
        $getimage_id =  DB::table('images')->where('images_name', $filename)->first();
        $image_id = $getimage_id->images_id;
        $imagecatedata = DB::table('image_categories')->insert([
            ['images_id' => $image_id, 'images_type' => '4', 'images_height' =>$height,'images_width' =>$width,'images_path' =>$Path,'updated_at'=> date('y-m-d H:i:s')]
        ]);
    }
    /****************/

    /****************/
    public function Largerecord($filename,$Path,$width,$height){
        $getimage_id =  DB::table('images')->where('images_name', $filename)->first();
        $image_id = $getimage_id->images_id;
        $imagecatedata = DB::table('image_categories')->insert([
            ['images_id' => $image_id, 'images_type' => '3', 'images_height' =>$height,'images_width' =>$width,'images_path' =>$Path,'updated_at'=> date('y-m-d H:i:s')]
        ]);
    }
    /*******************/

    /****************/
    public function getImageDetail($images_id){
        $imagesdetail = DB::table('images')
            ->leftJoin('image_categories','images.images_id','=','image_categories.images_id')
            ->select('images.*','image_categories.image_categories_id','image_categories.images_type','image_categories.images_height','image_categories.images_width','image_categories.images_path')
            ->where('images.images_id',$images_id)
            ->get();

        return $imagesdetail;
    }
    /****************/

    /******** regenerate section ********/
    public function regenerate($images_id, $image_categories_id, $images_width, $images_height)
    {
        $origianl_record = DB::table('image_categories')
            ->select('images_path')
            ->where('image_categories.images_id',$images_id)
            ->where('image_categories.images_type','ACTUAL')
            ->first();
        
        $required_record = DB::table('image_categories')
            ->select('images_path')
            ->where('image_categories.image_categories_id',$image_categories_id)
            ->first();

        
        $original_image_path = $origianl_record->images_path;
        $required_image_full_path = $required_record->images_path;

        //delete old size image
        if(file_exists($required_image_full_path)){
            unlink($required_image_full_path);
        }
        
        
        //get name and path of required image
        $total_string = strlen($required_image_full_path);
        $required_imag_path = substr($required_image_full_path, 0,21);
        $filename = substr($required_image_full_path, 21,$total_string);
        
        $destinationPath = public_path($required_imag_path);

        $saveimage = Image::make($original_image_path, array(

            'width' => $images_width,

            'height' => $images_height,

            'grayscale' => false));

        $namethumbnail = $saveimage->save($destinationPath . $filename);

        $Path = $required_image_full_path;
        $destinationFile = public_path($Path);
        $size = getimagesize($destinationFile);
        list($width, $height, $type, $attr) = $size;

        DB::table('image_categories')->where('image_categories_id', $image_categories_id)->update(
        [
            'images_width' => $images_width,
            'images_height' => $images_height,
            'updated_at' => date('y-m-d h:i:s')
        ]);

        return $namethumbnail;
    }
    /******** regenerate section ********/

    /********* image delete **********/
    public function imagedelete($images_id){
        $imagesdetail = DB::table('images')
            ->where('images.images_id',$images_id)
             ->delete();

        $imagesdetailcategories = DB::table('image_categories')
            ->where('image_categories.images_id',$images_id)
            ->delete();
        return  $imagesdetailcategories;
    }
    /********* image delete **********/

    /********* regenerate all image *********/
    public function regenrateAll($request){
        //get settings
        $AllImagesSettingData = $this->AllimagesHeightWidth();

        $images = DB::table('images')
            ->leftJoin('image_categories','images.images_id','=','image_categories.images_id')
            ->where('images_type', 'ACTUAL')
            ->get();
        
        foreach($images as $image){
            $image_path = $image->images_path;
            $image_id = $image->images_id;

            $size = getimagesize(public_path($image_path));
            list($width, $height, $type, $attr) = $size;

            switch (true) {
                case ($width >= $AllImagesSettingData->large_width || $height >= $AllImagesSettingData->large_height):

                    $tuhmbnail = $this->regenerateimages($image_id, $AllImagesSettingData->thumbnail_width, $AllImagesSettingData->thumbnail_height, 'THUMBNAIL');
                    $mediumimage = $this->regenerateimages($image_id, $AllImagesSettingData->medium_width, $AllImagesSettingData->medium_height, 'MEDIUM');
                    $largeimage = $this->regenerateimages($image_id, $AllImagesSettingData->large_width, $AllImagesSettingData->large_height, 'LARGE');
                    break;
                case ($width >= $AllImagesSettingData->medium_width || $height >= $AllImagesSettingData->medium_height):
                    $tuhmbnail = $this->regenerateimages($image_id, $AllImagesSettingData->thumbnail_width, $AllImagesSettingData->thumbnail_height, 'THUMBNAIL');
                    $mediumimage = $this->regenerateimages($image_id, $AllImagesSettingData->medium_width, $AllImagesSettingData->medium_height, 'MEDIUM');
                    break;
                case ($width >= $AllImagesSettingData->thumbnail_width || $height >= $AllImagesSettingData->thumbnail_height):
                    $tuhmbnail = $this->regenerateimages($image_id, $AllImagesSettingData->thumbnail_width, $AllImagesSettingData->thumbnail_height, 'THUMBNAIL');
                    break;

            }
        }
    }
    /********* regenerate all image *********/

    //regenerate section
    public function regenerateimages($image_id, $width, $height, $image_type)
    {
        $origianl_record = DB::table('image_categories')
            ->select('images_path')
            ->where('image_categories.images_id',$image_id)  
            ->where('image_categories.images_type','ACTUAL')
            ->first();
        
        $required_record = DB::table('image_categories')
            ->where('image_categories.images_id',$image_id) 
            ->where('image_categories.images_type',$image_type)
            ->first();
        
        $original_image_path = $origianl_record->images_path;

        if($required_record){
            $required_image_full_path = $required_record->images_path;
            $image_categories_id = $required_record->image_categories_id;
            
            //delete old size image
            if(file_exists($required_image_full_path)){
                unlink($required_image_full_path);                
            }

            $total_string = strlen($required_image_full_path);
            $required_imag_path = substr($required_image_full_path, 0,21);
            $filename = substr($required_image_full_path, 21,$total_string); 

        }else{
            $required_image_full_path = $original_image_path;
            $total_string = strlen($original_image_path);
            $required_imag_path = substr($original_image_path, 0,21);
            $filename = substr($original_image_path, 21,$total_string);
            $filename = strtolower($image_type).time() . $filename;
        }
        
        $destinationPath = public_path($required_imag_path);
        $saveimage = Image::make($original_image_path, array(

            'width' => $width,

            'height' => $height,

            'grayscale' => false));

        $namethumbnail = $saveimage->save($destinationPath . $filename);
       
        $path = $required_imag_path . $filename;
        $destinationFile = $path;
        $size = getimagesize(public_path($destinationFile));
        list($width, $height, $type, $attr) = $size;
    
        //check insert or update
        if($required_record){
            
            DB::table('image_categories')->where('image_categories_id', $image_categories_id)->update(
                [
                    'images_width' => $width,
                    'images_height' => $height,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }else{
            DB::table('image_categories')->insert(
            [
                'images_width'   =>   $width,
                'images_height'     =>   $height,
                'created_at' => date('Y-m-d H:i:s'),
                'images_id'  =>   $image_id,
                'images_path'  => $path,
                'images_type' => $image_type
            ]);
        }       

        return $namethumbnail;
    }


}
