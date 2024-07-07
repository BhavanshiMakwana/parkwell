<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        try {
            $user = Socialite::driver('google')->user();

            $already_user = User::where('email',$user->email)->first();

            if(!empty($already_user)){
                $input['google_id'] = $user->id;
                $already_user->update($input);

                session(['logged_user'=>$already_user['id']]);
                \Session::flash('success','Google login successfully done.');
                return redirect('/');
            }else{
                $name = explode(' ', $user->name);

                $newUser = User::create([
                    'first_name' => $name[0],
                    'last_name' => $name[1],
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'role'=> 'user',
                    'status'=> 'active',
                    'password' => Hash::make('12345678'),
                ]);
                session(['logged_user'=>$newUser['id']]);
                \Session::flash('success','Google login successfully done.');
                return redirect('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
