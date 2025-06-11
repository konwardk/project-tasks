<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // login function for all users
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

            $token = $user->createToken('api-token')->plainTextToken;

            // Decide redirect URL based on role
            if($user->role === 'superadmin'){
                $dashboardUrl = url('/superadmin-dashboard');
                $message = " Welcome super admin  ".$user->name;
            }
            elseif($user->role === 'admin') {
                $dashboardUrl = url('/admin-dashboard');
                $message = " Welcome ".$user->name;

            } elseif ($user->role === 'user') {
                $dashboardUrl = url('/user-dashboard');
                $message = " Welcome ".$user->name;

            }
            elseif($user->role === "vendor"){
                $dashboardUrl = url('/vendor-dashboard');
                $message = " Welcome ". $user->name;

            } else {
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

    //logout function for all users
    public function logout(Request $request)
    {
        $user = $request->user(); // or Auth::user()

        $user->currentAccessToken()->delete(); // Revoke the token

        return response()->json([
            'success' => true,
            'message' => "User {$user->name} logged out successfully"
        ]);
    }

    
    public function getUser(Request $request){
        if (Auth::check()) {
            $user = Auth::user()->name;
            dd($user);
        } else {
            return response()->json(['message' => 'User not authenticated'], 401);
        }
    }
    
}
