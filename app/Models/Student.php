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




     /**
	 * @desc get student details
	 *
	 * @param int $studentId
	 *
	 * @return array

	 */
    public function getStudentDetails(int $studentId):array{
        $details = Student::select()
        ->with(['academicDetails'=>['section','class','academicSession']])
        ->where('students.id', $studentId)
        ->first();

        if(!empty($details)){
            return $details->toArray();
        }
        return [];
    }

    
}
