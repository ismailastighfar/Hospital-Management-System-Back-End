@extends('layouts.master')
@section('css')
@endsection

@section('content')
<div class="row  d-flex justify-content-center  ">
    <div class="card my-5 col-6">
    <div class="card-body h-100">
        <div class="breadcrumb-header">
            <div>
                <h4 class="tx-15 text-uppercase mr-4 text-info">Add an answer on <b class="text-primary">{{ $question->auther->user->username }}</b>  question</h4>
            </div>
        </div>
        <div class="row">
            <p class="ml-3 text-secondary">
                {{ $question->content }} ? 
            </p>
        </div>
        
        <form class="row" id="answer">
            @csrf
            <div class="form-group col-12">
                <label class="main-content-label tx-11 tx-medium tx-gray-600">Response : </label>
                <textarea class="form-control" required="" name="content" rows="10" type="text" id="username"></textarea>
            </div>
            <input type="hidden" value="{{ auth()->user()->doctor->id }}" name="question_id">
            <input type="hidden" value="{{$question->id}}" name="question_id">
            <div class="form-group col-12 mt-3">
                <button  class="btn btn-primary px-4" onclick="AddAnswer()">save</button>
                <button type="reset" class="btn px-2">clear</button>
            </div>
        </form>
        <div class="alert alert-danger m-3 d-none" id="Error">
        </div>
        <div class="alert alert-success m-3 d-none" id="success">
        </div>
    </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        function AddAnswer(){
            answer.onsubmit = async (e) => {
                   e.preventDefault();
                   let datas = new FormData(answer);
				axios({
                        method: "post",
                        url: window.location.origin + '/api/answers',
                        data: datas,
                        headers: { "Content-Type": "multipart/form-data" },
                        })
                        .then(function (res) {
                            success.innerText = 'your answer saved'
                            window.location.href = '/doctor/answers/ ' + {{ $question->id }}
                        })
                        .catch(function (error) {
                            //handle error
                            console.log(error.response.data.message)
                            Error.innerText = 'error: ' + error.response.data.message
                            Error.classList.remove('d-none')
                        });
			}
        }
    </script>
@endsection