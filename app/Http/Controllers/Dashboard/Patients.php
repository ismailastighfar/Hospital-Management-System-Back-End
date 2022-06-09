<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
class Patients extends Controller
{
    
    public function index(){
        $patients = Patient::with('user')->get();
        return view('patient', ['patients' => $patients ]);
    }
    public function profile(Patient $patient){
        return view('patient.profile', ['patient' => $patient]);
    }
}
