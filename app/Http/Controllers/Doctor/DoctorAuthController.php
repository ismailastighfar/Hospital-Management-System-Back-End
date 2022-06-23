<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DoctorAuthController extends Controller
{
    public function index(){
        return view('DoctorView.signin');
    }
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
                return redirect()->back()->with([
                    'message' => 'you must entered wrong creds'
                ]);
            }
            if( $user->role == 2 ){
                $doctor = [
                    'id' => $user->id,
                    'doctor_id' => $user->doctor->id,
                    'username' => $user->username,
                ];
                Auth::login($user);
                return redirect('doctor/index');
            }
            else 
                return redirect()->back()->with([
                    'message' => 'you must be a doctor'
                ]);





    }

    // logout method
    public function logout(Request $request){
        
        $request->user()->tokens()->delete();

        return ['message' => 'logout'];


    }
}
