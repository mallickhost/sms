<?php

namespace App\Http\Controllers\Admin;

use Exception;

use App\Models\Section;
use App\Models\Student;
use App\Models\ClassMaster;
use App\Models\AcademicFee;
use App\Models\AcademicSession;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\StudentFeeBreakup;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\DB;
use App\Models\StudentAcademicDetail;
use Illuminate\Support\Facades\Storage;



class StudentsController extends AdminAppController
{









       /**
	 * @desc Student list for laravel pagination
	 *
	 * @param Request $request
	 *
	 * @return View

	 */
    public function list(Request $request):View {

        // print_r($request);die('xxx');
        $students = Student::latest()->paginate(10);
        //echo "<Pre/>";print_r($movies);die('xx');
        // die('this is student login page');
        // Session::flash('success', 'Successfully registerd now login'); StudentsAppController
        return view('pages/admin/students/list',compact('students'));
        //return view('pages/admin/students/list');
    }









    /**
	 * @desc open add edit modal
	 *
	 * @param int|null $studentId
	 *
	 * @return View

	 */

    public function addEdit(int|null $studentId=null):View {

		$studentData = [];
		if(!empty($studentId)){
			$studentData = Student::find($studentId)->toArray();
		}
    
        return view('pages/admin/students/modal_add_edit',compact('studentData'));
    }






      /**
	 * @desc open add edit modal
	 *
	 * @param Request $request
	 *
	 * @return RedirectResponse

	 */

    public function saveStudent(Request $request):RedirectResponse {
        
        $request->validate([
            'student_name' => 'required|max:100',
            'student_number' => 'required',
            'gender' => 'required',
            'mobile_no_1' => 'required',
            'father_name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
          ]);

          


        $file_name = '';
        if ($request->hasFile('uplaod_pic')) {
            $file = request()->file('uplaod_pic');
            $file_name =  $file->store('students_images', ['disk' => 'public']);
            $request->request->add(['picture' => $file_name]);
           
        }

		DB::beginTransaction();

		try {

			Student::create($request->all());

			DB::commit();

            return redirect()->route('admin.students.list')->with('success', 'Student created successfully.');

		} catch (Exception $e) {
			// Handle transaction failure
			DB::rollBack();
            return redirect()->route('admin.students.list')->with('danger',$e->getMessage());
		}

       

        return redirect()->route('admin.students.list')->with('danger', 'Unable to save Student data.');
      
    }










     /**
	 * @desc open add edit modal
	 *
	 * @param Request $request
	 *
	 * @return RedirectResponse

	 */

    public function updateStudent(Request $request):RedirectResponse{
        $request->validate([
            'student_name' => 'required|max:100',
            'student_number' => 'required',
            'gender' => 'required',
            'mobile_no_1' => 'required',
            'father_name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
          ]);

		$request_data = $request->all();
		$student = Student::find($request_data['student_id']);
 
        $file_name = '';
        if ($request->hasFile('uplaod_pic')) {
 
            $existing_file_path = ''.$student->picture;

            if (Storage::exists($existing_file_path)) {
                Storage::delete($existing_file_path);
            }

            $file = request()->file('uplaod_pic');
            $file_name =  $file->store('students_images', ['disk' => 'public']);
            $student->picture = $file_name;
           
        }


        DB::beginTransaction();

		try {

            $student->update($request_data);

			DB::commit();

            return redirect()->route('admin.students.list')->with('success', 'Student updated successfully.');

		} catch (Exception $e) {
			// Handle transaction failure
			DB::rollBack();
            return redirect()->route('admin.students.list')->with('danger',$e->getMessage());
		}
       
      
    }







     /**
	 * @desc open add edit modal
	 *
	 * @param int $studentId
     * @param int $academicSessionId
	 *
	 * @return View|RedirectResponse

	 */

    public function feeDetails(int $studentId,int $academicSessionId):View|RedirectResponse {

        $obj_student_academic = new StudentAcademicDetail();
        $academics = $obj_student_academic->getSessionWiseAcademicDetails($studentId,$academicSessionId);

        $obj_student_fee_breakup  = new StudentFeeBreakup();
        $arr_fees_data = $obj_student_fee_breakup->getStudentFeesBreakupDetails($academicSessionId,$studentId);

        $obj_accademic_session = new AcademicSession();
        $arr_academic_session = $obj_accademic_session->getSessionDetailsById($academicSessionId); 

   
       return view('pages/admin/students/fee_details',compact('arr_fees_data','arr_academic_session','academics'));
    }








