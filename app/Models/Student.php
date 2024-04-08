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
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

	public function academicDetails()
    {
        return $this->hasMany(StudentAcademic::class);
    }

    public function getStudentDetails($studentId){
        $details = Student::select()
       ->with('academicDetails')
        ->where('students.id', $studentId)
        ->first();
        return $details->toArray();
    }
}
