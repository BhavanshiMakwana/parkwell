<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\QRCodeRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    public function index(){
        $data['menu'] = 'Home';
        return view('website.index',$data);
    }

    public function privacy_policy(){
        $data['menu'] = 'Privacy Policy';
        return view('website.privacy_policy',$data);
    }

    public function login(){
        $data['menu'] = 'Login';
        return view('website.login',$data);
    }

    public function signin(Request $request){
        $this->validate($request, [
            'mobile' => 'required|numeric',
            'captcha' => 'required',
            'otp' => 'required',
        ]);

        $user = User::where('mobile',$request['mobile'])->first();
        if(!empty($user)){
            session(['logged_user'=>$user['id']]);

//            $this->sendSms('7984622133','Hi 123');

            \Session::flash('success','Login successfully.');
            return redirect('my-account');
        }else{
            \Session::flash('danger','Mobile is invalid. Please try again');
            return redirect()->back();
        }

    }

    public function register(){
        $data['menu'] = 'Register';
        return view('website.register',$data);
    }

    public function signup(Request $request){
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'mobile' => 'required|numeric',
            'otp' => 'required',
        ]);

        $qrcode = QRCodeRecord::where('code',$request['code'])->where('status',1)->first();
        if(!empty($qrcode)){
            if($qrcode['status'] == 0){
                \Session::flash('danger','Entered 10 digits code is not available for register.');
                return redirect()->back();
            }elseif ($qrcode['status'] == 2){
                \Session::flash('danger','Entered 10 digits code is already registered.');
                return redirect()->back();
            }elseif ($qrcode['status'] == 3){
                \Session::flash('danger','Entered 10 digits code is blocked.');
                return redirect()->back();
            }else{
                $input['status'] = 2;
                $qrcode->update($input);

                /*User Entry*/
                $in['name'] = $request['name'];
                $in['mobile'] = $request['mobile'];
                $in['role'] = 'user';
                $in['status'] = 'active';
                $user = User::create($in);

                /*Order Entry*/
                $order_in['user_id'] = $user['id'];
                $order_in['code_id'] = $qrcode['id'];
                Orders::create($order_in);

                session(['logged_user'=>$user['id']]);
                \Session::flash('success','Qr Code is registered successfully.');
                return redirect()->back();
            }
        }else{
            \Session::flash('danger','Entered 10 digits code is invalid. Please try again!');
            return redirect()->back();
        }
    }

    public function my_account(Request $request){
        $data['menu'] = 'My Account';
        $data['orders'] = Orders::with('Code')->where('user_id',$this->LoggedUser())->get();
        return view('website.my_account',$data);
    }

    public function order_now(){
        $data['menu'] = 'Order Now';
        return view('website.order_now',$data);
    }

    public function order_tag(){
        $data['menu'] = 'Order Tag';
        return view('website.order_now2',$data);
    }

    public function logout(){
        Session::flush();
        \Session::flash('success','You have successfully logged out.');
        return redirect('/login');
    }

    public function sendSms($mobileNumber, $message) {
        $username = "dvr001";
        $password = "123456";
        $sender = "SATIAI";
        $to = $mobileNumber;
        $sendondate = date("d-m-Y\Th:m:s");
        $format = "text";
        $route_id = "7";

        //$message = preg_replace("![^a-z0-9:./-]+!i", "+", $message);

        $url = "http://login.smshisms.com/API/WebSMS/Http/v1.0a/index.php?username={$username}&password={$password}&sender={$sender}&to={$to}&message=".urlencode($message)."&reqid=1&format={json|text}&route_id=7&sendondate={$sendondate}&msgtype=unicode";
        $page = file_get_contents($url);
        return $page;
    }
}
