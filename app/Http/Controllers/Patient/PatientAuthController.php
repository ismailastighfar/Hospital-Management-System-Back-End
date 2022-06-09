<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PatientAuthController extends Controller
{
    public function login(Request $request){
        // validate Request
        
        if(!auth('sanctum')->check()){
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
            if( $user->role == 1){
            $patient = [
                'patient' => $user->patient,
                'username' => $user->username,
            ];
            
            $token = $user->createToken('logintoken')->plainTextToken;
            $response = [
                'patient' => $patient,
                'token' => $token
            ];
            return response($response, 201);
            }
            else 
                return response(['error'=>'this url is only for patient'], 403);
        }
        else return ('you are already sign up');
    }

    // logout method
    public function logout(Request $request){

        $request->user()->tokens()->delete();
        return ['message' => 'logout'];

    }
        
    }

    

