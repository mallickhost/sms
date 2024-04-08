<?php

namespace App\Http\Controllers\Admin;


use Hash;
use Session;
use Carbon\Carbon;
use App\Models\Admin as AdminModel;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Http;
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

        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

        $credentials = $request->only(['email', 'password']);
       
        //shreya@mail.com	
        //123
        if (Auth::guard('admin')->attempt($credentials)) {

            // $user = Auth::user();
            // echo "<pre/>";
            // print_r($user);die();
            // die('xx');
            // $login_user = AdminModel::find($user->id);

            // $login_user->last_login_at = Carbon::now()->toDateTimeString();
            // $login_user->last_login_ip = $request->getClientIp();
            // $login_user->save();

            // $request->user()->update([
            //     'last_login_at' => Carbon::now()->toDateTimeString(),
            //     'last_login_ip' => $request->getClientIp()
            // ]);
            return redirect()->intended('admin/dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
        Session::flash('danger', 'Sorry! something went wrong please try again');
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
