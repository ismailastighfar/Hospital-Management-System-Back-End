<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = Answer::all()->load('auther');
        $response = [];
        foreach($answers as $answer){
            array_push($response, [
                'id' => $answer->id,
                'question_id' =>  $answer->question_id,
                'content' => $answer->content,
                'auther' => $answer->auther->fname.' '.$answer->auther->lname,
                
            ]);
        }
        return response(['date' => $response ]);
    }

    
    /*
        Get All Answers given by a single doctor
    */
    public function doctorAnswers($id){
        return Answer::where('doctors_id', $id)->with('auther')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'content' => 'required|string'
        ]);
        Answer::create([
            'doctor_id' => $user->doctor->id,
            'question_id' => $request->question_id,
            'content'=> $request->content,
        ]);
        return response('answer creater successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {

        return $answer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {

        $user = auth()->user();
        if( $user->doctor->id == $answer->doctor_id ){
            $request->validate([         
                'content' => 'required|string'
            ]);

            $answer->update([
                'content' => $request->content,
            ]);

            return response('an swer updated successfully');
        }else return response('you cannot do this operation', 405);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {   
        $user = auth()->user();
        
        if( $user->doctor->id == $answer->doctor_id ){
            $answer->destroy($answer->id);
            return response('deleted');

        }
        else
            return response('you cannot do this operation', 405);
    }
}
