<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Appointment;
use App\models\Doctor;
use App\models\Specialty;
use App\models\Department;
use Carbon\Carbon;
class Doctors extends Controller
{
    public function profile(Doctor $doctor, $nbweek = 0){
        $firstDay = Carbon::now();
        if($nbweek == 0) {
            $FDOWeek = $firstDay->startOfWeek();
            $Mon = $FDOWeek->format('Y-m-d');
            $Tue =  Carbon::createFromDate($FDOWeek->year.'-'.$FDOWeek->month.'-'.$FDOWeek->day + 1)->format('Y-m-d');
            $Wed =  Carbon::createFromDate($FDOWeek->year.'-'.$FDOWeek->month.'-'.$FDOWeek->day + 2)->format('Y-m-d');
            $Thu =  Carbon::createFromDate($FDOWeek->year.'-'.$FDOWeek->month.'-'.$FDOWeek->day + 3)->format('Y-m-d');
            $Fri =  Carbon::createFromDate($FDOWeek->year.'-'.$FDOWeek->month.'-'.$FDOWeek->day + 4)->format('Y-m-d');
        }
        else{
            // first day of the week
            $FDOWeek = $firstDay->addWeek($nbweek)->startOfWeek();
            $Mon =  $FDOWeek->format('Y-m-d');
            $Tue =  Carbon::createFromDate($FDOWeek->year.'-'.$FDOWeek->month.'-'.$FDOWeek->day + 1)->format('Y-m-d');
            $Wed =  Carbon::createFromDate($FDOWeek->year.'-'.$FDOWeek->month.'-'.$FDOWeek->day + 2)->format('Y-m-d');
            $Thu =  Carbon::createFromDate($FDOWeek->year.'-'.$FDOWeek->month.'-'.$FDOWeek->day + 3)->format('Y-m-d');
            $Fri =  Carbon::createFromDate($FDOWeek->year.'-'.$FDOWeek->month.'-'.$FDOWeek->day + 4)->format('Y-m-d');
            
        }
        $apps = [ 
            'Mon' => Appointment::where('doctor_id', $doctor->id)->where('date', $Mon )->get(),
            'Tue' => Appointment::where('doctor_id', $doctor->id)->where('date', $Tue )->get(),
            'Wed' => Appointment::where('doctor_id', $doctor->id)->where('date', $Wed )->get(),
            'Thu' => Appointment::where('doctor_id', $doctor->id)->where('date', $Thu )->get(),
            'Fri' => Appointment::where('doctor_id', $doctor->id)->where('date', $Fri )->get()
        ]; 
        
        return view('doctor.profile', ['doctor' => $doctor, 'appointment' => $apps]);
        
    }
    public function index(){
        return view('doctor.doctors', [ 'doctors' => Doctor::all()]);
    }
    public function create(){
        return view('doctor.create', ['specialties' => Specialty::all() , 'departments' => Department::all() ]);
    }
}
