<?php

namespace App\Http\Controllers\Admin;



use App\Models\FeesMaster;
use App\Models\AcademicFee;
use App\Models\ClassMaster;
use Illuminate\Http\Request;
use App\Models\AcademicSession;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MasterDatasController extends AdminAppController
{








        /**
	 * @desc Do the login 
	 *
	 * @param int $academicSessionId
	 *
	 * @return View

	 */
    public function academicFees(int $academicSessionId=null):View {
    

        $obj_academic_session = new AcademicSession();
		$arr_session = $obj_academic_session->sessionLIst();
        

        // todo need to here dynamic
        $obj_class_master = new ClassMaster();
        $arr_class_fees  = $obj_class_master->getFeeDetails(2);


        $arr_class = $obj_class_master->classList();


		// $current_academic_session = $obj_academic->getCurrentAcademicSession();

        return view("pages/admin/master_data/academic_fees",compact('arr_session','arr_class','arr_class_fees'));
   
    }





     /**
	 * @desc Assign the class fees
	 *
	 *
	 * @return View

	 */

    public function assignClassFees():View {
        $obj_academic_session = new AcademicSession();
		$arr_session = $obj_academic_session->sessionLIst();

        $obj_class_master = new ClassMaster();
        $arr_class = $obj_class_master->classList();

        $obj_fees = new FeesMaster();
        $arr_fees_master = $obj_fees->feesList();

        return view('pages/admin/master_data/modal_assign_fees',compact('arr_session','arr_class','arr_fees_master'));
   
    }





        /**
	 * @desc Do the login 
	 *
	 * @param Request $request
	 *
	 * @return RedirectResponse

	 */

    public function saveClassFees(Request $request):RedirectResponse{
        $request_data = $request->all();

        if(empty($request_data['academic_session_id'])){
            return redirect()->route('admin.masterdata.academicFees')->with('danger', 'Academic session is not set');
        }

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






        /**
	 * @desc Do the login 
	 *
	 *
	 * @return View

	 */

    public function addEdit():View {

        //  $username = session('currentActiveAcademic');
         //$this->printx($username);
        // modal best example https://www.youtube.com/watch?v=LzYqAx0Qh6Y
        // die('this is student login page');
        // Session::flash('success', 'Successfully registerd now login'); StudentsAppController
        return view('pages/admin/students/add_edit');
    }









        /**
	 * @desc Do the login 
	 *
	 * @param Request $request
	 *
	 * @return View

	 */


    public function feeDetails() {
       //return view('pages/admin/students/fee_details');
    }










        /**
	 * @desc Do the login 
	 *
	 * @param Request $request
	 *
	 * @return View

	 */


    public function details():View{
       return view('pages/admin/students/details');
    }

}
