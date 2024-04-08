<?php

namespace App\Http\Controllers\Teachers;

use Session;
use Carbon\Carbon;
use App\Models\Teacher;
use App\Http\Controllers\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends TeachersAppController
{
    public function login()
    {
        // die('this is student login page');
        // Session::flash('success', 'Successfully registerd now login'); StudentsAppController
        return view('pages/teachers/login');
    }

    public function dashboard()
    {
        // die('this is student login page');
        // Session::flash('success', 'Successfully registerd now login'); StudentsAppController
        return view('pages/teachers/dashboard');
    }

    
    public function myAccount()
    {
        // die('this is student login page');
        // Session::flash('success', 'Successfully registerd now login'); StudentsAppController
        return view('pages/teachers/home');
    }

    public function doLogin(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);

  
        if (Auth::guard('teacher')->attempt($credentials)) {

            $user = Auth::guard('teacher')->user();
            // echo "<pre/>xx";
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
            return redirect()->intended('teachers/dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
        Session::flash('danger', 'Sorry! something went wrong please try again');
        return redirect('/teachers');
    }

    public function logout()
    {
        Session::flash('success', 'Logout successfully');
        Auth::guard('teacher')->logout();

        return redirect('/teachers');

    }
}
