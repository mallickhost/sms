<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\FeesMaster;
use App\Models\Academic;
use App\Models\AcademicFee;
use App\Models\ClassMaster;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class MasterDatasController extends AdminAppController
{
    public function academicFees($academic_session_id=null)
    {
    

        $obj_academic = new Academic();
		$arr_session = $obj_academic->list_session();
        $arr_class = $obj_academic->list_class();

        // todo need to here dynamic
        $obj_academic_fee = new ClassMaster();
        $arr_class_fees  = $obj_academic_fee->getFeeDetails(2);


		// $current_academic_session = $obj_academic->getCurrentAcademicSession();

        return view("pages/admin/master_data/academic_fees",compact('arr_session','arr_class','arr_class_fees'));
   
    }


    public function assignClassFees()
    {
        $obj_academic = new Academic();
		$arr_session = $obj_academic->list_session();
        $arr_class = $obj_academic->list_class();

        $obj_fees = new FeesMaster();
        $arr_fees_master = $obj_fees->listFees();

        return view('pages/admin/master_data/modal_assign_fees',compact('arr_session','arr_class','arr_fees_master'));
   
    }


    public function saveClassFees(Request $request){
        $request_data = $request->all();

        foreach($request_data['amount'] as $fee_id => $fee_amount){
            if(!empty($fee_amount)){
                $obj_academic_fees = new AcademicFee();
                $existing = $obj_academic_fees->checkExistingFees($request_data['academic_session_id'],$fee_id,$request_data['class_master_id']);
                if(empty($existing)){
                    $obj_academic_fees->academic_session_id = $request_data['academic_session_id'];
                    $obj_academic_fees->class_master_id = $request_data['class_master_id'];
                    $obj_academic_fees->fees_master_id = $fee_id;
                    $obj_academic_fees->total_fees_amount = $fee_amount;
                    $obj_academic_fees->save();
                }
            }
        }

        return redirect()->route('admin.masterdata.academicFees')->with('success', 'Fees data save successfully.');
        
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
