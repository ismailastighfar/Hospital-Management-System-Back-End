<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\User;

class DoctorController extends Controller
{
    public function index(){
       
        return Doctor::all()->load('user');
    }

    public function show(Doctor $doctor){
        
        return $doctor->load('user');

    }

    public function search(){

        return User::where('fullname','like', '%'.request('name').'%')
                    ->where('email','like', '%'.request('email').'%')
                    ->where('phoneNumber','like', '%'.request('phone').'%')
                    ->where('role','=','2')
                    ->with('doctor')->get();
    }

     public function store(Request $request)
    {
        $request->validate([
            'users_id' => 'required',
            'departments_id' => 'required',
            'speciality' => 'required|string' 
        ]);

        Doctor::create($request->all());

        return response([ 'message' => 'doctor created succefully']);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'speciality' => 'required|string' 
        ]);

        $doctor = Doctor::find($id);

        if($doctor) {
            $doctor->update($request->all());
            return response(['message' => 'the doctor updated successfully']);
        }
        return response(['error' => 'non doctor founded'] , 404);
    }
}
