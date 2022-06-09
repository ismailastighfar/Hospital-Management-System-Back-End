<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Doctor;
class Doctors extends Controller
{
    public function profile(Doctor $doctor){
        
        return view('doctor.profile', ['doctor' => $doctor]);
    }
}
