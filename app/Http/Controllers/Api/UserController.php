<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Carbon\Carbon;


class UserController extends Controller
{
    //
    public function updateProfile(Request $request)
    {
        try {
            $request->validate([
                'birthdate' => 'required',
                'gender' => 'required',
                'mobile' => 'required',
                'email' => 'email:rfc,dns',
                'name' => 'required',
             ]);
         } catch (ValidationException $e) {
             foreach ($e->errors() as $field => $messages) {
                 foreach ($messages as $message) {
                     $errors = [
                         'status' =>false,
                         'message' => $message,
                     ];
                 }
             }
             return response()->json( $errors , 422);
        }


        $user = User::where('mobile', $request->mobile)->first();

        if ($user) {

            // Update User Profile
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'state' => $request->state,
                'city' => $request->city,
                'zip_code' => $request->zip_code,
                'gender' => $request->gender,
                'birthdate' => $request->birthdate,
                'about_you' => $request->about_you,
            ]);

            return response()->json(["status" => true, 'msg' => 'User Profile Update Successfully.']);
        }
        return response()->json(["status" => false, 'msg' => 'User Not Found.']);
    }

    public function uploadImage(Request $request)
    {
        try {
            $request->validate([
                'image_type' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif',
                'mobile' => 'required',
             ]);
        } catch (ValidationException $e) {
             foreach ($e->errors() as $field => $messages) {
                 foreach ($messages as $message) {
                     $errors = [
                         'status' =>false,
                         'message' => $message,
                     ];
                 }
             }
             return response()->json( $errors , 422);
        }

        if ($image = $request->file('image'))
        {
            $fileName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $user = User::where('mobile' , $request->mobile)->first();

            if($request->image_type === 'profile_img'){
                $destinationPath = 'resource/userProfiles';
                $image->move($destinationPath, $fileName);
                // $filePath = public_path('resource/userProfiles/' . $fileName);
                $images = url('resource/userProfiles/' . $fileName);
                $user->profile_img = $images;
                $user->save();
            }
            elseif($request->image_type === 'cover_img'){
                $destinationPath = 'resource/userCoverImg';
                $image->move($destinationPath, $fileName);
                // $filePath = public_path('resource/userCoverImg/' . $fileName);
                $images = url('resource/userCoverImg/' . $fileName);
                $user->cover_img = $images;
                $user->save();
            }
            else{
                return response()->json(["status" => false, 'msg' => 'Enter Valid Image Type']);
            }
            return response()->json(["status" => true, 'msg' => 'Image Upload Successfully.' , 'img_url' => $images]);
        }
    }

    public function getUserProfile(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
            ]);
        } catch (ValidationException $e) {
             foreach ($e->errors() as $field => $messages) {
                 foreach ($messages as $message) {
                     $errors = [
                         'status' =>false,
                         'message' => $message,
                     ];
                 }
             }
             return response()->json( $errors , 422);
        }

        $user = User::with('qrCodeRegistrations.qrCodeRecord')->find($request->user_id);

        $userProfile = [
            "status" => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'country_code' => $user->country_code,
                'mobile' => $user->mobile,
                'address' => $user->address,
                'state' => $user->state,
                'city' => $user->city,
                'zip_code' => $user->zip_code,
                'gender' => $user->gender,
                'birthdate' => $user->birthdate,
                'about_you' => $user->about_you,
                'cover_img' => $user->cover_img,
                'profile_img' => $user->profile_img,
                'status' => $user->status,
                'is_inquiry' => $user->is_inquiry,
                'device_token' => $user->device_token,
            ],
            'qr_code' => $user->qrCodeRegistrations->map(function ($registration) {
                $qrCodeRecord = $registration->qrCodeRecord;
                return [
                    'registration_id' => $registration->id,
                    'admin_id' => $registration->admin_id,
                    'qr_code_id' => $registration->qr_code_id,
                    'code' => $qrCodeRecord->code,
                    'qr_code_image' => $qrCodeRecord->qr_code_image,
                    'vehicle_plate_number' => $registration->vehicle_plate_number,
                    'vehicle_type' => $registration->vehicle_type,
                    'active_date' => $registration->active_date,
                    // 'qr_code_record' => $qrCodeRecord ? [

                    //     'status' => $qrCodeRecord->status,
                    //     'is_download' => $qrCodeRecord->is_download,
                    //     'created_at' => $qrCodeRecord->created_at,
                    //     'updated_at' => $qrCodeRecord->updated_at,
                    // ] : null,
                ];
            }),
        ];

        return response()->json($userProfile);
    }

}
