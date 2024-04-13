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




       /**
	 * @desc Class list for dropdown
	 *
	 *
	 * @return array

	 */

    public function classList():array{

		$class = ClassMaster::select(['id','class_name', 'class_roman_name'])
		->where('is_deleted', false)
		->get();
		return $class->toArray();
	}













	     /**
	 * @desc Class list for dropdown
	 * @param int $academicSessionId
	 *
	 * @return array

	 */

    public function getFeeDetails(int $academicSessionId):array{

		$class = ClassMaster::select()
        ->with(['academicFee'=>function($q) use($academicSessionId){
			$q->where('academic_session_id',$academicSessionId);
			$q->with('feesMaster');
		}])
        ->where('is_deleted', false)
		->get();
		return $class->toArray();
	}











	     /**
	 * @desc Class detaisl by id
	 * 
	 * @param int $classId
	 *
	 * @return array

	 */

	 public function getClassDetailsById(int $classId):array{

		$class = ClassMaster::select()
        ->where('id', $classId)
		->first();

        if(!empty($class)){
            return $class->toArray();
        }
        return [];
	}

}