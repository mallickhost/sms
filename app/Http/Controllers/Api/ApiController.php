<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function noAccess()
    {
        return response()->json('Silence is more peaceful');
    }
}
