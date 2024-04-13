<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AcademicFee extends Model
{
    protected $table = 'academic_fees';



	public function feesMaster()
    {
        return $this->belongsTo(FeesMaster::class,'fees_master_id');
    }


	public function class()
    {
        return $this->belongsTo(ClassMaster::class,'class_master_id');
    }



	  /**
	 * @desc Get any fees is already assign to the provided academic sesstion 
	 *
	 * @param int $academicSessionId
	 * @param int $feesMasterId
	 * @param int $classMasterId
	 *
	 * @return array
	 *
	 */

	public function checkExistingFees(int $academicSessionId,int $feesMasterId,int $classMasterId):array{

		return AcademicFee::select('id')
		->where('fees_master_id', $feesMasterId)
		->where('academic_session_id', $academicSessionId)
		->where('class_master_id', $classMasterId)
		->where('is_deleted', false)
		->get()
		->toArray();
	}





	  /**
	 * @desc Get Assigned fees to the class in current academic session
	 *
	 * @param int $academicSessionId
	 * @param int $classMasterId
	 *
	 * @return array
	 *
	 */

	public function getCurrentAssignedFees(int $academicSessionId,int $classMasterId):array{

		return AcademicFee::select()
		->with('feesMaster')
		->where('academic_session_id', $academicSessionId)
		->where('class_master_id', $classMasterId)
		->where('is_deleted', false)
		->get()
		->toArray();

	}






}