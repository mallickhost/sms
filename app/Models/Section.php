<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Section extends Model
{
    protected $table = 'sections';




    /**
	 * @desc Section list for dropdown
	 *
	 *
	 * @return array

	 */

	public function sectionList(){

		$section= Section::select(['id','name'])->where('is_deleted', false)->get();
		return $section->toArray();
	}
    
}