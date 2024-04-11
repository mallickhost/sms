<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentAcademicDetail extends Model
{
   protected $table = 'students_academic_details';

 


 
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
        return $this->belongsTo(ClassMaster::class,'class_master_id');
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
        $details = StudentAcademicDetail::select()
        ->with(['academicSession','student','class','section'])
        ->where('students_academic_details.academic_status','RUNNING')
        ->where('students_academic_details.student_id', $studentId)
        ->first();

        if(!empty($details)){
            return $details->toArray();
        }
        return [];

    }


   


    public function x_getStudentAcademicDetails($studentId){
        $details = StudentAcademicDetail::select('*')
       // ->leftJoin('academic_sessions', 'academic_sessions.id', '=', 'student_academic_details.academic_session_id')
       ->with(['academicSession' => function ($query) {
            $query->where('is_current', true);
        }])
        ->where('students_academic_details.student_id', $studentId)
        ->get();
        return $details->toArray();
    }
}