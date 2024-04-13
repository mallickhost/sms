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
	 * @param int $sessionId
	 *
	 * @return View

	 */
    public function academicFees(int $selectedSessionId=null):View {

    
      

        $obj_academic_session = new AcademicSession();
		$arr_all_session = $obj_academic_session->sessionList();
        
// $this->p($arr_all_session);
        $obj_class_master = new ClassMaster();


        if(empty($selectedSessionId)){
            //get the current session id
            $selectedSessionId = $obj_academic_session->getCurrentSessionId();
           
        }
       
      
        $arr_class_fees  = $obj_class_master->getFeeDetails($selectedSessionId);

        $arr_class = $obj_class_master->classList();


		$selected_academic_session_details = $obj_academic_session->getSessionDetailsById($selectedSessionId);

        return view("pages/admin/master_data/academic_fees",compact('arr_all_session','arr_class','arr_class_fees','selected_academic_session_details'));
   
    }





     /**
	 * @desc Assign the class fees
	 * @param int $sessionId
     * @param int $classId
     * 
	 *
	 * @return View

	 */
    public function assignClassFees(int $sessionId,int $classId):View {
  

        $obj_academic_fees = new AcademicFee();
        $arr_current_fess = $obj_academic_fees->getCurrentAssignedFees($sessionId,$classId);

        $obj_academic_session = new AcademicSession();
		$arr_session = $obj_academic_session->getSessionDetailsById($sessionId);

        $obj_class_master = new ClassMaster();
        $arr_class = $obj_class_master->getClassDetailsById($classId);

        $obj_fees = new FeesMaster();
        $arr_fees_master = $obj_fees->feesList();

        return view('pages/admin/master_data/modal_assign_fees',compact('arr_fees_master','arr_current_fess','arr_session','arr_class'));
   
    }





        /**
	 * @desc Do the login 
	 *
	 * @param Request $request
	 *
	 * @return RedirectResponse

	 */

    public function saveClassFees(Request $request):RedirectResponse{

        //todo need to add more logic for if fees is not assign then can change amount.. if 0 amount then delete the fees

        $request_data = $request->all();

        $request->validate([
            'academic_session_id' => 'required',
            'class_master_id' => 'required'
          ]);

        // $this->p($request_data);


        foreach($request_data['fee_amount'] as $fee_id => $fee_amount){

            

            // if not paid then 
            if(!empty($fee_amount)){
                // if fee is paid does not change the amount




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

        return redirect()->route('admin.masterdata.academicFees',[$request_data['academic_session_id']])->with('success', 'Fees data save successfully.');
        
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
