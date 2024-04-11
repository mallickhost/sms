<?php

namespace App\Http\Controllers\Admin;


use Hash;
use Carbon\Carbon;
use App\Models\Admin as AdminModel;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends AdminAppController
{
    public function __construct()
    {
       // $this->middleware('auth.admin', ['except' => ['login','doLogin']]);
    }
    public function login()
    {
        if (Auth::guard('admin')->check() && !empty(Auth::guard('admin')->user()->id)) {
            return redirect()->route('admin.dashboard');
        }
        // die('this is student login page');
        // Session::flash('success', 'Successfully registerd now login'); StudentsAppController
        return view('pages/admin/login');
    }


    public function doLogin(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);
       
   
        if (Auth::guard('admin')->attempt($credentials)) {

            $user = Auth::guard('admin')->user();
         
            $loged_user = AdminModel::find($user->id);
            $loged_user->last_login_at = Carbon::now()->toDateTimeString();
            $loged_user->last_login_ip = $request->getClientIp();
            $loged_user->save();

            return redirect()->intended('admin/dashboard');
        }
        Session::flash('danger', ' Sorry! something went wrong please try again');
        return redirect('admin');
    }

    public function logout()
    {
        Session::flash('success', 'Logout successfully');
        Auth::guard('admin')->logout();

        return redirect('/admin');

    }
    public function dashboard()
    {
        // die('this is student login page');
        // Session::flash('success', 'Successfully registerd now login'); StudentsAppController
        return view('pages/admin/dashboard');
    }
}
