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
        return Answer::all()->load('auther');
    }
    public function questionAnswers($id){
        return Answer::where('question_id', $id)->load('auther');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'question_id' => 'required|exists:questions,id',
            'content' => 'required|string'
        ]);
        Answer::create($request->all());
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
        if( auth()->user()->id == $answer->doctor_id ){
            $request->validate([         
                'content' => 'required|string'
            ]);

            $answer->update([
                'content' => $request->content,
            ]);

            return response('answer updated successfully');
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
        if( auth()->user()->id == $answer->doctor_id ){
        $answer->destroy($answer->id);
        }else return response('you cannot do this operation', 405);
    }
}
