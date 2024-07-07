<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'admin',  'admin/home'], function () {

    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

    Route::auth();
    Route::get('/', 'Admin\DashboardController@index');

    /*IMAGE UPLOAD IN SUMMER NOTE*/
    Route::post('image/upload', 'Admin\ImageController@upload_image');

    /* USER MANAGEMENT */
    Route::resource('profile_update', 'Admin\ProfileupdateController');

    /* QR CODE MANAGEMENT */
    Route::get('qr_code/status', 'Admin\QRCodeController@statusWise');
    Route::post('qr_code/download', 'Admin\QRCodeController@download');
    Route::post('qr_code/assign', 'Admin\QRCodeController@assign');
    Route::post('qr_code/unassign', 'Admin\QRCodeController@unassign');
    Route::resource('qr_code', 'Admin\QRCodeController');

    /* REASON MANAGEMENT */
    Route::resource('notify_reason', 'Admin\NotifyReasonController');

    Route::resource('users', 'Admin\UserController');
    Route::post('users/assign', 'Admin\UserController@assign');
    Route::post('users/unassign', 'Admin\UserController@unassign');

    Auth::routes();
});


/*Front*/
Route::get('/', 'Website\FrontController@index');
Route::get('login', 'Website\FrontController@login');
Route::get('register', 'Website\FrontController@register');
Route::post('signin', 'Website\FrontController@signin');
Route::post('signup', 'Website\FrontController@signup');
Route::get('my-account', 'Website\FrontController@my_account');
Route::get('order-now', 'Website\FrontController@order_now');
Route::get('order-tag', 'Website\FrontController@order_tag');
Route::get('privacy-policy', 'Website\FrontController@privacy_policy');
Route::get('logout', 'Website\FrontController@logout');
