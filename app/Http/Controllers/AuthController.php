<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    // login method 

    public function login(Request $request){
        // validate Request
        $fields = $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string'
        ]);
        // select the user
        $user = User::where('email', $fields['email'])->first();
        // check the creds
        if( !$user || !hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'you must entered wrong creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    // logout method
    public function logout(Request $request){

        $request->user()->tokens()->delete();
        return ['message' => 'logout'];

    }

}
