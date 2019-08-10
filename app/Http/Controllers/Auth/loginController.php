<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class loginController extends Controller
{

    public function login(Request $request)
    {
        $data = array('name' => 'Hello World!');
        echo json_encode($data);

//        return response('Test API', 200)
//                ->header('Content-Type', 'application/json');
    }
}
