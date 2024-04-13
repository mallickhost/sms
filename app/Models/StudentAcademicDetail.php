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
	 * @desc Get student academic details history
	 *
	 * @param int $studentId
	 * 
	 * @return array
	 *
	 */


     public function getStudentAcademicHistory(int $studentId):array{
        return StudentAcademicDetail::select()
        ->with(['academicSession','class','section'])
        ->where('students_academic_details.student_id', $studentId)
        ->orderBy('students_academic_details.id','desc')
        ->get()
        ->toArray();

    }






 /**
	 * @desc Get student current running class
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


   










/**
	 * @desc Get student sessionwise class info
	 *
	 * @param int $studentId
     * @param int $sessionId
	 * 
	 * @return array
	 *
	 */



     public function getSessionWiseAcademicDetails(int $studentId,int $sessionId):array{
        $details = StudentAcademicDetail::select()
        ->with(['academicSession','student','class','section'])
        ->where('students_academic_details.student_id', $studentId)
        ->where('students_academic_details.academic_session_id', $sessionId)
        ->first();

        if(!empty($details)){
            return $details->toArray();
        }
        return [];

    }




    /**
	 * @desc Get student sessionwise class info
	 *

     * @param int $studentId
     * @param int $classMasterId
	 * 
	 * @return array
	 *
	 */



     public function getClassWiseAcademicDetails(int $studentId,int $classMasterId):array{
        $details = StudentAcademicDetail::select()
        ->with(['academicSession','student','class','section'])
        ->where('students_academic_details.student_id', $studentId)
        ->where('students_academic_details.class_master_id', $classMasterId)
        ->whereNotIn('students_academic_details.academic_status', ['RUNNING'])
        ->first();

        if(!empty($details)){
            return $details->toArray();
        }
        return [];

    }









 /**
	 * @desc Get student current running class
	 *
	 * @param int $studentId
	 * 
	 * @return array
	 *
	 */

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