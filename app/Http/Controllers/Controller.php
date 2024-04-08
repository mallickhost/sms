<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function __construct()
    {
        //phpinfo();die;

        // todo retrive the currently active accademic year
        // store into the session if session not found then only fetch from DB

        session(['currentActiveAcademic' => ['id'=>'3',
        'academic_session_name'=>'2023-2024',
        'year'=>'2024']]);
    }


    //todo delete after development done

    public function p($val){
        echo "<pre>";print_r($val);
        echo "</pre>";
        die('xxxbasectrlxxx');
    }
}
