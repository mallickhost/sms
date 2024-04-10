<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AcademicClass extends Model
{
    protected $table = 'academic_classes';

    public function academicFee()
    {
        return $this->hasMany(AcademicFee::class);
    }



    public function getFeeDetails($academic_session_id){

		$class = AcademicClass::select()
        ->with(['academicFee'=>['feesMaster']])
        ->where('is_deleted', false)
		->get();
		return $class->toArray();
	}

}