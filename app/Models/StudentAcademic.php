<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentAcademic extends Model
{
   protected $table = 'student_academic_details';

 


 
    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class);
    }


    public function student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }


    public function class()
    {
        return $this->belongsTo(AcademicClass::class,'academic_class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

 


     /**
	 * @desc Get student current academic details
	 *
	 * @param int $studentId
	 * 
	 * @return array
	 *
	 */

    public function getStudentCurrentAcademicDetails(int $studentId):array{
        $details = StudentAcademic::select()
        ->with(['academicSession','student','class','section'])
        ->where('student_academic_details.academic_status','RUNNING')
        ->where('student_academic_details.student_id', $studentId)
        ->first();

        if(!empty($details)){
            return $details->toArray();
        }
        return [];

    }


   


    public function x_getStudentAcademicDetails($studentId){
        $details = StudentAcademic::select('*')
       // ->leftJoin('academic_sessions', 'academic_sessions.id', '=', 'student_academic_details.academic_session_id')
       ->with(['academicSession' => function ($query) {
            $query->where('is_current', true);
        }])
        ->where('student_academic_details.student_id', $studentId)
        ->get();
        return $details->toArray();
    }
}