<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api', 'check.token')->group(function() {
    Route::post('logout','Api\AuthController@logout')->name('logout');
});

//Authentication
Route::post('otpVerify','Api\AuthController@otpVerify')->name('otpVerify');
Route::post('setPin','Api\AuthController@setPin')->name('setPin');
Route::post('setPassword','Api\AuthController@setPassword')->name('setPassword');
Route::post('login','Api\AuthController@login')->name('login');

//notify Reason
Route::post('notifyReason','Api\NotifyReasonController@getLangWiseReason')->name('getLangWiseReason');

//QR Code
Route::post('sale','Api\QRCodeController@saleQRCode')->name('saleQRCode');
Route::post('register','Api\QRCodeController@registerQRCode')->name('registerQRCode');
Route::post('assignCode','Api\QRCodeController@assignQRCode')->name('assignQRCode');

//user Profile
Route::post('updateProfile','Api\UserController@updateProfile')->name('updateProfile');
Route::post('uploadImage','Api\UserController@uploadImage')->name('uploadImage');
Route::post('userProfile', 'Api\UserController@getUserProfile')->name('getUserProfile');
