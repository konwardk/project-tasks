<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //user login function
    public function userLogin(Request $request){

        $user = "dk";
        // dd($request->all());
        return response()->json([
            'message' => 'working',
            'user' => $user
        ],201);
    }
    
}
