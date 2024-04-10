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
     * @param int $academicFeesId
	 *
	 * @return bool

	 */

     public function checkAlreadyAssinedFee(int $studentId , int $academicSessionId,int $academicFeesId):bool{
        $details = StudentFeeBreakup::select()
        ->where('student_id',$studentId)
        ->where('academic_session_id', $academicSessionId)
        ->where('academic_fees_id', $academicFeesId)
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
     * @param int $academicSessionId
	 *
	 * @return array

	 */

     public function getStudentFeesBreakupDetails(int $studentId,int $academicSessionId):array{
        return StudentFeeBreakup::select()
        ->with(['academicFees'=>['feesMaster']])
        ->where('student_id',$studentId)
        ->where('academic_session_id',$academicSessionId)
        ->get()
        ->toArray();

    }



     /**
	 * @desc check the academic_fees is already assigned or not
	 *
	 * @param array $breakupIds
	 *
	 * @return array

	 */

     public function getBreakupDetailsByIds(array $breakupIds):array{
        return StudentFeeBreakup::select()
        ->with(['academicFees'=>['feesMaster']])
        ->whereIn('id',$breakupIds)
        ->get()
        ->toArray();

    }


}