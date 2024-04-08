<?php

namespace App\Http\Controllers\Students;

use Session;
use App\Http\Controllers\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends StudentsAppController
{
    public function login()
    {
        // die('this is student login page');
        // Session::flash('success', 'Successfully registerd now login'); StudentsAppController
        return view('pages/students/login');
    }

    public function doLogin(Request $request){

        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

        $credentials = $request->only(['email', 'password']);
            // echo "<pre/>";
            // print_r($credentials);die();
            // die('xx');
        //sss@mail.com	
        //123
        if (Auth::guard('student')->attempt($credentials)) {

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
            return redirect()->intended('students/my-account')
                        ->withSuccess('You have Successfully loggedin');
        }
        Session::flash('danger', 'Sorry! something went wrong please try again');
        return redirect('/students');
    }

    public function logout()
    {
        Session::flash('success', 'Logout successfully');
        Auth::guard('student')->logout();

        return redirect('/students');

    }

    public function myAccount()
    {
        // die('this is student login page');
        // Session::flash('success', 'Successfully registerd now login'); StudentsAppController
        return view('pages/students/my_account/home');
    }
}
