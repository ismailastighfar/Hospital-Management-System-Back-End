@extends('layouts.master')
@section('css')
@endsection

@section('content')
<div class="card my-5  " id="schedule">
    <div class="card-body h-100 ">
        <div class="breadcrumb-header d-flex justify-content-between align-items-end ">
            <div >
                <h4 class="tx-15 text-uppercase mr-4 text-info">Answers on<b class="text-primary"> {{ $question->auther->user->username }}</b> question</h4>
            </div>
        </div>
        
        <div class="col-12 border-left my-2 mb-5">
                <h4 class=" d-inline"> 
                    {{ $question->auther->user->username }} 
                </h4>
                <p class="text-secondary fs-6 text ">{{ $question->created_at->diffForHumans()  }}</p>
                <h5 class="p-3 bg-info-transparent">
                    {{ $question->content }} ?
                </h5>
                <div class="btn-groupe d-flex">
                    <a href="{{ url('/doctor/answer/'. $question->id ) }} " class="text-primary">reply</a>
                </div>
            
        </div>
        <div class="row d-flex justify-content-center flex-colmun">
        @foreach ($answers as $ques)
            <div class="col-10 border-left my-2">
                <h6 class=" d-inline"> 
                    {{ $ques->auther->fname }} {{ $ques->auther->lname }}  
                </h6>
                <p class="text-secondary fs-6 text">{{ $ques->created_at->diffForHumans()  }}</p>
                <h4>
                    {{ $ques->content }} ?
                </h4>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection