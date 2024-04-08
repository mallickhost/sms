<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class TestController extends ApiController
{
    public function index()
    {
        $x ='{
            "draw": 2,
            "recordsTotal": 57,
            "recordsFiltered": 57,
            "data": [
              [
                "Charde",
                "Marshall",
                "Regional Director",
                "San Francisco",
                "16th Oct 08",
                "$470,600"
              ]
            }';
        return response()->json($x);
    }

    public function indexxx()
    {
        //https://www.fundaofwebit.com/laravel-8/how-to-insert-data-in-laravel-8
        //useing model
        // $client = new User();
        // $client->name = 'hello';
        // $client->teslephone = 'hello';
        // $client->email = 'hello@gmailx.com';
        // $client->password = 'hello';
        // $client->save();

        //direct query
        // DB::insert('insert into users (name,teslephone,email,password) values (?,?,?,?)', [ 'Marc','14444','demo@mail.com','1478899']);

        $users = DB::select('select * from users ');
        echo "<Pre/>";
        print_r($users);
        die('xx');
        $x = ['name'=>'shubhrajyoti'];
        return response()->json($x);
    }

    public function doTest()
    {
        die('this is do test');
    }
}
