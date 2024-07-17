<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{

// Register API (POST, formdata)
public function register(Request $request){

    // Data validation
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed'
    ]);

    // Registrar Usuário - Data Save

    User::create([
       'name' => $request->name,
       'email' => $request->email,
       'password' => bcrypt($request->password)
    ]);

    // Response
    return response()->json([
        'status' => true,
        'message' => 'User created successfully'
    ]);
}

public function login(Request $request){

    // Data validation

    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // JWTAuth and attempt

    $token = JWTAuth::attempt([
       'email' => $request->email,
       'password' => $request->password,
    ]);

    if(!empty($token)){

        // Response

        return response()->json([
            'status' => true,
            'message' => 'User logged in successfully',
            'token' => $token,
        ]);

    }

    return response()->json([
        'status' => false,
        'message' => 'Invalid Login details'
    ]);
}

public function profile(){
    $userData = auth()->user();

    return response()->json([
        'status' => true,
        'message' => 'Profile data',
        'user' => $userData
    ]);
}

public function refresh(){
    $newToken = auth()->refresh();
    return response()->json([
        'status' => true,
        'message' => 'New acess Token generated',
        'token' => $newToken
    ]);
}
public function logout(){
    auth()->logout();

    return response()->json([
        'status' => true,
        'message' => 'User logged out successfully'
    ]);
}





}
