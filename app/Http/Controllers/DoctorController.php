<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DoctorController extends Controller
{
    public function index(){
        return User::all()->where('role' , '=' , 2);
    }

    public function show(User $user){
       
        if ($user->role === 2) {
            return $user;
        }
        
        abort(404);
    
    }

     public function store(Request $request)
    {
        $request->validate([

            'fullname' => 'required|max:255|string',
            'username' =>  'required|max:255|string|unique:users,username',
            'email' =>  'required|max:255|email|unique:users,email',
            'password' => 'required|min:8|max:255|confirmed',
            ''
        ]);
    }

    


}
