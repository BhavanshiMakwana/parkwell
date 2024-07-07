<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth; // Add this line
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function otpVerify(Request $request)
    {
        try {
            $request->validate([
                'otp' => 'required',
                'mobile' => 'required',
             ]);
        } catch (ValidationException $e) {
             foreach ($e->errors() as $field => $messages) {
                 foreach ($messages as $message) {
                     $errors = [
                         'success' =>false,
                         'message' => $message,
                     ];
                 }
             }
             return response()->json( $errors , 422);
        }

        $checkuser=User::where('mobile',$request->mobile)->first();
        if($checkuser!==null)
        {
            if($checkuser->otp === $request->otp)
            {
                // Auth::login($checkuser);
                // $authid=Auth::id();
                // $token=Str::random(60);
                // User::where('id',$authid)->update(['token'=>$token]);
        		// $user=User::where('id',$authid)->first();
                return response()->json(['status'=>true,'msg'=>"OTP Verify Successfully."]);
            }
            else
            {
            	return response()->json(['status'=>false,'msg'=>"Enter a Valid OTP."]);
            }
        }else
        {
            return response()->json(['status'=>false,'msg'=>"Enter a Valid OTP." ]);
        }
    }

    public function setPin(Request $request)
    {
        // Validate the request
        try {
            $request->validate([
                'pin' => 'required|min:4|max:6',
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


        // Find the user by mobile number
        $user = User::where('mobile', $request->mobile)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        // Set the pin using Bcrypt
        $user->pin_number = bcrypt($request->pin);
        $user->save();

        return response()->json(['status' => true, 'msg' => "PIN Number Set Successfully."]);
    }

    public function setPassword(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required|min:6',
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

        // Find the user by mobile number
        $user = User::where('mobile', $request->mobile)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        // Set the password using Bcrypt
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['status' => true, 'msg' => "Password Generated Successfully."]);
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'mobile' => 'required|exists:users,mobile',
                'pin' => 'required',
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

        // Find the user by mobile number
        $user = User::where('mobile', $request->mobile)->first();

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not found'], 404);
        }

        // Check if the pin matches
        if (!Hash::check($request->pin, $user->pin_number)) {
            return response()->json(['status' => false, 'message' => 'Invalid credentials'], 401);
        }

        // Generate a JWT token
        $token = auth('api')->login($user);

        // store device token for notification
        $user->device_token = $request->device_token;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'data' => auth('api')->user(),
        ]);
    }

    public function logout()
    {
        // get token
        $token = JWTAuth::getToken();

        // invalidate token
        $invalidate = JWTAuth::invalidate($token);

        if($invalidate) {
            return response()->json([
                'status' => true,
                'message' => 'Successfully logged out'
            ]);
        }
    }
}
