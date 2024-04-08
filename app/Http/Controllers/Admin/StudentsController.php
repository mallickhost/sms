<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\View;


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
    
      $students =   Student::create($request->all());
        return redirect()->route('admin.students.list')
      ->with('success', 'Student created successfully.');
      
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
		if(!empty($studentId)){
			
		}
       return view('pages/admin/students/details');
    }

}
