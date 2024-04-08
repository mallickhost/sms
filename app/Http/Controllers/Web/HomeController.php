<?php

namespace App\Http\Controllers\Web;

use Session;
use App\Http\Controllers\Web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class HomeController extends WebController
{
    public function aboutUs()
    {
   
        return view('pages/web/about_us');
    }
    public function contactUs()
    {
   
        return view('pages/web/contact_us');
    }
    public function index()
    {

    
        // $users = DB::table('users')->get();
        // echo "<Pre/>";
        // print_r($users);
        // die('xx');
        // $data = Http::get('https://jsonplaceholder.typicode.com/posts');
        // $posts = json_decode($data->getBody()->getContents());
        // echo "<Pre/>";
        // print_r($posts);
        // die('xx');
        // Session::flash('danger', 'danger');
        // Session::flash('warning', 'warning');
        // Session::flash('success', 'success');
        // Session::flash('info', 'info');
        return view('pages/web/home');
    }
}