     /**
	 * @desc Session list for dropdown
	 *
	 * @param int $studentId
	 *
	 * @return View|RedirectResponse

	 */

    public function details(int $studentId=null): View|RedirectResponse {
	
		$obj_student = new Student();
		$arr_student = $obj_student->getStudentDetails($studentId);

		if(empty($arr_student)){
			return redirect()->route('admin.students.list')->with('warning', 'something went wrong.');
		}
    

        $obj_academic_session = new AcademicSession();
		$arr_session = $obj_academic_session->sessionList();

        $obj_class_master = new ClassMaster();
        $arr_class = $obj_class_master->classList();

        $obj_section = new Section();
        $arr_section = $obj_section->sectionList();


        $obj_academic_details = new StudentAcademicDetail();
        $arr_history = $obj_academic_details->getStudentAcademicHistory($studentId);

        // $this->p($arr_history);

       return View('pages/admin/students/details',compact('arr_session','arr_class','arr_section','arr_student','arr_history'));
    }








   /**
	 * @desc open add edit modal
	 *
	 * @param Request $request
	 *
	 * @return RedirectResponse

	 */

	public function updateAcademicDetails(Request $request):RedirectResponse{

        $request->validate([
            'academic_session_id' => 'required',
            'student_id' => 'required',
            'class_master_id' => 'required',
            'section_id' => 'required',
            'roll_number' => 'required'
          ]);

		$request_data = $request->all();

      

        $obj_student_academic = new StudentAcademicDetail();

        $already_read_class = $obj_student_academic->getClassWiseAcademicDetails($request_data['student_id'],$request_data['class_master_id']);

        if(!empty($already_read_class)){
            return redirect()->route('admin.students.details',$request_data['student_id'])->with('danger','Student already read in this class');
        }

     

    
		if(!empty($request_data['id'])){
			
			$obj_student_academic = StudentAcademicDetail::find($request_data['id']);
           

            // check if the class fees is already assign and paid then class not changed
            // if the fees is assigned but not paid then delete all assigned

            if($obj_student_academic->class_master_id != $request_data['class_master_id']){
              
                $obj_student_fee_breakup  = new StudentFeeBreakup();
                
                $arr_paid_fees = $obj_student_fee_breakup->checkAnyFeesPaidByStudent($obj_student_academic->academic_session_id,$obj_student_academic->student_id);

                if(!empty($arr_paid_fees)){
                    return redirect()->route('admin.students.details',$obj_student_academic->student_id)->with('danger',"Already fees paid can't change the class");
                }else{
                    $obj_student_fee_breakup->deleteAssignFees($obj_student_academic->academic_session_id,$obj_student_academic->student_id); 
                
                }
             
            }

		}else{

            $already_asigned_session = $obj_student_academic->getSessionWiseAcademicDetails($request_data['student_id'],$request_data['academic_session_id']);

            if(!empty($already_asigned_session)){
                return redirect()->route('admin.students.details',$request_data['student_id'])->with('danger','Student already assign to the session - '.$already_asigned_session['academic_session']['session_name']);
            }
           
        }
       



		$obj_student_academic->student_id = $request_data['student_id'];
		$obj_student_academic->academic_session_id = $request_data['academic_session_id'];
		$obj_student_academic->class_master_id = $request_data['class_master_id'];
		$obj_student_academic->section_id = $request_data['section_id'];
		$obj_student_academic->roll_number = $request_data['roll_number'];
        // check 

        if(!empty($request_data['is_passed'])){
            $obj_student_academic->academic_status ='PASSED';
        }else{
            $obj_student_academic->academic_status ='RUNNING';
        }


        DB::beginTransaction();

		try {

            $obj_student_academic->save();

			DB::commit();

            return redirect()->route('admin.students.details',$request_data['student_id'])->with('success', 'Student academic data save successfully.');

		} catch (Exception $e) {
			// Handle transaction failure
			DB::rollBack();
            return redirect()->route('admin.students.details',$request_data['student_id'])->with('danger',$e->getMessage());
		}
	

	
	}



