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


 

    public function getStudentCurrentAcademicDetails($studentId){
        $details = StudentAcademic::select('*')
        ->with('academicSession')
        ->where('student_academic_details.academic_status',1)
        ->where('student_academic_details.student_id', $studentId)
        ->first();
        return $details;
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