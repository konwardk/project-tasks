<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function getallUser() {
    $getUser = User::join('roles', 'roles.id', '=', 'users.role_id')
        ->select('users.id', 'users.name', 'users.email', 'roles.role_name')
        ->paginate(8);

    if ($getUser->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => "No User Found",
        ]);
    } else {
        return response()->json([
            'success' => true,
            'data' => $getUser
        ]);
    }
}


    public function getUsersByRole(Request $request)
    {
        $role = $request->query('role');

        $validRoles = ['manager', 'developer'];

        if (!$role || !in_array($role, $validRoles)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or missing role parameter.'
            ], 400);
        }

        $users = User::join('roles', 'roles.id', '=', 'users.role_id')
            ->where('roles.role_name', $role)
            ->select('users.*', 'roles.role_name')
            ->get();

        return response()->json([
            'success' => true,
            'role' => $role,
            'data' => $users
        ], 200);
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
