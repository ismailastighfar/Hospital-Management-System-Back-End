<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $user = auth()->user();
       $app =  Appointment::where('patients_id' , $user->patient->id )->first();
       $pres = Prescription::where('appointments_id' , $app->id )->get();

       return $pres;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'appointments_id' => 'required|exists:appointments,id',
          'name_of_disease' => 'required',
          'medicines' => 'required',
          'usage_instruction' => 'required',
          'note' => 'required'
        ]);

        Prescription::create($request->all());

        return response(['message'=>'prescription created successfully ']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function show(Prescription $prescription)
    {
      //  return  Prescription::where('patients_id', $prescription->patients_id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prescription $prescription)
    {
        $request->validate([
            'name_of_disease' => 'required',
            'medicines' => 'required',
            'usage_instruction' => 'required',
            'note' => 'required'
          ]);

          $pres = Prescription::find($prescription->id);

          $pres->update($request->all());
          
          return response(['message' => 'prescription updated']);
          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prescription $prescription)
    {
       return Prescription::destroy($prescription->id);
   
    }
}
