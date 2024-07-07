<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ProfileupdateController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $data['menu']="User";
        $data['user'] = User::findorFail($id);
        return view('admin.users.profile_edit',$data);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'password' => 'confirmed',

        ]);

        if(!empty($request['password'])){
        }
        else{
            unset($request['password']);
        }

        $input = $request->all();
        $user = User::findorFail($id);

        $user->update($input);

        \Session::flash('success','Admin Profile has been updated successfully!');
        return redirect('admin/profile_update/'.$id."/edit");
    }
}
