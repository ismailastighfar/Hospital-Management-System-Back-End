<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class Questions extends Controller
{
    public function index(){
        return view('question.question', [ 'questions' => Question::all()]);
    }
   
}
