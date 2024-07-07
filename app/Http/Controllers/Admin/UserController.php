<?php

namespace App\Http\Controllers\admin;

use App\City;
use App\Countries;
use App\Country;
use App\State;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $data['menu']="Users";
        // $query = User::with('Address')->where('role','user')->select();
        $query = User::where('role','user')->select();
        if(isset($request['search'])){
            $query->where(function ($qu) use($request){
                $qu->orWhere('name','like','%'.$request['search'].'%');
                $qu->orWhere('email','like','%'.$request['search'].'%');
                $qu->orWhere('mobile','like','%'.$request['search'].'%');
            });
        }
        $data['search'] = $request['search'];
        $data['users'] = $query->where('role','!=','admin')->Paginate($this->pagination);
        return view('admin.users.index', $data);
    }

    public function create()
    {
        $data['menu']="Users";
        return view("admin.users.create",$data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
        ]);
        $input = $request->all();
        $input['email_verified'] = 1;
        $input['is_accepted'] = 0;
        $input['role'] = 'user';
        $input['status'] = 'active';
        $input['session_token'] = str_random(30);
        $user = User::create($input);
        $link = url('/invitation/'.$user['session_token']);
        $cur_year = Carbon::now()->format('Y');
        $logo = url('assets/website/images/logo-side.png');
        $body = "<html>
                        <head>
                            <title>Congratulations! You are invited on Lana World</title>
                        </head>
                        <body style='font-family: sans-serif; padding:15px;'>
                            <div style='position: none; margin: auto; width: 100%; background-color: #EEEEEE;'>
                                <div style='text-align: center; background-color: #FFFFFF;'>
                                    <img src='".$logo."' height='74px'>
                                </div>
                                <div style='background-color: #CCCCCC; border-bottom: 1px solid #000000; colour: #000000; padding: 15px;'>
                                    <span>Hello User,</span><br><br>
                                    <span style='line-height: 2'>Please click on invite link to become a member of Lana World. <br/> <a href=$link target='_blank'>$link</a><br/> Thank you.</span>
                                </div>
                                <div style='background-color: #DD0000; padding:10px 0 10px 0 ; width: 100%;  color: #ffffff; text-align: center;'>
                                    <span>&copy; ".$cur_year." LanaWorld, Inc. All Rights Reserved.</span>
                                </div>
                            </div>
                        </body>
                    </html>";

            $email = new \SendGrid\Mail\Mail();
            $email->setfrom("noreply@lanaworld.org", "LanaWorld Support");
            $email->setSubject("LanaWorld Invitation");
            $email->addto($user->email, $user->name);
            $email->addContent("text/plain", "Hello User, Your invite link for LanaWorld account is given below, you can register using this link at a time $link

             Thank You");
            $email->addContent("text/html", $body);

            $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
            try {
                $sendgridresponse = $sendgrid->send($email);

                if ($sendgridresponse->statusCode() >=200 && $sendgridresponse->statusCode() <300){
                    \Session::flash('success','Invite email sent successfully.');
                    return redirect('admin/users');
                } else {
                    \Session::flash('danger','Invite email is not sent!');
                    return redirect()->back();
                }
            } catch (\Exception $e) {
                return 'Caught exception: '. $e->getMessage() ."\n";
            }

        \Session::flash('success', 'Invitation send successfully!');
        return redirect('admin/users');
    }

    public function show($id)
    {
       //
    }

    public function edit($id)
    {
        $data['menu']="Users";
        $data['user'] = User::findorFail($id);
        return view('admin.users.edit',$data);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'country_code' => 'required',
            'mobile' => 'required',
            'status'=>'required',
            'image'=>'required|mimes:jpeg,bmp,png',
        ]);
        if(empty($request['password'])){
            unset($request['password']);
        }
        $input = $request->all();
        $user = User::findorFail($id);
        if($photo = $request->file('image'))
        {
            if(!empty($user['image']) && file_exists($user['image'])){
                unlink($user['image']);
            }
            $input['image'] = $this->image($photo,'user');
        }

        $user->update($input);
        \Session::flash('success','User has been updated successfully!');
        return redirect('admin/users');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if(!empty($user['image']) && file_exists($user['image'])){
            unlink($user['image']);
        }
        $user->delete();
        \Session::flash('danger','User has been deleted successfully!');
        return redirect('admin/users');
    }

    public function assign(Request $request)
    {
        $user = User::findorFail($request['id']);
        $user['status'] = "active";
        $user->update($request->all());
    }

    public function unassign(Request $request)
    {
        $user = User::findorFail($request['id']);
        $user['status'] = "inactive";
        $user->update($request->all());
    }
}
