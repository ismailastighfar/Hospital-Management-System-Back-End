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
                <h4 class="card-title mg-b-0">Doctor information</h4>
            </div>
        </div>
        @if (\Session::has('message'))
            <div class="alert alert-success m-3 ">
                    {!! \Session::get('message') !!}
            </div>
        @endif
        <form class="card-body row" id="form" action="{{ url('/doctors/'. $doctor->id) }}" method="post"> 
            @csrf
            @method('PUT')
            <div class="form-group col-6">
                <label class="main-content-label tx-11 tx-medium tx-gray-600">First name</label> <input class="form-control" required="" id="fname" name="fname" type="text" value="{{ $doctor->fname }}">
            </div>
            <div class="form-group col-6">
                <label class="main-content-label tx-11 tx-medium tx-gray-600">Last name</label> <input class="form-control" required="" id="lname" name="lname" type="text" value="{{ $doctor->lname }}">
            </div>
            <div class="form-group col-6">
                <label class="main-content-label tx-11 tx-medium tx-gray-600">Age</label> <input class="form-control" required="" name="age" id="age" type="text" value="{{ $doctor->age }}">
            </div>
            <div class="form-group col-6">
                <label class="main-content-label tx-11 tx-medium tx-gray-600">phone</label> <input class="form-control" required="" name="phone" id="phone" type="text" value="{{ $doctor->phone }}">
            </div>
            <div class="form-group col-12">
                <label class="main-content-label tx-11 tx-medium tx-gray-600">Email</label> <input class="form-control" required="" name="proEmail" id="proEmail" type="email" value="{{ $doctor->proEmail }}">
            </div>
            <div class="form-group col-6">
                <label class="main-content-label tx-11 tx-medium tx-gray-600">Specialty</label> 
                <select class="form-control" required="" name="specialty_id" id="specialty_id" type="text"> 
                    @foreach ($specialties as $specialty)
                        <option value="{{ $specialty->id }}" @if ($specialty->id == $doctor->specialty_id)
                            {{ 'selected' }}
                        @endif> {{ $specialty->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6">
                <label class="main-content-label tx-11 tx-medium tx-gray-600">Departemnt</label> 
                <select class="form-control" required="" name="department_id" id="department_id" type="text"> 
                    @foreach ($departments as $department)
                    <option value="{{ $department->id }}" @if ( $department->id == $doctor->department_id )
                        {{ 'selected' }}
                    @endif> {{ $department->dept_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-12">
                <label class="main-content-label tx-11 tx-medium tx-gray-600">Description</label> <textarea class="form-control" rows="6" required="" id="description" name="description" >{{ $doctor->description }}</textarea>
            </div>
            <div class="alert alert-danger col-12 d-none" id="doctorError">
            </div>
            <div class="form-group col-12 my-2">
                <button onclick="UpdateDoctor()" class="btn btn-primary ">save</button>
                <button type="reset" class="btn ">cancel</button>
            </div>
        </form>
    </div>
</div>


@endsection
@section('js')
    
@endsection