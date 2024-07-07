<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QRCodeRecord;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data['menu'] = "Home";
        $data['total_user'] = User::where('role','user')->count();
        $data['total_qr_code'] = QRCodeRecord::count();
        return view('admin.dashboard',$data);
    }
}
