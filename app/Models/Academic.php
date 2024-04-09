<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Academic extends Model
{
	public function list_session($all=null){

		if(!empty($all)){
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


	public function list_class(){

		$class = DB::table('academic_classes')->select('id','class_name', 'class_roman_name')->where('is_deleted', false)->get();
		return $class->toArray();
	}


	public function list_section(){

		$section= DB::table('sections')->select('id','name')->where('is_deleted', false)->get();
		return $section->toArray();
	}

	public function getCurrentAcademicSession(){


		$session = DB::table('academic_sessions')->select('id','session_name', 'session_year','is_current')
		->where('is_deleted', false)
		->where('is_current', true)		
		->get();

		return $session->toArray();
	}
}