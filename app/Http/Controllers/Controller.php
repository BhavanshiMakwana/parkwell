<?php

namespace App\Http\Controllers;

use App\Models\QRCodeRecord;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $pagination=20;

    public function image($photo,$path)
    {
        /* IMAGE UPLOAD VALIDATION */
        $img_ext = $photo->getClientOriginalExtension();
        if ($img_ext=="jpeg" || $img_ext=="jpg" || $img_ext=="png" || $img_ext=="bmp" || $img_ext=="gif" || $img_ext=="JPEG" || $img_ext=="JPG" || $img_ext=="PNG" || $img_ext=="BMP" || $img_ext=="GIF" ) {}
        else{
            return back()->withInput()->withErrors(['image' => 'Invalid file type.']);
        }
        /* ----------------------- */

        $root = base_path() . '/public/resource/'.$path ;
        $name = str_random(20).".".$photo->getClientOriginalExtension();
        $mimetype = $photo->getMimeType();
        $explode = explode("/",$mimetype);
        $type = $explode[0];

        if (!file_exists($root)) {
            mkdir($root, 0777, true);
        }
        $photo->move($root,$name);
        return $path = "public/resource/".$path."/".$name;
    }

    public function remove_null($var)
    {
        array_walk_recursive($var, function (&$item, $key) {
            $item = null === $item ? '' : $item;
        });
    }

    public function sortByWeight($a, $b)
    {
        $a = $a['price'];
        $b = $b['price'];

        if ($a == $b) return 0;
        return ($a < $b) ? -1 : 1;
    }

    public function LoggedUser(){
        return $user = Session::get('logged_user');
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $qrcode = QRCodeRecord::where('code',$randomString)->first();
        if(!empty($qrcode)){
            $this->generateRandomString(10);
        }else{
            return $randomString;
        }
    }
}
