<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Academic;
use View;

class MasterDatasController extends AdminAppController
{
    public function academicFees($academic_session_id=null)
    {

        $obj_academic = new Academic();
		$arr_session = $obj_academic->list_session();
        $arr_class = $obj_academic->list_class();

		// $current_academic_session = $obj_academic->getCurrentAcademicSession();

        return view("pages/admin/master_data/academic_fees",compact('arr_session','arr_class'));
   
    }

    public function addEdit()
    {

        //  $username = session('currentActiveAcademic');
         //$this->printx($username);
        // modal best example https://www.youtube.com/watch?v=LzYqAx0Qh6Y
        // die('this is student login page');
        // Session::flash('success', 'Successfully registerd now login'); StudentsAppController
        return view('pages/admin/students/add_edit');
    }


    public function feeDetails()
    {
       //return view('pages/admin/students/fee_details');
    }



    public function details()
    {
       return view('pages/admin/students/details');
    }

}
