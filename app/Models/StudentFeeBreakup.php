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


    public function paymentTransactions()
    {
        return $this->hasMany(PaymentTransaction::class,'students_fees_breakups_id');
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

     public function getStudentFeesBreakupDetails(int $academicSessionId,int $studentId):array{
        return StudentFeeBreakup::select()
        ->with(['academicFees'=>['feesMaster'],'paymentTransactions'])
        ->where('student_id',$studentId)
        ->where('academic_session_id',$academicSessionId)
        ->get()
        ->toArray();

    }











     /**
	 * @desc check the academic_fees is assigned or not
	 *
	 * @param int $studentId
     * @param int $academicSessionId
	 *
	 * @return array

	 */

     public function checkAnyFeesPaidByStudent(int $academicSessionId,int $studentId):array{
        return StudentFeeBreakup::select()
        ->where('academic_session_id',$academicSessionId)
        ->where('student_id',$studentId)
        ->whereIn('payment_status', ['PARTIALY','FULL_PAID'])
        ->get()
        ->toArray();

    }










       /**
	 * @desc check the academic_fees is assigned or not
	 *
	 * @param int $studentId
     * @param int $academicSessionId
	 *
	 * @return bool

	 */

     public function deleteAssignFees(int $academicSessionId,int $studentId):bool{
      return StudentFeeBreakup::where('academic_session_id',$academicSessionId)
        ->where('student_id',$studentId)
        ->where('payment_status', 'NOT_PAID')
        ->delete();

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