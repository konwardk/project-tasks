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


        //check user existance
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => "user not found",

            ]);

        }

        // Password verification
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Invalid Credentials'
                ], 401);
            }

            // Decide redirect URL based on role
            if($user->role === 'superadmin'){
                $dashboardUrl = url('/superadmin-dashboard');
                $message = " Welcome super admin  ";
            }
            elseif($user->role === 'admin') {
                $dashboardUrl = url('/admin-dashboard');
                $message = " Welcome admin  ";

            } elseif ($user->role === 'user') {
                $dashboardUrl = url('/user-dashboard');
                $message = " Welcome user ";

            } else {
                $dashboardUrl = url('/');
                $message = " Not authorized  ";
            }

            
            return response()->json([
            'message' => $message,
            'user' => $user,
            'redirect_url' => $dashboardUrl
        ],201);
        

    }
    
}
