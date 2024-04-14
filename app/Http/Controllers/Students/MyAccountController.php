<?php

namespace App\Http\Controllers\Students;

use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class MyAccountController extends StudentsAppController
{






            /**
	 * @desc Login page
	 *
	 *
	 * @return View

	 */
    public function login():View {
        // die('this is student login page');
        // Session::flash('success', 'Successfully registerd now login'); StudentsAppController
        return view('pages/students/login');
    }







     /**
	 * @desc login page
	 *
     * @param Request $request
	 *
	 * @return RedirectResponse

	 */
    public function doLogin(Request $request):RedirectResponse{

        $request->validate([
            'student_number' => 'required',
            'password' => 'required',
        ]);


        //check if login not enabled
        
//         $obj_student = new Student();
//         $did_first_login = $obj_student->checkFirstTimeLogin($request->student_number);
// $this->p($did_first_login);



        $credentials = $request->only(['student_number', 'password']);
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




     /**
	 * @desc login page
	 *
	 *
	 * @return RedirectResponse

	 */

    public function logout():RedirectResponse {
        Session::flash('success', 'Logout successfully');
        Auth::guard('student')->logout();

        return redirect('/students');

    }













     /**
	 * @desc login page
	 *
	 *
	 * @return View

	 */

    public function myAccount():View {
        
        $login_student_id =  Auth::guard('student')->user()->id;
  

        $obj_student = new Student();

        $x = $obj_student->getStudentDetails($login_student_id);

        $this->p($x);

        return view('pages/students/my_account/home');
    }
}
