<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Patient::all();
    }

    public function search()
    {

    
        return User::where('role','=','1')
                                ->where('fullname','like', '%'.request('name').'%')
                                ->where('email','like', '%'.request('email').'%')
                                ->get();
        
    }

    // search the patient by name


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'allergies' => 'string',
            'sickness' => 'string'
        ]);
        
        Patient::create($request->all());

        return response('Patient Created successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Patient::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'allergies' => 'string',
            'sickness' => 'string'
        ]);

        $patient = Patient::find($id);

        if($patient){
            $patient->update($request->all());
            return response('the Patient information updated successfully');
        }
        return response("this Patient does't exist", 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Patient::destroy($id);
        return response('user deleted successfully');
    }
}
