<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Appointment;
use App\models\Doctor;
use App\models\Department;
use App\models\Specialty;
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
    public function edit($id){
        return view('doctor.edit', ['doctor' => Doctor::find($id),  'specialties' => Specialty::all() , 'departments' => Department::all() ]);
    }
    public function ChangeAvai($id){
        $doctor = Doctor::find($id);
        if( $doctor->availability == 'Available' ) {
            $doctor->availability = 'Unavailable';
            $doctor->save();
            return view('doctor.doctors' ,[ 'doctors' => Doctor::all()]);

        }
        $doctor->availability = 'Available';
        $doctor->save();
        return view('doctor.doctors', [ 'doctors' => Doctor::all()]);
    }
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'age' => 'required|integer',
            'phone' => 'required',
            'proEmail' => 'required|email',
            'description' => 'required|min:10|max:255',
            'department_id' => 'required',
            'specialty_id' => 'required',
        ]);

        $doctor = Doctor::find($id);

        if($doctor) {
            $doctor->update([
                'proEmail' => $request->proEmail,
                'phone' => $request->phone,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'age' => $request->age,
                'phone' => $request->phone,
                'proEmail' => $request->proEmail,
                'description' => $request->description,
                'department_id' => $request->department_id,
                'specialty_id' => $request->specialty_id,
        
        ]);
            return redirect()->back()->with( ['message' => 'saved !']);
        }
        return response(['error' => 'non doctor founded'] , 404);
    }
}
