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

    public function sessionList():array{

		
		$session = AcademicSession::select('id','session_name', 'session_year','is_current')
		->where('is_deleted', false)
		->orderByDesc('session_year')
		->get();
	
		return $session->toArray();
	}




	/**
	 * @desc return only the curent active session id
	 *
	 * @param bool $showAll
	 *
	 * @return int

	 */

	 public function getCurrentSessionId():int{

	
		$session = AcademicSession::select('id')
		->where('is_deleted', false)
		->where('is_current', true)
		->first();

		return $session->id;

	}













	/**
	 * @desc return only the curent active session id
	 *
	 * @param int $sessionId
	 *
	 * @return array

	 */

	 public function getSessionDetailsById(int $sessionId):array{

	
		$session = AcademicSession::select()
		->where('id', $sessionId)
		->first();

		if(!empty($session)){
            return $session->toArray();
        }
        return [];

	}




}