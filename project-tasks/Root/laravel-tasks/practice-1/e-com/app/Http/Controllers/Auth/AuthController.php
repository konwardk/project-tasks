<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //user login function
    public function login(Request $request){

        // $user = "dk";
        // dd($request->all());

        // Validate request data
        $validator = Validator::make($request->all(),[
            'email' => ['required', 'string', 'email'],
            'password' => ['required','string', 'min:8'],

        ]);
        if($validator->fails()){
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        //get user email from users table
        $user = User::where('email',$request->email)->first();

        //check if the user is admin or not
        if($user->role !== 'admin'){
            return response()->json([
                'success' => false,
                'message' => 'you are not admin'
            ], 404);
        }

        // Password verification
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Invalid Credentials'
                ], 401);
            }
        
            return response()->json([
            'message' => 'Login Successful',
            'user' => $user
        ],201);
        

    }
    
}
