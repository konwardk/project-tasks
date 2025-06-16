<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // user login function
    public function login(Request $request){
    
        // validation for user input
        $validator = Validator::make($request->all(),[
            'email' => ['required', 'string','email'],
            'password' => ['required','string', 'min:8'],

        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ],422);
        }

        $user = User::where('email', $request->email)->first();

        // check user existance
         if(!$user){
            return response()->json([
                'success' => false,
                'message' => "user not found",

            ],404);

        }
        // dd($user);

        // Password verification
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Invalid Credentials'
                ], 401);
            }

            //create a token
        $token = $user->createToken('api-token')->plainTextToken;

        // Decide redirect URL based on role
            if($user->role_id === 1){
                $dashboardUrl = url('/admin-dashboard');
                $message = " Welcome admin  ".$user->name;
            }
            elseif($user->role_id === 2) {
                $dashboardUrl = url('/manager-dashboard');
                $message = " Welcome ".$user->name;

            } elseif ($user->role_id === 3) {
                $dashboardUrl = url('/developer-dashboard');
                $message = " Welcome ".$user->name;

            }
             else {
                $dashboardUrl = url('/');
                $message = " Not authorized  ";
            }

         return response()->json([
                'token' => $token,
                'token_type' => 'Bearer',
                'message' => $message,
                'user' => $user,
                'redirect_url' => $dashboardUrl
        ],201);
        

    }
}
