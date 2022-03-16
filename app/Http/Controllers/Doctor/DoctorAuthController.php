<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DoctorAuthController extends Controller
{
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
        if( $user->role == 2 || $user->role == 0){
            $doctor = [
                'id' => $user->id,
                'doctor_id' => $user->doctor->id,
                'username' => $user->username,
            ];
            $token = $user->createToken('myapptoken')->plainTextToken;
            $response = [
                'doctor' => $doctor,
                'token' => $token
            ];
            return response($response, 201);
        }
        else 
            return response(['error'=>'this url is only for patients'], 403);
    }

    // logout method
    public function logout(Request $request){

        $request->user()->tokens()->delete();
        return ['message' => 'logout'];

    }
}