       /**
	 * @desc open add edit modal
	 *
	 * @param int $studentId
     * @param int $academicSessionId
	 *
	 * @return RedirectResponse

	 */
    public function assignFees(int $studentId,int $academicSessionId):RedirectResponse{
        
        $obj_student_academic  = new StudentAcademicDetail();
        $student_details = $obj_student_academic->getStudentCurrentAcademicDetails($studentId);
       
        //get fees already assigned or not   

       
        //only process if fees is not assigned to this student this acamenic session

        // $this->p($student_details);
  
           
            // get the fees which is assigned for this academic session
            $obj_academic_fee  = new AcademicFee();
            $arr_academic_fees =  $obj_academic_fee->getCurrentAssignedFees($academicSessionId,$student_details['class_master_id']);
       
            if(!empty($arr_academic_fees)){

                foreach($arr_academic_fees as $academic_fees){

                    $obj_student_fee_breakup  = new StudentFeeBreakup();

                    $data_exist =  $obj_student_fee_breakup->checkAlreadyAssinedFee($studentId,$academicSessionId,$academic_fees['id']);
                
                   if(empty($data_exist)){

                        $amount = $academic_fees['total_fees_amount']/$academic_fees['fees_master']['no_of_payments_in_a_year'];

                        // $this->p($academic_fees);
                        for($i=0;$i<$academic_fees['fees_master']['no_of_payments_in_a_year'];$i++){
                            $obj_student_fee_breakup  = new StudentFeeBreakup();
                        
                            $obj_student_fee_breakup->student_id = $studentId;
                            $obj_student_fee_breakup->academic_fees_id = $academic_fees['id'];
                            $obj_student_fee_breakup->academic_session_id = $academicSessionId;
                            //todo the month will be calcuated according to the setting, if needed make a new colom for setting in fee_master
                            $obj_student_fee_breakup->month_name = strtoupper(date('M', mktime(0, 0, 0, $i+1, 1)));
                            $obj_student_fee_breakup->total_amount = round($amount,0);
                            $obj_student_fee_breakup->paid_amount = '0.00';
                    
                            $obj_student_fee_breakup->save();
                        }

                   }
                
                }
                return redirect()->route('admin.students.fees',['studentId' => $studentId,'academicSessionId' => $academicSessionId ])->with('success', 'Fees assigned successfully.');
            }else{
                return redirect()->route('admin.students.fees',['studentId' => $studentId,'academicSessionId' => $academicSessionId ])->with('danger', 'Please assign Academic fees in Master data section.');
            }
        
        
    }



   /**
	 * @desc open add edit modal
	 *
	 * @param Request $request
	 *
	 * @return View|RedirectResponse

	 */
    public function paymentDetails(Request $request):View|RedirectResponse{


		$request_data = $request->all();

   

 
		$obj_student_academic  = new StudentAcademicDetail();
		$current_academic = $obj_student_academic->getSessionWiseAcademicDetails($request_data['student_id'],$request_data['academic_session_id']);
        //  $this->p($current_academic);
        if(empty($request_data['payment_for'])){
            return redirect()->route('admin.students.fees',[$request_data['student_id'],$request_data['academic_session_id']])->with('warning', 'No fees is checked for payment');
        }
        $arr_ids = array_keys($request_data['payment_for']);
        $obj_student_fee_breakup  = new StudentFeeBreakup();
        $arr_fees = $obj_student_fee_breakup->getBreakupDetailsByIds($arr_ids);
        // $this->p($current_academic);
        if(empty($arr_fees) || empty($current_academic)){
            return redirect()->route('admin.students.list')->with('warning', 'Something went wrong.');
        }
        
        return view('pages/admin/students/payment_details',compact('arr_fees','current_academic'));
       
	}












