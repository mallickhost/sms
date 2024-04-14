<?php

namespace App\Http\Controllers\Admin;



use Carbon\Carbon;
use App\Models\Admin; 
use App\Models\Student; 
use App\Models\Teacher; 
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

class MyAccountsController extends AdminAppController
{
    public function __construct()
    {
       // $this->middleware('auth.admin', ['except' => ['login','doLogin']]);
    }









     /**
	 * @desc login page
	 *
	 *
	 * @return View|RedirectResponse

	 */
    public function login():View|RedirectResponse{
        if (Auth::guard('admin')->check() && !empty(Auth::guard('admin')->user()->id)) {
            return redirect()->route('admin.dashboard');
        }
        // die('this is student login page');
        // Session::flash('success', 'Successfully registerd now login'); StudentsAppController
        return view('pages/admin/login');
    }







   
       /**
	 * @desc Do the login 
	 *
	 * @param Request $request
	 *
	 * @return RedirectResponse

	 */

    public function doLogin(Request $request):RedirectResponse{

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);
       
   
        if (Auth::guard('admin')->attempt($credentials)) {

            $user = Auth::guard('admin')->user();
         
            $loged_user = Admin::find($user->id);
            $loged_user->last_login_at = Carbon::now()->toDateTimeString();
            $loged_user->last_login_ip = $request->getClientIp();
            $loged_user->save();

            return redirect()->intended('admin/dashboard');
        }
        Session::flash('danger', ' Sorry! something went wrong please try again');
        return redirect('admin');
    }









        /**
	 * @desc Do the logout
	 *
	 *
	 * @return RedirectResponse

	 */

    public function logout():RedirectResponse {
        Session::flash('success', 'Logout successfully');
        Auth::guard('admin')->logout();

        return redirect('/admin');

    }









          /**
	 * @desc DAshboard page
	 *
	 *
	 * @return View

	 */
    public function dashboard():View {
     	$total_student_count =  Student::where(['is_active'=>true,'is_deleted'=>false])->count();
		//$this->p($total_student_count);
      	$total_teacher_count = 0;

   		return view('pages/admin/dashboard',compact('total_student_count'));
    }
}
