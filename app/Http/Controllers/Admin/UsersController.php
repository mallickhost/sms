<?php

namespace App\Http\Controllers\Admin;

use Hash;

use Session;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class UsersController extends AdminAppController
{
    public function registration()
    {

        return view('pages/user/registration');


    }
    public function login()
    {
        return view('pages/user/login');
    }


    public function doRegistration(Request $request)
    {

        $request->validate([
          'email' => 'required',
          'password' => 'required',
        ]);


        $data = $request->all();


        $user = new User();
        $user->name = $data['name'];
        $user->telephone = $data['telephone'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        Session::flash('success', 'Successfully registerd now login');

        return view('pages/user/login');
    }
    public function doLogin(Request $request)
    {
        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

        $credentials = $request->only(['email', 'password']);
        // echo "<pre/>";
        // print_r($credentials);
        // die('xx');
        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            $login_user = User::find($user->id);

            $login_user->last_login_at = Carbon::now()->toDateTimeString();
            $login_user->last_login_ip = $request->getClientIp();
            $login_user->save();

            $request->user()->update([
                'last_login_at' => Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->getClientIp()
            ]);
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
        Session::flash('danger', 'Sorry! something went wrong please try again');
        return redirect('/');

    }
    public function edit()
    {

        $datax = ['name'=>'shubhrajyoti Mallick'];
        return view('pages/modal/test', ['data'=>$datax]);
    }

    public function logout()
    {
        Session::flash('success', 'Logout successfully');
        Auth::logout();

        return redirect('/');
    }


    public function resetPassword()
    {
        die('this is reset password page');
    }

    public function doResetPassword()
    {

    }

    // best example
    //https://www.itsolutionstuff.com/post/laravel-custom-login-and-registration-exampleexample.html
}
