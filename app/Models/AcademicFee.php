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



	  /**
	 * @desc Get any fees is already assign to the provided academic sesstion 
	 *
	 * @param int $academic_session_id
	 * @param int $fees_master_id
	 * @param int $academic_class_id
	 *
	 * @return array
	 *
	 */

	public function checkExistingFees(int $academic_session_id,int $fees_master_id,int $academic_class_id):array{

		return AcademicFee::select('id')
		->where('fees_master_id', $fees_master_id)
		->where('academic_session_id', $academic_session_id)
		->where('academic_class_id', $academic_class_id)
		->where('is_deleted', false)
		->get()
		->toArray();
	}





	  /**
	 * @desc Get Assigned fees to the class in current academic session
	 *
	 * @param int $academic_session_id
	 * @param int $academic_class_id
	 *
	 * @return array
	 *
	 */

	public function getCurrentAssignedFees(int $academic_session_id,int $academic_class_id):array{

		return AcademicFee::select()
		->with('feesMaster')
		->where('academic_session_id', $academic_session_id)
		->where('academic_class_id', $academic_class_id)
		->where('is_deleted', false)
		->get()
		->toArray();

	}


}