<?php

namespace App\Http\Controllers\Admin;

use App\Academic as AppAcademic;
use App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Academic;
use App\Models\AcademicFee;
use App\Models\StudentAcademic;
use App\Models\StudentFeeBreakup;
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
            'aadhaar_number' => 'required',
            'gender' => 'required',
          ]);
    
		$request_data = $request->all();


		DB::beginTransaction();

		try {

			Student::create($request_data);

			DB::commit();
		} catch (\Exception $e) {
			// Handle transaction failure
			DB::rollBack();
		}
		

        return redirect()->route('admin.students.list')->with('success', 'Student created successfully.');
      
    }


    public function updateStudent(Request $request)
    {
        $request->validate([
            'student_name' => 'required|max:100',
            'student_number' => 'required',
            'aadhaar_number' => 'required',
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
        $obj_student_academic = new StudentAcademic();
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
		$obj_student_academic  = new StudentAcademic();
		$current_academic = $obj_student_academic->getStudentCurrentAcademicDetails($student_id);

		if(!empty($current_academic)){
			// no current class/section found insert the new 
			$obj_student_academic = StudentAcademic::find($current_academic['id']);
		}
	
		$obj_student_academic->student_id = $student_id;
		$obj_student_academic->academic_session_id = $request_data['academic_session_id'];
		$obj_student_academic->academic_class_id = $request_data['academic_class_id'];
		$obj_student_academic->section_id = $request_data['section_id'];
		$obj_student_academic->roll_number = $request_data['roll_number'];
        // check 
		$obj_student_academic->academic_status ='RUNNING';
		$obj_student_academic->save();

		return redirect()->route('admin.students.details',$student_id)->with('success', 'Student academic data save successfully.');
	
	}


    public function assignFees($studentId){
        
        $obj_student_academic  = new StudentAcademic();
       
        //get fees already assigned or not   

        $student_details = $obj_student_academic->getStudentCurrentAcademicDetails($studentId);
        //only process if fees is not assigned to this student this acamenic session
        if(empty($student_details['is_fees_assigned'])){
           
            // get the fees which is assigned for this academic session
            $obj_academic_fee  = new AcademicFee();
            $arr_academic_fees =  $obj_academic_fee->getCurrentAssignedFees($student_details['academic_session_id'],$student_details['academic_class_id']);
       
            if(!empty($arr_academic_fees)){

                foreach($arr_academic_fees as $academic_fees){

                    $obj_student_fee_breakup  = new StudentFeeBreakup();

                    $data_exist =  $obj_student_fee_breakup->checkAlreadyAssinedFee($studentId,$academic_fees['academic_session_id'],$academic_fees['id']);
                
                   if(empty($data_exist)){

                        $amount = $academic_fees['total_amount']/$academic_fees['fees_master']['no_of_payments_in_a_year'];

                        // $this->p($academic_fees);
                        for($i=0;$i<$academic_fees['fees_master']['no_of_payments_in_a_year'];$i++){
                            $obj_student_fee_breakup  = new StudentFeeBreakup();
                        
                            $obj_student_fee_breakup->student_id = $studentId;
                            $obj_student_fee_breakup->academic_fees_id = $academic_fees['id'];
                            $obj_student_fee_breakup->academic_session_id = $academic_fees['academic_session_id'];
                            //todo the month will be calcuated according to the setting, if needed make a new colom for setting in fee_master
                            $obj_student_fee_breakup->month_name = date('M', mktime(0, 0, 0, $i+1, 1));
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
		$obj_student_academic  = new StudentAcademic();
		$current_academic = $obj_student_academic->getStudentCurrentAcademicDetails($student_id);

        $arr_ids = array_keys($request_data['payment_for']);
        $obj_student_fee_breakup  = new StudentFeeBreakup();
        $arr_fees = $obj_student_fee_breakup->getBreakupDetailsByIds($arr_ids);
        // $this->p($arr_fees);
        if(empty($arr_fees) || empty($current_academic)){
            return redirect()->route('admin.students.list',$student_id)->with('warning', 'Something went wrong.');
        }
        
        return view('pages/admin/students/payment_details',compact('arr_fees','current_academic'));
       
		
	
	}

}
