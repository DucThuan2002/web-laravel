<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Session\SessionManager;
use App\Http\Controllers\Controller;

session_start();

class AdminController extends Controller
{
    // kiểm tra đăng nhập
    public function AuthLogin()
    {
        $admin_id=session()->get('admin_id');
        if($admin_id)
        {
            return redirect('dashbroad');
        }
        else{
            return redirect('admin')->send('/đã đăng nhập xong');
        }
    }
    //đăng nhập
    public function index()
    {
        $admin_id=session()->get('admin_id');
        if($admin_id)
        {
            return redirect('dashbroad');
        }
        return view('admin_login');
    }
    //trang chủ
    public function show_dashbroad()
    {
        $this->AuthLogin();
        return view('admin.dashbroad');
    }
    // xác nhận đang nhập
    public function dashbroad(Request $request)
    {
        $admin_email=$request->admin_email;
        $admin_password=md5($request->admin_password);

        $result=DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($result)
        {
            session()->put('admin_name', $result->admin_name);
            session()->put('admin_id', $result->admin_id);
            // print_r();
            return redirect('dashbroad');
        }
        else{
            return redirect('/admin');
        }
        
    }
//  đăng xuất
    public function logout()
    {
        $this->AuthLogin();
        session()->put('admin_name', null);
        session()->put('admin_id', null);
        // print_r();
        return redirect('admin');   
    }
}
