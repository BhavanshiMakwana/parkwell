<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
    {
        if ($user->role == 'admin') {
            if($user->status == 'inactive'){
                $message = 'Sorry, Your Account Is In-Active Now.';
                $this->logout($request);
                return redirect()->back()->withInput($request->only($this->username(), 'remember'))->withErrors([$this->username() => $message,]);
            }
        }else{
            $message = 'Sorry, You Have Not Permission For Login.';
            $this->logout($request);
            return redirect()->back()->withInput($request->only($this->username(), 'remember'))->withErrors([$this->username() => $message,]);
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $loginView = 'admin.auth.login';
    protected $redirectTo = '/admin';
    protected $redirectAfterLogout = 'admin/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
