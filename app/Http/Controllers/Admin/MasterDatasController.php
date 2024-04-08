<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Student;
use View;

class MasterDatasController extends AdminAppController
{
    public function fees(Request $request)
    {

         $username = session('currentActiveAcademic');
         //$this->printx($username);
         return view("pages/admin/master_data/fees");
   
    }

    public function addEdit()
    {
        // modal best example https://www.youtube.com/watch?v=LzYqAx0Qh6Y
        // die('this is student login page');
        // Session::flash('success', 'Successfully registerd now login'); StudentsAppController
        return view('pages/admin/students/add_edit');
    }


    public function feeDetails()
    {
       return view('pages/admin/students/fee_details');
    }



    public function details()
    {
       return view('pages/admin/students/details');
    }

}