         /**
	 * @desc open add edit modal
	 *
	 * @param Request $request
	 *
	 * @return RedirectResponse

	 */
    public function makePayment(Request $request):RedirectResponse{


		$request_data = $request->all();
        // $this->p($request_data);

        if(empty($request_data['paid_amount'])){

            return redirect()->route('admin.students.list')->with('warning', 'Something went wrong.');
        }
      
        if($request_data['payment_mode'] == "ONLINE"){
            $txn = "ON".time();
        }else{
            $txn = "CA".time();
        }
        $transaction_number = !empty($request_data['transaction_nubmer'])?$request_data['transaction_nubmer']:$txn;

        foreach($request_data['paid_amount'] as $id=>$current_paid_amount){
            
            $obj_payment_transaction = new PaymentTransaction();
            $obj_payment_transaction->students_fees_breakups_id = $id;
            $obj_payment_transaction->payment_mode = $request_data['payment_mode'];
            $obj_payment_transaction->payment_date = $request_data['payment_date'];
            $obj_payment_transaction->transaction_number = $transaction_number;
            $obj_payment_transaction->paid_amount = $current_paid_amount;
            $obj_payment_transaction->transaction_note = $request_data['transaction_note'];
            $obj_payment_transaction->is_paid = true;
            $obj_payment_transaction->save();

            //update students_fees_breakups table
          
            $obj_fee_breakup = StudentFeeBreakup::find($id);
            // echo $obj_fee_breakup->paid_amount + $current_paid_amount;;
            //  $this->p($obj_fee_breakup);

            $remaining_amount = $obj_fee_breakup->total_amount - $obj_fee_breakup->paid_amount;
    
            if($remaining_amount == $current_paid_amount){
                $payment_status = "FULL_PAID";
            }else{
                $payment_status = "PARTIALY";
            }

            $obj_fee_breakup->paid_amount = $obj_fee_breakup->paid_amount + $current_paid_amount;
            $obj_fee_breakup->payment_status = $payment_status;
            $obj_fee_breakup->save();



        }
        return redirect()->route('admin.students.fees',[$request_data['student_id'],$request_data['academic_session_id']])->with('success', 'Payment successfully.');

       
	}



    









         /**
	 * @desc open add edit modal
	 *
	 * @param int $academicDetailsId
	 *
	 * @return View

	 */
    public function editAcademicDetails(int $academicDetailsId):View{
        $obj_academic_session = new AcademicSession();
		$arr_session = $obj_academic_session->sessionList();

        $obj_class_master = new ClassMaster();
        $arr_class = $obj_class_master->classList();

        $obj_section = new Section();
        $arr_section = $obj_section->sectionList();

        $obj_student_academic =  StudentAcademicDetail::find($academicDetailsId);


        return view('pages/admin/students/modal_edit_academic_details',compact('arr_session','arr_class','arr_section','obj_student_academic'));
    }











         /**
	 * @desc open add edit modal
	 *
	 * @param int $studentId
	 *
	 * @return View

	 */
    public function displayFees(int $studentId):View{
        $obj_student_academic = new StudentAcademicDetail();
		$student_data = $obj_student_academic->getStudentCurrentAcademicDetails($studentId);

        if(empty($student_data)){
			return redirect()->route('admin.students.list')->with('warning', 'Academic details not added.');
		}

        $obj_student_fee_breakup  = new StudentFeeBreakup();

        $arr_fees_data = $obj_student_fee_breakup->getStudentFeesBreakupDetails($student_data['academic_session_id'],$studentId);



        return view('pages/admin/students/modal_display_fees',compact('student_data','arr_fees_data'));
    }












         /**
	 * @desc open add edit modal
	 *
	 * @param int $studentId
	 *
	 * @return View

	 */


    public function promoteToNextClass(int $studentId):View{

        //check if running class is there if not then promot otherwise alert
        $obj_student = new Student();
        $arr_student = $obj_student->getStudentDetails($studentId);


        $obj_academic_session = new AcademicSession();
		$arr_session = $obj_academic_session->sessionList();

        $obj_class_master = new ClassMaster();
        $arr_class = $obj_class_master->classList();

        $obj_section = new Section();
        $arr_section = $obj_section->sectionList();

        // $this->p($arr_student);

        return view('pages/admin/students/modal_promote_next_class',compact('arr_session','arr_class','arr_section','arr_student'));
       }
    
}
