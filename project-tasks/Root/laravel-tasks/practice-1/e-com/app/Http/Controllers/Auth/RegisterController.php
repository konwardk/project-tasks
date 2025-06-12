<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\RegistrationSuccessful;
use Illuminate\Http\Request;

use App\Models\User;

class RegisterController extends Controller
{
    // Register users function
    public function register(Request $request)
    {
        // dd($request->all());

        // Validate request data
        $validator = Validator::make($request->all(),[
             'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],

        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        //Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
    Mail::to($user->email)->send(new RegistrationSuccessful());
        // Return a response
        return response()->json([
            'message' => 'User registered successfully.',
            'user' => $user,
        ], 201); // HTTP status 201: Created
    }

    
}
