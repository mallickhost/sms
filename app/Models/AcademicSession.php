<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AcademicSession extends Model
{
    protected $table = 'academic_sessions';






     /**
	 * @desc Session list for dropdown
	 *
	 * @param bool $showAll
	 *
	 * @return array

	 */

    public function sessionLIst(bool $showAll = false):array{

		if(!empty($showAll)){
			$session = DB::table('academic_sessions')->select('id','session_name', 'session_year','is_current')
			->where('is_deleted', false)
			->orderByDesc('session_year')
			->get();
		}else{
			$session = DB::table('academic_sessions')->select('id','session_name', 'session_year','is_current')
			->where('is_deleted', false)
			->where('is_current', true)		
			->get();
		}

		return $session->toArray();
	}
}