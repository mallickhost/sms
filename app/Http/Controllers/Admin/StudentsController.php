<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Academic;
use App\Models\AcademicFee;
use App\Models\StudentAcademicDetail;
use App\Models\StudentFeeBreakup;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;



class StudentsController extends AdminAppController
{
    public function list(Request $request)
    {

        // print_r($request);die('xxx');
        $students = Student::latest()->paginate(10);
        //echo "<Pre/>";print_r($movies);die('xx');
        // die('this is student login page');
        // Session::flash('success', 'Successfully registerd now login'); StudentsAppController
        return View::make("pages/admin/students/list")->with('students',$students);
        //return view('pages/admin/students/list');
    }

    public function addEdit($studentId=null)
    {

		$studentData = [];
		if(!empty($studentId)){
			$studentData = Student::find($studentId)->toArray();
		}
    
        return view('pages/admin/students/modal_add_edit',compact('studentData'));
    }


    public function saveStudent(Request $request)
    {
        
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
            $file_name =  $file->store('students_images', ['disk' => 'local']);
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


    public function updateStudent(Request $request)
    {
        $request->validate([
            'student_name' => 'required|max:100',
            'student_number' => 'required',
            'gender' => 'required',
          ]);

		$request_data = $request->all();
		$student = Student::find($request_data['student_id']);
 
        $student->update($request_data);

        return redirect()->route('admin.students.list')
      ->with('success', 'Student update successfully.');
      
    }


    public function feeDetails($studentId)
    {
        $obj_student_academic = new StudentAcademicDetail();
		$student_data = $obj_student_academic->getStudentCurrentAcademicDetails($studentId);

        if(empty($student_data)){
			return redirect()->route('admin.students.list')->with('warning', 'Academic details not added.');
		}

        $obj_student_fee_breakup  = new StudentFeeBreakup();

        $arr_fees_data = $obj_student_fee_breakup->getStudentFeesBreakupDetails($studentId,$student_data['academic_session_id']);

         //$this->p($arr_fees_data);
       return view('pages/admin/students/fee_details',compact('student_data','arr_fees_data'));
    }



    public function details($studentId=null)
    {
		// academic session dropdown
		$obj_student = new Student();
		$arr_student = $obj_student->getStudentDetails($studentId);

		if(empty($arr_student)){
			return redirect()->route('admin.students.list')->with('warning', 'something went wrong.');
		}


		$obj_academic = new Academic();
		$arr_session = $obj_academic->list_session();
		$arr_class = $obj_academic->list_class();
		$arr_section = $obj_academic->list_section();
		
       return view('pages/admin/students/details',compact('arr_session','arr_class','arr_section','arr_student'));
    }


	public function updateAcademicDetails(Request $request){


		$request_data = $request->all();
        $student_id = $request_data['student_id'];

        if(empty($request_data['academic_session_id'])){
            return redirect()->route('admin.students.details',$student_id)->with('danger', 'Academic session is not set');
        }
	
		$obj_student_academic  = new StudentAcademicDetail();
		$current_academic = $obj_student_academic->getStudentCurrentAcademicDetails($student_id);
$this->p($current_academic);
		if(!empty($current_academic)){
			// no current class/section found insert the new 
			$obj_student_academic = StudentAcademicDetail::find($current_academic['id']);
		}
	
		$obj_student_academic->student_id = $student_id;
		$obj_student_academic->academic_session_id = $request_data['academic_session_id'];
		$obj_student_academic->class_master_id = $request_data['class_master_id'];
		$obj_student_academic->section_id = $request_data['section_id'];
		$obj_student_academic->roll_number = $request_data['roll_number'];
        // check 
		$obj_student_academic->academic_status ='RUNNING';

        DB::beginTransaction();

		try {

            $obj_student_academic->save();

			DB::commit();

            return redirect()->route('admin.students.details',$student_id)->with('success', 'Student academic data save successfully.');

		} catch (Exception $e) {
			// Handle transaction failure
			DB::rollBack();
            return redirect()->route('admin.students.details',$student_id)->with('danger',$e->getMessage());
		}
	

	
	}


    public function assignFees($studentId){
        
        $obj_student_academic  = new StudentAcademicDetail();
       
        //get fees already assigned or not   

        $student_details = $obj_student_academic->getStudentCurrentAcademicDetails($studentId);
        //only process if fees is not assigned to this student this acamenic session
        if(empty($student_details['is_fees_assigned'])){
           
            // get the fees which is assigned for this academic session
            $obj_academic_fee  = new AcademicFee();
            $arr_academic_fees =  $obj_academic_fee->getCurrentAssignedFees($student_details['academic_session_id'],$student_details['class_master_id']);
       
            if(!empty($arr_academic_fees)){

                foreach($arr_academic_fees as $academic_fees){

                    $obj_student_fee_breakup  = new StudentFeeBreakup();

                    $data_exist =  $obj_student_fee_breakup->checkAlreadyAssinedFee($studentId,$academic_fees['academic_session_id'],$academic_fees['id']);
                
                   if(empty($data_exist)){

                        $amount = $academic_fees['total_fees_amount']/$academic_fees['fees_master']['no_of_payments_in_a_year'];

                        // $this->p($academic_fees);
                        for($i=0;$i<$academic_fees['fees_master']['no_of_payments_in_a_year'];$i++){
                            $obj_student_fee_breakup  = new StudentFeeBreakup();
                        
                            $obj_student_fee_breakup->student_id = $studentId;
                            $obj_student_fee_breakup->academic_fees_id = $academic_fees['id'];
                            $obj_student_fee_breakup->academic_session_id = $academic_fees['academic_session_id'];
                            //todo the month will be calcuated according to the setting, if needed make a new colom for setting in fee_master
                            $obj_student_fee_breakup->month_name = strtoupper(date('M', mktime(0, 0, 0, $i+1, 1)));
                            $obj_student_fee_breakup->total_amount = $amount;
                            $obj_student_fee_breakup->paid_amount = '0.00';
                    
                            $obj_student_fee_breakup->save();
                        }

                   }
                
                }
                return redirect()->route('admin.students.fees',['studentId' => $studentId ])->with('success', 'Fees assigned successfully.');
            }else{
                return redirect()->route('admin.students.fees',['studentId' => $studentId ])->with('danger', 'Please assign Academic fees in Master data section.');
            }
        }
        
    }




    public function paymentDetails(Request $request){


		$request_data = $request->all();

        $student_id = $request_data['student_id'];
		$obj_student_academic  = new StudentAcademicDetail();
		$current_academic = $obj_student_academic->getStudentCurrentAcademicDetails($student_id);

        if(empty($request_data['payment_for'])){
            return redirect()->route('admin.students.fees',$student_id)->with('warning', 'No fees is checked for payment');
        }
        $arr_ids = array_keys($request_data['payment_for']);
        $obj_student_fee_breakup  = new StudentFeeBreakup();
        $arr_fees = $obj_student_fee_breakup->getBreakupDetailsByIds($arr_ids);
        // $this->p($arr_fees);
        if(empty($arr_fees) || empty($current_academic)){
            return redirect()->route('admin.students.list')->with('warning', 'Something went wrong.');
        }
        
        return view('pages/admin/students/payment_details',compact('arr_fees','current_academic'));
       
	}




    public function makePayment(Request $request){


		$request_data = $request->all();

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

// $this->p($obj_fee_breakup);


        }
        return redirect()->route('admin.students.fees',$request_data['student_id'])->with('success', 'Payment successfully.');

       
	}

}
