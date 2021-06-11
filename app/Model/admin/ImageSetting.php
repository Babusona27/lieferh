<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use DB;

class ImageSetting extends Model
{

	public static function imageType()
    {
        $extensions = array('gif', 'jpg', 'jpeg', 'png');
        return $extensions;
    }

    public function settingmedia($request)
    {
        DB::table('image_settings')->where('image_settings_id', '=', 1)->update([
            'large_width' => $request->large_width,
            'large_height' => $request->large_height,
            'thumbnail_width' => $request->thumbnail_width,
            'thumbnail_height' => $request->thumbnail_height,
            'medium_width' => $request->medium_width,
            'medium_height' => $request->medium_height,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return "success";
    }




}
