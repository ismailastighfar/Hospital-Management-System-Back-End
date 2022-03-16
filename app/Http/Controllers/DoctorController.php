<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\User;

class DoctorController extends Controller
{
    public function index(){
       
        return Doctor::all();
    }

    public function show(Doctor $doctor){
        
        return   $doctor;

    }

    public function search(){

        return Doctor::where('fname','like', '%'.request('name').'%')
                     ->where('lname','like', '%'.request('name').'%')
                    ->where('speciality','like', '%'.request('speciality').'%')
                    ->get();
    }

     public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'age' => 'required|integer',
            'phone' => 'required',
            'proEmail' => 'required|email',
            'description' => 'required|min:10|max:255',
            'picture' => 'required|image|mimes:jpg,png,jpeg',
            'department_id' => 'required',
            'user_id' => 'required',
            'speciality' => 'required|string' 
        ]);

        $imageName = $request->fname . $request->lname . '.' . $request->picture->extension();
        $request->picture->move(public_path('doc_img'), $imageName);

        Doctor::create($request->all());

        return response([ 'message' => 'doctor created succefully']);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'phone' => 'required',
            'proEmail' => 'required|email',
        ]);

        $doctor = Doctor::find($id);

        if($doctor) {
            $doctor->update($request->all());
            return response(['message' => 'the doctor updated successfully']);
        }
        return response(['error' => 'non doctor founded'] , 404);
    }
}
