<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentFeeBreakup extends Model
{
    protected $table = 'students_fees_breakups';



    public function academicFees()
    {
        return $this->belongsTo(AcademicFee::class,'academic_fees_id');
    }


    /**
	 * @desc check the academic_fees is already assigned or not
	 *
	 * @param int $studentId
     * @param int $academicSessionId
     * @param int $feeMasterId
	 *
	 * @return bool

	 */

     public function checkAlreadyAssinedFee(int $studentId , int $academicSessionId,int $feeMasterId):bool{
        $details = StudentFeeBreakup::select('id')
        ->where('student_id',$studentId)
        ->where('academic_session_id', $academicSessionId)
        ->where('fees_master_id', $feeMasterId)
        ->get()
        ->toArray();
        
        if(!empty($details)){
            return true;
        }
        return false;

    }




     /**
	 * @desc check the academic_fees is already assigned or not
	 *
	 * @param int $studentId
	 *
	 * @return array

	 */

     public function getBreakupDetails(int $studentId):array{
        return StudentFeeBreakup::select()
        ->with(['academicFees'=>['feesMaster']])
        ->where('student_id',$studentId)
        ->get()
        ->toArray();

        
       

    }


}