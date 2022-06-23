@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Doctors / edit</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

<div class="row row-sm d-flex justify-content-center" >
    <div class="col-12 col-md-8  " id="doctorInfo">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mg-b-0">enter the new date and time</h4>
            </div>
        </div>
        @if (\Session::has('message'))
            <div class="alert alert-success m-3 ">
                    {!! \Session::get('message') !!}
            </div>
        @endif
        <form class="card-body row" id="form" action="{{ url('/Appointments/edit/'.$appointment->id ) }}" method="POST"> 
            @csrf
            @method('PUT')
            <div class="form-group col-6">
                <label class="main-content-label tx-11 tx-medium tx-gray-600">date</label> <input class="form-control" required="" id="date" name="date" type="date" value="{{ $appointment->date }}">
            </div>
            <div class="form-group col-6">
                <label class="main-content-label tx-11 tx-medium tx-gray-600">Time</label> <input class="form-control" required="" id="time" name="time" type="time" value="{{ $appointment->time }}">
            </div>
            <div class="form-group col-12 my-2">
                <button onclick="" class="btn btn-primary ">save</button>
                <button type="reset" class="btn ">cancel</button>
            </div>
        </form>
    </div>
</div>


@endsection
@section('js')
    
@endsection