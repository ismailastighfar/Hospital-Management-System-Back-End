@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Doctor</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/Profile/{{ $doctor->fname }}_{{ $doctor->lname }}</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						
						<div class="mb-3 mb-xl-0">
							<button type="button" onclick="Delete({{ $doctor->user->id }})" class="btn btn-danger   ml-2"><i class="mdi mdi-delete mr-2"></i>Delete</button>
						</div>
						<div class=" mb-3 mb-xl-0">
							<button type="button" class="btn btn-info   ml-2"><i class="mdi mdi-pen mr-2"></i>Edit</button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
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
										<div class="main-img-user profile-user d-flex align-items-end ">
											<img alt="" src="{{ asset('avatars/avatar1.png') }}">
										</div>
										<div class="d-flex justify-content-between mg-b-20">
											<div>
												<h5 class="main-profile-name">{{ $doctor->fname }} {{  $doctor->lname }} </h5>
												<p class="main-profile-name-text">{{ $doctor->user->username }}</p>
											</div>
										</div>
										<h4>Total rating</h4>
										<div class="rating-stars-container d-flex mb-4">
											@for ($i = 0; $i < 5; $i++)
												<div class="rating-star">
													<i class="fa fa-star @if($i <= 2) text-warning @endif"></i>
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
					<div class="card">
						<div class="card-body">	
							<h4 class="tx-15 text-uppercase mb-3 text-info">Reviews</h4>
							<p class="m-b-5"> </p>
							<div class="m-t-30">
								<hr>
							</div>
							
						</div>
					</div>
					<div class="card" id="schedule">
						<div class="card-body">
							<div class="breadcrumb-header d-flex justify-content-between align-items-end ">
								<div >
									<h4 class="tx-15 text-uppercase mr-4 text-info">Schedule</h4>
								</div>
								<div class="btn-group ">
									<a class="btn btn-outline-primary @if( url('/doctors/profile/'.$doctor->id.'') == URL::full() ) {{ 'active' }} @endif " href="{{ url('/doctors/profile/'.$doctor->id.'#schedule') }}" >this Week</a>
									<a class="btn btn-outline-primary @if( url('/doctors/profile/'.$doctor->id.'/1') == URL::full() ) {{ 'active' }} @endif" href='{{ url('/doctors/profile/'.$doctor->id.'/1#schedule') }}' >Next Week</a>
									<a class="btn btn-outline-primary @if( url('/doctors/profile/'.$doctor->id.'/2') == URL::full() ) {{ 'active' }} @endif" href='{{ url('/doctors/profile/'.$doctor->id.'/2#schedule') }}' >Next >> </a>
								</div>
							</div>
							<div class="m-t-30">		
								<hr>
							</div>
							<table class="table table-hover table-bordered 	 mg-b-0 text-md-nowrap mt-4">
								<thead>
									<tr>
										<th></th>
										<th>9:00 am</th>
										<th>10:00 am</th>
										<th>11:00 am</th>
										<th>12:00 am</th>
										<th>13:00 pm</th>
										<th>14:00 pm</th>
										<th>15:00 pm</th>
										<th>16:00 pm</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th>
											Monday
										</th>
										@for ($i = 9; $i < 17; $i++ )
											<th class="text-center"> 
												@for ( $j = 0; $j < count($appointment['Mon']) ; $j++ )
													@if( $appointment['Mon'][$j]->time == $i.':00:00')
													
														{{ $appointment['Mon'][$j]->time  }}
													
													@else
													
													@endif
												@endfor
											</th>
										@endfor
									</tr>
									<tr>
										<th>
											Tuesday
										</th>
										@for ($i = 9; $i < 17; $i++ )
											<th class="text-center"> 
												@for ( $j = 0; $j < count($appointment['Tue']) ; $j++ )
													@if( $appointment['Tue'][$j]->time == $i.':00:00')
													
														{{ $appointment['Tue'][$j]->time  }}
													
													@else
													
													@endif
												@endfor
											</th>
										@endfor
									</tr><tr>
										<th>
											Wednesday
										</th>
										@for ($i = 9; $i < 17; $i++ )
											<th class="text-center"> 
												@for ( $j = 0; $j < count($appointment['Wed']) ; $j++ )
													@if( $appointment['Wed'][$j]->time == $i.':00:00')
													
														{{ $appointment['Wed'][$j]->time  }}
													
													@else
													
													@endif
												@endfor
											</th>
										@endfor
									</tr>
									<tr>
										<th>
											Thursday
										</th>
											@for ($i = 9; $i < 17; $i++ )
											<th class="text-center"> 
												@for ( $j = 0; $j < count($appointment['Thu']) ; $j++ )
													@if( $appointment['Thu'][$j]->time == $i.':00:00')
													
														{{ $appointment['Thu'][$j]->time  }}
													
													@else
													
													@endif
												@endfor
											</th>
											@endfor
									</tr>
									<tr>
										<th>
											Friday
										</th>
										@for ($i = 9; $i < 17; $i++ )
											<th class="text-center"> 
												@for ( $j = 0; $j < count($appointment['Fri']) ; $j++ )
													@if( $appointment['Fri'][$j]->time == $i.':00:00')
													
														{{ $appointment['Fri'][$j]->time  }}
													
													@else
													
													@endif
												@endfor
											</th>
										@endfor
									</tr>
								</tbody>
							</table>
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
	function Delete(user){
		axios.delete( window.location.origin + '/api/users/'+ user)
		.then( function (res) {
			window.location.href = '/doctors'	
		})
	}
</script>
@endsection