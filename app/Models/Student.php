<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{

    use Notifiable;

    protected $guard = 'student';

    protected $fillable = [
        'student_name', 
        'student_number',
        'aadhaar_number',
        'dob',
        'gender',
        'father_name',
        'mother_name',
        'mobile_no_1',
        'mobile_no_2',
        'address',
        'password',
        'picture',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

	public function academicDetails()
    {
        return $this->hasMany(StudentAcademicDetail::class);
    }



    public function currentAcademicDetails()
    {
        return $this->hasOne(StudentAcademicDetail::class,'student_id')->where('academic_status', 'RUNNING');
    }







     /**
	 * @desc get student details with running academics
	 *
	 * @param int $studentId
	 *
	 * @return array

	 */
    public function getStudentDetails(int $studentId):array{
        $details = Student::select()
        ->with(['currentAcademicDetails'=>['section','class','academicSession']])
        ->where('students.id', $studentId)
        ->where('students.is_deleted', false)
        ->first();

        if(!empty($details)){
            return $details->toArray();
        }
        return [];
    }

    













     /**
	 * @desc get student details with running academics
	 *
	 * @param string $studentNumber
	 *
	 * @return bool

	 */
    public function checkFirstTimeLogin(string $studentNumber):bool{
        $details = Student::select()
        ->where('students.student_number', $studentNumber)
        ->where('students.first_time_login', true)
        ->where('students.is_deleted', false)
        ->where('students.is_active', true)
        ->first();

        if(!empty($details)){
            return true;
        }
        return false;
    }










     /**
	 * @desc get student details with running academics
	 *
	 * @param int $studentId
	 *
	 * @return array

	 */
    public function x_getStudentDetails(int $studentId):array{
        $details = Student::select()
        ->with(['academicDetails'=> function($q)  {

            $q->where('academic_status', 'RUNNING'); 
            $q->with(['section','class','academicSession']);
        }])
        ->where('students.id', $studentId)
        ->where('students.is_deleted', false)
        ->first();

        if(!empty($details)){
            return $details->toArray();
        }
        return [];
    }


    
}
