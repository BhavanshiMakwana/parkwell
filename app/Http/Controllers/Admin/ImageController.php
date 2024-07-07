<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload_image(Request $request)
    {
        if($request->hasFile('image')){
            $filename = str_random(20).'_'.$request->file('image')->getClientOriginalName();
            $image_path = base_path() . '/public/resource/imageupload/';
            $request->file('image')->move(
                $image_path, $filename
            );
            echo url('public/resource/imageupload/'.$filename);
        }
        else{
            echo 'Oh No! Uploading your image has failed.';
        }
    }
}


