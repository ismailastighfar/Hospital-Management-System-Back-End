@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Patient</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Profile</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-lg-4">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="pl-0">
									<div class="main-profile-overview">
										<div class="main-img-user profile-user">
											<img alt="" src="{{ asset('avatars/avatar1.png') }}"><a class="fas fa-camera profile-edit" href="JavaScript:void(0);"></a>
										</div>
										<div class="d-flex justify-content-between mg-b-20">
											<div>
												<h5 class="main-profile-name">{{ $patient->fullname }}</h5>
												<p class="main-profile-name-text">{{ $patient->user->username }}</p>
											</div>
										</div>
										<h4>Bio</h4>
										<div class="main-profile-bio">
										<h6>BirthDate</h6>
											<p>
											{{ $patient->dateOfBirth }}
											</p>
											<h6>CNE</h6>
											<p>
											{{ $patient->cne }}
											</p>
											<h6>Allergies</h6>
											<p>
											{{ $patient->allergies }}
											</p>

											<h6>Sickness</h6>
											<p>
											{{ $patient->sickness }}
											</p>
										</div><!-- main-profile-bio -->
                                        
										<h4>Contact</h4>
										<div class="main-profile-bio">
										<h6>Email</h6>
											<p>
											{{ $patient->user->email }}
											</p>
											<h6>Phone Number</h6>
											<p>
											{{ $patient->phone}}
											</p>
											<h6>Address</h6>
											<p>
											{{ $patient->address }}
											</p>
										</div><!-- main-profile-bio -->


									
									</div><!-- main-profile-overview -->
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="row row-sm">
							<div class="col-sm-12 col-xl-6 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											<div class="counter-icon bg-primary-transparent">
												<i class="icon-layers text-primary"></i>
											</div>
											<div class="mr-auto">
												<h5 class="tx-13">appointment</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">{{count($patient->appointments)}}</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-6 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											<div class="counter-icon bg-danger-transparent">
												<i class="icon-paypal text-danger"></i>
											</div>
											<div class="mr-auto">
												<h5 class="tx-13">Questions</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">{{count($patient->questions)}}</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						<div class="card">
							<div class="card-body">
	
								<div class="tab-content border-left border-bottom border-right border-top-0 p-4">
									<div class="tab-pane active" id="home">
										<h4 class="tx-15 text-uppercase mb-3 text-info">Appointments</h4>
										<p class="m-b-5"> </p>
										<div class="m-t-30">
											@foreach($patient->appointments as $appointment)
											<h4 class="tx-15 text-uppercase mt-3">{{ $loop->index + 1  }}</h4>
											<div class=" p-t-10">
												<h5 class="text-primary m-b-5 tx-14">Doctor : {{$appointment->doctor->fname}} {{$appointment->doctor->lname}} </h5>
												
												<p><b>{{ $appointment->time  }} {{ $appointment->date }} </b></p>
												<p class="text-muted tx-13 m-b-0">{{ $appointment->details }}</p>
											</div>
											@endforeach
											<hr>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection