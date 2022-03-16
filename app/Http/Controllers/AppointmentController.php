<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if(auth()->user()->role == 0){
            return Appointment::all()->with('patient','doctor')->get();
        }
        else if(auth()->user()->role == 2){
            return Appointment::where('doctors_id', $user->doctor->id)->with('patient')->get();
        }
        else if(auth()->user()->role == 1){
           return  Appointment::where('patients_id', $user->patient->id)->with('doctor')->get();
        }
    }



    public  function checkDateAvailability($date){
        
        $appointment = Appointment::where('date', $date )->get();
        if(count($appointment) < 20){
            return true;
        }
        else{
            return false;
        }
    
    }
    /**}
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'doctors_id' => 'required|exists:doctors,id',
            'details' => 'required|string|max:255|',
            'date' => 'required|date',
            'time' => 'date_format:H:i',

        ]);
        
        if($this->checkDateAvailability($request->date)){

            $app = Appointment::where('doctors_id',$request->doctors_id)->where('patients_id',$user->patient->id)->first();

            if($app && ($app->status == 0 || $app->status == 1)){
                return response([
                    'message'=>'you have already an appointment',
                    'appiontment' => $app,
                ]);
            }
            else{
                Appointment::create([
                    'doctors_id' => $request->doctors_id,
                    'patients_id' => $user->patient->id,
                    'details' => $request->details,
                    'date' => $request->date,
                    'time' => $request->time,
                ]);
                return response(['message'=>'appiontment created successfully ']);
            }
        }
        else {
            return response(['message' => 'you should choose an other day']);
        }
        
          
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        $user = auth()->user();
        if($user->role == 1){
            
            if($user->patient->id  == $appointment->patients_id ||  $user->role ==  0 ){
                return $appointment;
            }
            else {
                return response(['message' => 'you are not authorized to do this operation '], 405);
            }
        }
        else if($user->role == 2){

            if($user->doctor->id == $appointment->doctors_id || $user->role ==  0 ){ 
                return $appointment;
            }
            else {
                return response(['message' => 'you are not authorized to do this operation '], 405);
            }
        }
        else 
            return $appointment;
            
    }



    public function updateStatusToAccepted(Appointment $appointment){
        $user = auth()->user();

        if($user->doctor->id == $appointment->doctors_id ){
            $appointment->status = 1;
            return response(['message' => 'status updated',
                             'appointment' => $appointment
        ]); 
        }
    }

    public function updateStatusToCompleted(Appointment $appointment){
        $user = auth()->user();
        if($user->doctor->id == $appointment->doctors_id ){
            $appointment->status = 2;
            return response(['message' => 'status updated',
                            'appointment' => $appointment
        ]); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {   
        $request->validate([
            'doctors_id' => 'required|exists:doctors,id',
            'details' => 'required|string|max:255|',
            'date' => 'required|date',
            'time' => 'date_format:H:i',
            
        ]);
        if($appointment->status == 0){
            $user = auth()->user();

            if($user->patient->id == $appointment->patients_id || auth()->user()->role ==  0 ){
                $appointment->update($request->all());
                return response(['message' => 'the appiontment updated successfully']);
            }
            else return response(['message' => 'you are not allowed to update this appiontment'] );

        }
        else if($appointment->status == 1){
            if(auth()->user()->role ==  0 ){
                $appointment->update($request->all());
                return response(['message' => 'the appiontment updated successfully']);
            }
            else  return response(['message' => 'you are not allowed to update this appiontment'] );

        }
        else return response(['message' => 'you cannot update this appointment'] );
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $user = auth()->user();

        if($user->patient->id == $appointment->patients_id){
            Appointment::destroy($appointment->id);
            return response(['message' => 'appointment deleted ']);
        }
        else
        return response(['message' => 'you are not allowed to delete appointment ']);

    }
}
