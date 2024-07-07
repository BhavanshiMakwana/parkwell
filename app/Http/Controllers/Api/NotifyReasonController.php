<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NotifyReason;
use Illuminate\Http\Request;

class NotifyReasonController extends Controller
{
    //getLangWiseReason
    public function getLangWiseReason(Request $request)
    {
        $language = $request->language;
        $data =  NotifyReason::where('language' , $language)->get();
        return response()->json(["status" => true , "Data" => $data]);
    }
}
