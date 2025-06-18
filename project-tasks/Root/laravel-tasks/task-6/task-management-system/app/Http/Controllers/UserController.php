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

    public function getManagers(Request $request){
        $user = $request->user();
        // dd($user);
        $allManagers = User::join('roles','roles.id','=','users.role_id')->
        where('roles.role_name','manager')->get();
        // dd($allManagers);
        return response()->json([
            'success' => true,
            'data' => $allManagers,
        ],200);

    }

    public function getDevelopers(Request $request){
        $user = $request->user();
        // dd($user);
        $allDevs = User::join('roles','roles.id','=','users.role_id')->
        where('roles.role_name','developer')->get();
        // dd($allDevs);

        return response()->json([
            'success' => true,
            'data' => $allDevs,
        ],200);

    }
}
