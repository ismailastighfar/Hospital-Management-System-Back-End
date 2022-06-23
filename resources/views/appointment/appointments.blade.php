
@extends('layouts.master')
@section('css')
@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Appointments</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">all</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">today</a>
									<a class="dropdown-item" href="#">this week</a>
									<a class="dropdown-item" href="#">this mounth</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">All Patients</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table mg-b-0 text-md-nowrap">
										<thead>
											<tr>
                                                
												<th>ID</th>
												<th>details</th>
												<th>date</th>
												<th>time</th>
												<th>patient</th>
												<th>doctor</th>
												<th>added</th>
												<th>edited</th>
											</tr>
										</thead>
										<tbody>
                                            @foreach($appointments as $appointment)
											<tr>
												<th @if( $appointment->status == 0) class=' position-relative '  @endif>{{ $appointment->id }} @if( $appointment->status == 0) <span class=" pulse-danger"></span> @endif</th>
												<th	>{{ $appointment->details }}</th>
												@php
													$date = date_create($appointment->date) 
												@endphp
												<th>{{ date_format( $date, ' l jS F Y') }}</th>
												<th>{{ $appointment->time}}</th>
												<th>{{ $appointment->patient->fullname }} </th>
												<th>{{ $appointment->doctor->fname }} {{ $appointment->doctor->lname }}</th>
												<th class="text-secondary">{{ $appointment->created_at->diffForHumans() }} </th> 
												 <th class="text-secondary">{{ $appointment->updated_at->diffForHumans() }} </th> 
                                                @if( $appointment->status == 0)
													<th><button class="btn btn-success btn-sm btn-block" onclick="Accepte('{{ $appointment->id }}')">Accepte</button></th>
													<th><button class="btn btn-warning btn-sm btn-block" href='/Appointments/edit/{{$appointment->id}}'>Edit</button></th>
												@else
													<th><button class="btn btn-danger btn-sm btn-block" onclick="Delete('{{ $appointment->id }}')">Remove</button></th>
													<th><a class="btn btn-warning btn-sm btn-block" href='/Appointments/edit/{{$appointment->id}}' >Edit</a></th>
												@endif
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->

				
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
		
</div>
@endsection
@section('js')
		<script>
			function Accepte(app){
				console.log(app)
				axios.get( window.location.origin + '/api/appointments/accepte/'+app)
				.then( function (res) {
					window.location.reload();	
				}).catch((error) => {
					console.log(error.response.data)
				})
			}
			function Delete(app){
				console.log(app)
				axios.delete( window.location.origin + '/api/appointments/'+app)
				.then( function (res) {
					// console.log(res.data)
					window.location.reload();	
				}).catch((error) => {
					console.log(error.response.data)
				})
			}
		</script>
@endsection