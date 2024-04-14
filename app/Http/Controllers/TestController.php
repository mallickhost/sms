<?php

namespace App\Http\Controllers;


use Session;
use App\Http\Controllers;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    
    public function index(Request $request)
    {

    
    // $request->validate([
    //     'email' => 'required',
    //     'password' => 'required',
    //   ]);


      $data = $request->all();
// print_r($data);die('xxx');
//teacher email :ttt@mail.com	
//password: 123
$id = $data['id'];
$fields = ['password'=>Hash::make($data['password'])];
$obj_student =  Student::where('id', $id)->update($fields);;

return "xxxx";

      $user = new admin();
      $user->name = $data['name'];
      // $user->mobile_no = $data['mobile_no'];
      // $user->student_number = 'S'.time();
      // $user->father_name = 'demo';
      // $user->alt_mobile_no = $data['alt_mobile_no'];
      // $user->address = $data['address'];
      $user->email = $data['email'];
      $user->password = Hash::make($data['password']);
      $user->save();
       return "xxxx";
    }


    public function xxxxx(){
      //INSERT INTO `fees_types` (`id`, `type_name`, `no_of_payments_in_a_year`, `is_deleted`, `created_at`, `updated_at`) VALUES (NULL, 'Monthly', '12', '0', NULL, NULL);
//VALUES (NULL, 'Half-Yearly', '2', '0', NULL, NULL);
//VALUES (NULL, 'Quaterly', '3', '0', NULL, NULL);


//--------------- class------------
//INSERT INTO `academic_classes` (`id`, `class_name`, `class_roman_name`, `is_deleted`, `created_at`, `updated_at`) VALUES (NULL, 'Lower KG', 'LKG', '0', NULL, NULL), (NULL, 'Upper KG', 'UKG', '0', NULL, NULL), (NULL, 'Standard  one', 'I', '0', NULL, NULL), (NULL, 'Standard  Two', 'II', '0', NULL, NULL), (NULL, 'Standard  Three', 'III', '0', NULL, NULL), (NULL, 'Standard  four', 'IV', '0', NULL, NULL);

    }
}
