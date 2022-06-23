<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class Questions extends Controller
{
    public function index(){
        return view('question.question', [ 'questions' => Question::all()]);
    }
    public function index2(){
        return view('answers.index', [ 'answers' => Answer::all()]);
    }
}
