<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AjaxController extends ApiController
{
    public function clientList(Request $request)
    {

        if(!$request->ajax()) {
            return redirect('/api');
        }
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = User::select('count(*) as allcount')->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = User::orderBy($columnName, $columnSortOrder)
          ->where('users.name', 'like', '%' .$searchValue . '%')
          ->select('users.*')
          ->skip($start)
          ->take($rowperpage)
          ->get();



        $data_arr = [];

        foreach($records as $record) {
            $id = $record->id;
            $name = $record->name;
            $email = $record->email;
            $telephone = $record->telephone;

            $data_arr[] = [
              "id" => $id,
              "telephone" => $telephone,
              "name" => $name,
              "email" => $email
            ];
        }

        $response = [
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        ];


        return response()->json($response);
    }


    //https://stackoverflow.com/questions/39693168/populate-datatable-from-ajax-json
}
