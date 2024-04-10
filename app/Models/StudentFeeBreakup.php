<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentFeeBreakup extends Model
{
    protected $table = 'students_fees_breakups';


 /**
	 * @desc check the academic_fees is already assigned or not
	 *
	 * @param int $studentId
     * @param int $academicFeesId
	 *
	 * @return bool

	 */

     public function checkAlreadyAssinedFee(int $studentId , int $academicFeesId):bool{
        $details = StudentFeeBreakup::select('id')
        ->where('student_id',$studentId)
        ->where('academic_fees_id', $academicFeesId)
        ->get();

        if(!empty($details)){
            return true;
        }
        return false;

    }


}