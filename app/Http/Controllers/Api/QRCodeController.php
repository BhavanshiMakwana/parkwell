<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\QRCodeRecord;
use App\Models\QRCodeStatus;
use App\Models\QRCodeRegistration;
use App\Models\User;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\Result\PngResult;

use Carbon\Carbon;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class QRCodeController extends Controller
{
    //saleQRCode
    public function saleQRCode(Request $request){

        try {
            $request->validate([
                'qr_code_id' => 'required',
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

        $qrCodeId = $request->qr_code_id;
        $qrCode = QRCodeRecord::where('id', $qrCodeId)->first();

        if ($qrCode) {
            // Update QRCodeRecord status
            $qrCode->update(['status' => 1]);

            // Check if a QRCodeStatus entry already exists for this qr_code_id
            $status = QRCodeStatus::where('qr_code_id', $qrCodeId)->first();

            if ($status) {
                $status->update(['is_sale' => 1]);
            } else {
                QRCodeStatus::create([
                    'qr_code_id' => $qrCode->id,
                    'is_sale' => 1
                ]);
            }
            return response()->json(["status" => true, 'msg' => 'QR Code Sale Successfully.']);
        }
        return response()->json(["status" => false, 'msg' => 'QR Code Not Found.']);
    }

    //registerQRCode
    public function registerQRCode(Request $request)
    {
        try {
            $request->validate([
                'mobile' => 'required',
                'country_code' => 'required',
                'name' => 'required',
                'qr_code_id' => 'required|exists:q_r_code_records,id',
                'vehicle_plate_number' => 'required|unique:q_r_code_registrations',
                'vehicle_type' => 'required',
                'device_token' => 'required'
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

        $currentDate = Carbon::now()->format('Y-m-d');
        $qrCodeId = $request->qr_code_id;
        $qrCodeData = QRCodeRecord::where('id', $qrCodeId)->first();
        $qrCode = $qrCodeData->code;
        if ($qrCodeData) {

            $status = QRCodeStatus::where('qr_code_id', $qrCodeId)->first();
            if(!$status){
                return response()->json(["status" => true, 'msg' => 'You Are Not Able TO Ragister This QR Code']);
            }

            $user = User::where('country_code', $request->country_code)
                        ->where('mobile', $request->mobile)
                        ->first();
            if(!$user){
                // Register User
                $user = new User();
                $user->name = $request->name ;
                $user->country_code = $request->country_code ;
                $user->mobile = $request->mobile ;
                $user->role = 'user' ;
                $user->status = 'active';
                $user->device_token = $request->device_token ;
                $user->save();
            }

            $registration = QRCodeRegistration::where('qr_code_id', $request->qr_code_id)->first();
            if($registration)
            {
                return response()->json(["status" => true, 'msg' => 'QR Code Already Register.']);
            }

            // Register vehicle
            $registration = new QRCodeRegistration();
            $registration->admin_id = $user->id ;
            $registration->user_id = $user->id ;
            $registration->qr_code_id = $request->qr_code_id ;
            $registration->vehicle_plate_number = $request->vehicle_plate_number ;
            $registration->vehicle_type = $request->vehicle_type ;
            $registration->active_date = $currentDate ;
            $registration->is_active = 1 ;
            $registration->save();

            $baseUrl = env('APP_QR_REDIRECT_URL');

            // QR data
            $qrData = [
                'qr_code_id' => $qrCodeId,
                'name' => $request->name,
                'country_code' => $request->country_code,
                'mobile' => $request->mobile,
                'vehicle_plate_number' => $request->vehicle_plate_number,
                'vehicle_type' => $request->vehicle_type,
            ];

            // Build the query string from the QR data
            $queryString = http_build_query($qrData);

            // Construct the full URL with the query string
            $url = "{$baseUrl}/?{$queryString}";

            // Generate the QR code
            $qrCodeGenerator = new QrCode($url);
            $qrCodeGenerator->setSize(300);
            $qrCodeGenerator->setMargin(10);
            $qrCodeGenerator->setEncoding(new Encoding('UTF-8'));

            $writer = new PngWriter();
            $result = $writer->write($qrCodeGenerator);

            // Generate the file name
            $first4Chars = substr($qrCodeId, 0, 4);
            $fileNameBase = "{$first4Chars}_{$currentDate}_{$qrCodeId}";
            $fileName = $fileNameBase . '.png';
            $filePath = public_path('resource/qrcodes/' . $fileName);

            // Save the QR code image to the file path
            $result->saveToFile($filePath);

            if($request->vehicle_type === 'car'){
                $updatedQrCode = "cr{$qrCode}";
            }
            elseif($request->vehicle_type == 'bike'){
                $updatedQrCode = "bi{$qrCode}";
            }
            else{
                $updatedQrCode = "{$qrCode}";
            }

            // Update QRCodeRecord with status, QR code and image URL
            $qrCodeData->update([
                'code' => $updatedQrCode,
                'status' => 2,
                'qr_code_image' => url('resource/qrcodes/' . $fileName),
            ]);

            // Update QRCodeStatus status
            $status->update(['is_register' => 1]);

            return response()->json(["status" => true, 'msg' => 'QR Code Register Successfully.']);
        }
        return response()->json(["status" => false, 'msg' => 'QR Code Not Found.']);
    }

    public function assignQRCode(Request $request)
    {
        try {
            $request->validate([
                'admin_id' => 'required',
                'pin' => 'required',
                'qr_code_id' => 'required|exists:q_r_code_records,id',
                'mobile' => 'required|unique:users',
                'country_code' => 'required',
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

        $user = User::where('country_code', $request->country_code)
                ->where('mobile', $request->mobile)
                ->first();
        if(!$user)
        {
            // Register User
            $user = new User();
            $user->admin_id = $request->admin_id ;
            $user->country_code = $request->country_code ;
            $user->mobile = $request->mobile ;
            $user->pin_number = bcrypt($request->pin);
            $user->role = 'user' ;
            $user->status = 'active';
            $user->save();

            $qrCodeRegisterData = QRCodeRegistration::where('qr_code_id', $request->qr_code_id)->where('admin_id', $request->admin_id)->first();
            if(!$qrCodeRegisterData)
            {
                return response()->json(["status" => false, 'msg' => 'QR Code Not Found Successfully.']);
            }
            $qrCodeRegisterData->update([
                'user_id' =>  $user->id,
            ]);

            return response()->json(["status" => true, 'msg' => 'QR Code Assign Successfully.']);
        }
    }

}
