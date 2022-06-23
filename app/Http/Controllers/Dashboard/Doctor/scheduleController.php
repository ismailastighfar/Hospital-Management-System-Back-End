<?php

namespace App\Http\Controllers\Dashboard\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Question;
use App\Models\Answer;
use Carbon\Carbon;

class scheduleController extends Controller
{
    public function index($nbweek = 0){
        $doctor = auth()->user()->doctor;
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
            'Mon' => Appointment::where('doctor_id', $doctor->id)->where('status' , '1')->where('date', $Mon )->get(),
            'Tue' => Appointment::where('doctor_id', $doctor->id)->where('status' , '1')->where('date', $Tue )->get(),
            'Wed' => Appointment::where('doctor_id', $doctor->id)->where('status' , '1')->where('date', $Wed )->get(),
            'Thu' => Appointment::where('doctor_id', $doctor->id)->where('status' , '1')->where('date', $Thu )->get(),
            'Fri' => Appointment::where('doctor_id', $doctor->id)->where('status' , '1')->where('date', $Fri )->get()
        ]; 
        return view('DoctorView.schedule', ['appointment' => $apps ]);
    }
    public function questions($opt = 0){
        $questions = Question::latest()->get();
        return view('DoctorView.questions', ['questions' => $questions ] );
    }
    public function answers($id){
        $question = Question::find($id);
        $answers = Answer::latest()->where('question_id' , $id )->get();
        return view('DoctorView.answers', ['question' => $question, 'answers' => $answers ] );
    }
    public function answer($id){
        return view('DoctorView.answer', ['question' => Question::find($id) ]);
    }
    public function prescreption($id){
        return view('DoctorView.prescreption', [ 'id' => $id ]);
    }
}
