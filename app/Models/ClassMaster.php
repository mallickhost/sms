<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClassMaster extends Model
{
    protected $table = 'class_masters';

    public function academicFee()
    {
        return $this->hasMany(AcademicFee::class);
    }



    public function getFeeDetails($academic_session_id){

		$class = ClassMaster::select()
        ->with(['academicFee'=>['feesMaster']])
        ->where('is_deleted', false)
		->get();
		return $class->toArray();
	}

}