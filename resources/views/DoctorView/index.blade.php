@extends('layouts.master')
@section('css')
@endsection


@section('content')
                
				<!-- row -->
				<div class="row row-sm mt-5">
					<div class="col-lg-4">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="pl-0">
									<div class="main-profile-overview">
										<div class="main-img-user profile-user d-flex align-items-end ">
											<img alt="" src="{{ $doctor->picture }}">
										</div>
										<div class="d-flex justify-content-between mg-b-20">
											<div>
												<h5 class="main-profile-name">{{ $doctor->fname }} {{  $doctor->lname }} </h5>
												<p class="main-profile-name-text">{{ $doctor->user->username }}</p>
											</div>
										</div>
										<h4>Your rating</h4>
										<div class="rating-stars-container d-flex mb-4">
											@for ($i = 0; $i < 5; $i++)
												<div class="rating-star">
													<i class="fa fa-star @if($i <= 1) text-warning @endif"></i>
											    </div>
											@endfor
											<span class="text-secondary ml-2">reviews (4874)</span>
										</div>
										<h4>Bio</h4>
										<div class="main-profile-bio">
										<h6>Age</h6>
											<p>
											{{ $doctor->age }}
											</p>
											<h6>CNE</h6>
											
											<h6>About</h6>
											<p>
											{{ $doctor->description }}
											</p>
											<h6>Departemnt</h6>
											<p>
											{{ $doctor->department->dept_name }}
											</p>
											<h6>Specialty</h6>
											<p>
											{{ $doctor->specialty->name }}
											</p>

									
										</div><!-- main-profile-bio -->
                                        
										<h4>Contact</h4>
										<div class="main-profile-bio">
										<h6>Email</h6>
											<p>
											{{ $doctor->user->email }}
											</p>
											<h6>Phone Number</h6>
											<p>
											{{ $doctor->phone}}
											</p>
											<h6>Profisionnel Email</h6>
											<p>
											{{ $doctor->proEmail }}
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
										<div class="counter-status d-flex md-mb-2">
											<div class="counter-icon bg-primary-transparent">
												<i class="icon-calendar text-primary"></i>
											</div>
											<div class="ml-3">
												<h5 class="tx-13">appointments</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">{{count($doctor->appointments)}}</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-6 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-2">
											<div class="counter-icon bg-danger-transparent">
												<i class="icon-question text-danger"></i>
											</div>
											<div class="ml-3">
												<h5 class="tx-13">Answers Provided</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">{{count($doctor->answers)}}</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					
					<div class="card" id="schedule">
						<div class="card-body">
							<div class="breadcrumb-header d-flex justify-content-between align-items-end ">
								<div>
									<h4 class="tx-15 text-uppercase mr-4 text-info">today Appoitment</h4>
								</div>
						</div>
                        <div class="container m-3">
							<div class="row">
							@foreach ($appointment as $app)
								<div class=" pl-5 p-t-10  my-3 col-6  border-left ">
									<p>at <b>{{ $app->time  }}</b></p>
                                    <h5 class="text-primary m-b-5 tx-14">Patient:  <a href="/patients/profile/{{ $app->patient->id }}">{{ $app->patient->fullname }} </a>  </h5>
                                    <p class="text-muted tx-13 m-b-0">  <b> details: </b>  {{ $app->details }}</p>
									@if ( $app->status == 1 )
									<button class="btn btn-success" onclick="Completed({{ $app->id }})">complite</button>
									<a class="btn btn-info" href="/doctor/prescreption/{{ $app->id}}" >write prescreption</a>
									@else
									<button class="btn btn-secondary"  disabled>complited</button>
										
									@endif
								</div>
                            @endforeach
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
<script>
	function Completed(app){
		axios.get( window.location.origin + '/api/appointments/complete/'+app)
		.then( function (res) {
			console.log(res.data	)
			window.location.reload()	
		}).cat
	}

</script>
@endsection