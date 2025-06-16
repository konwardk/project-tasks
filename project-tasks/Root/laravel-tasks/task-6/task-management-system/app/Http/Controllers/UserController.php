<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function getallUser(){
        $getUser = User::all();
        if($getUser->isEmpty()){
            return response()->json([
                'success' => false,
                'message' => "No User Found",
            ]);
        }else{
            return response()->json([
                'success' => true,
                'data' => $getUser
            ]);
        }
    }

    public function getUser(Request $request){

        $user = $request->user();
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => "Unauthorized access!!"
            ],404);
        }

        if($user->role === 'manager'){
            echo 'manager';
        }

        if($user->role === 'developer'){
            echo 'developer';
        }
    }
}
