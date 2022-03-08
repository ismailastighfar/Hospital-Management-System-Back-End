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

    public function show($id){
        
        return Doctor::find($id);
       
    }

     public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
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

    
    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     User::destroy($id);
    //     return response(['message' => 'the doctor deleted successfully'] );
    // }

}
