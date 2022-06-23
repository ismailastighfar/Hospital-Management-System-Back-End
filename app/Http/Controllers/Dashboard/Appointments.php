<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;


class Appointments extends Controller
{
    public function index(){
        return view('appointment.appointments', ['appointments' => Appointment::all() ]);
    }
    public function edit($id){
        $appointment = Appointment::find($id);
        return view('appointment.edit' , ['appointment' => $appointment]);
    }
    public function update(Request $request, $id){
        $appointment = Appointment::find($id);
        if(auth()->user()->role ==  0 ){
            $appointment->date = $request->date;
            $appointment->time =  $request->time;
            $appointment->save();
            return redirect()->back()->with(['message' => 'the date updated successfully and an email send to the patient']);
        } 
    }
}
