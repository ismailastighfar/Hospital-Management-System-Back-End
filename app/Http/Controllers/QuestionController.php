<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $questions = Question::latest()->with('auther','answers')->get();
        $response = [];
         foreach( $questions as $question ){
             array_push( $response, [
                'id' => $question->id,
                'auther_id' => $question->patient_id,
                'content' => $question->content,
                'auther_avatar' => $question->auther->avatar,
                'auther_username' => $question->auther->user->username,
                'answers' =>  $question->answers,
                'created_at' => $question->created_at->diffForHumans()
            ]);
        }
        return response(['data' => $response ]);
    }

    /* 
        Get All Patient stored Question 
    */

    public function patientQuestions($id){

        $questions = Question::where('patient_id',$id)->get();
        $response = [];
        foreach( $questions as $question ){
            array_push($response, [
               'id' => $question->id,
               'auther_id' => $question->patient_id,
               'content' => $question->content,
               'auther_username' => $question->auther->user->username,
               'answers' =>  $question->answers,
               'created_at' => $question->created_at->diffForHumans()
           ]);
        }
       return response(['data' => $response ]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient = auth()->user()->patient->id;
        $request->validate([
            'content' => 'required|string'
        ]);
        Question::create([
            'patient_id' => $patient,
            'content' => $request->content,
        ]);
        return response('Question created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return response( [ 'question' => $question, 'answers' => Answer::where('question_id' , $question->id )->with('auther')->get() ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {

        $user = auth()->user();
        if($user->patient->id == $question->patient_id ){
            $request->validate([
                'content' => 'required|string',
            ]);
            $question->update($request->all());
            return response(['success'=>'Question updated successfully'],200);
        }else{
            return response(['error' => 'you cannot do this operation'], 405);
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $user = auth()->user();
        if($user->patient->id == $question->patient_id || auth()->user()->role == 0 ){
            $question->destroy($question->id);
            return response('the question deleted successfully');
        }else{
            return response('you cannot do this operation', 405);
        }  
    }
}
