<?php

namespace App\Http\Controllers\Admin;

use App\Academic as AppAcademic;
use App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Academic;
use App\Models\StudentAcademic;
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


    public function feeDetails()
    {
       return view('pages/admin/students/fee_details');
    }



    public function details($studentId=null)
    {
		// academic session dropdown
		$obj_student = new Student();
		$arr_student = $obj_student->getStudentDetails($studentId);

		if(empty($arr_student)){
			return redirect()->route('admin.students.list')->with('warning', 'something went wrong.');
		}
$this->p($arr_student);

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
			$obj_student_academic = StudentAcademic::find($current_academic->id);
		}
	
		$obj_student_academic->student_id = $student_id;
		$obj_student_academic->academic_session_id = $request_data['academic_session_id'];
		$obj_student_academic->academic_class_id = $request_data['academic_class_id'];
		$obj_student_academic->section_id = $request_data['section_id'];
		$obj_student_academic->roll_number = $request_data['roll_number'];
		$obj_student_academic->academic_status =1;
		$obj_student_academic->save();

		return redirect()->route('admin.students.details',$student_id)->with('success', 'Student academic data save successfully.');
	
	}

}
