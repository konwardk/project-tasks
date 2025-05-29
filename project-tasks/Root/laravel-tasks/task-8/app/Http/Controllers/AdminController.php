<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard(Request $request)
    {
        // Check if the user is authenticated and has admin role
        $user = $request->user();
        if (!$user || $user->role !== 'admin') {
            return redirect('/')->with('error', 'Access denied. Admins only.');
        }

        // Return the admin dashboard view
        return view('admin.dashboard', ['user' => $user]);
    }
}
