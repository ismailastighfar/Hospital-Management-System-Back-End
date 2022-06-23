@extends('layouts.master')
@section('css')
@endsection

@section('content')
<div class="card my-5  " id="schedule">
    <div class="card-body h-100">
        <div class="breadcrumb-header d-flex justify-content-between align-items-end ">
            <div >
                <h4 class="tx-15 text-uppercase mr-4 text-info">All questions</h4>
            </div>
        </div>
        <div class="row w-100 d-flex justify-content-center flex-colmun">
        @foreach ($questions as $ques)
            <div class="col-10 border-left my-2">
                <h4 class=" d-inline"> 
                    {{ $ques->auther->user->username }} 
                </h4>
                <p class="text-secondary fs-6 text ">{{ $ques->created_at->diffForHumans()  }}</p>
                <h5 class="p-3 bg-info-transparent">
                    {{ $ques->content }} ?
                </h5>
                <div class="btn-groupe d-flex">
                    <a href="{{ url('/doctor/answers/'. $ques->id ) }} " class="text-primary">see all replies ( )</a>
                    <a href="{{ url('/doctor/answer/'. $ques->id ) }} " class="ml-4 text-primary">reply</a>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection