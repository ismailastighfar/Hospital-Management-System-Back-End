@extends('layouts.master')
@section('css')
@endsection

@section('content')

<div class="row  d-flex justify-content-center  ">
    <div class="card my-5 col-6">
    <div class="card-body h-100">
        <div class="breadcrumb-header">
            <div>
                <h4 class="tx-15 text-uppercase mr-4 text-info">Write prescreption </h4>
            </div>
        </div>
        <form class="row" id="presc">
            @csrf
            <div class="form-group col-12">
                <label class="main-content-label tx-11 tx-medium tx-gray-600">Disease: </label>
                <textarea class="form-control" required="" name="name_of_disease" rows="5" type="text" id="username"></textarea>
            </div>
            <div class="form-group col-12">
                <label class="main-content-label tx-11 tx-medium tx-gray-600">medicines: </label>
                <input class="form-control" required="" name="medicines"  type="text" id="medicines" />
            </div>
            <div class="form-group col-12">
                <label class="main-content-label tx-11 tx-medium tx-gray-600">Usage: </label>
                <textarea class="form-control" required="" name="usage_instruction" rows="5" type="text" id="usage_instruction"></textarea>
            </div>
            <div class="form-group col-12">
                <label class="main-content-label tx-11 tx-medium tx-gray-600">Note: </label>
                <textarea class="form-control" required="" name="note" rows="5" type="text" id="note"></textarea>
            </div>
            <input type="hidden" value="{{ $id }}" name="appointment_id">
            
            <div class="form-group col-12 mt-3">
                <button  class="btn btn-primary px-4" onclick="AddPre()">save</button>
                <button type="reset" class="btn px-2">clear</button>
            </div>
        </form>
        <div class="alert alert-danger m-3 d-none" id="Error">
        </div>
        <div class="alert alert-success m-3 d-none" id="success">
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script>
        function AddPre(){
            presc.onsubmit = async (e) => {
                   e.preventDefault();
                   let datas = new FormData(presc);
				axios({
                        method: "post",
                        url: window.location.origin + '/api/prescriptions',
                        data: datas,
                        headers: { "Content-Type": "multipart/form-data" },
                        })
                        .then(function (res) {
                            success.innerText = 'prescreption saved'
                            success.classList.remove('d-none')
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