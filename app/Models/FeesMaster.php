<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FeesMaster extends Model
{
    protected $table = 'fees_masters';


    public function feesList(){

		$class = FeesMaster::select(['id','fees_name', 'no_of_payments_in_a_year','payment_type'])
		->where('is_deleted', false)
		->get();
		return $class->toArray();
	}
}