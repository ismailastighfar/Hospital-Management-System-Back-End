@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Doctors</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button"  onclick="reload()" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<a  class="btn btn-success btn-icon text-white mx-2"  ><i class="mdi mdi-plus"></i></a>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">Sort</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">By name</a>
									<a class="dropdown-item" href="#">By age</a>
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
									
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table mg-b-0 text-md-nowrap">
										<thead>
											<tr>
												<th>ID</th>
												<th>First Name</th>
												<th>Last name</th>
												<th>age</th>
												<th>Email</th>
												<th>Phone</th>
												
											</tr>
										</thead>
										<tbody>
                                            @foreach($doctors as $doctor)
											<tr>
												<th scope="row">{{ $doctor->id }}</th>
												<td>{{ $doctor->fname }}</td>												
												<td>{{ $doctor->lname }}</td>												
												<td>{{ $doctor->age }}</td>												
												<td>{{ $doctor->user->email }}</td>												
												<td>{{ $doctor->phone }}</td>												
												<td><a class="btn btn-sm btn-info  btn-block" href='{{ url( "/doctors/profile/".$doctor->id ) }}' >View Profile</a></td>
												<td><a class="btn btn-sm btn-danger btn-block" onclick="Delete({{ $doctor->user->id }})">Delete</a></td>
												<td><a class="btn btn-outline-success btn-sm btn-block" href="{{ url('/doctors/edit/'.$doctor->id )}}">Edit</a></td>
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
		
@endsection
@section('js')
		<script>
			function Delete(user){
				axios.delete( window.location.origin + '/api/users/'+ user)
				.then( function (res) {
					window.location.reload();	
				})
			}
			function reload(){
				window.location.reload();
			}
		</script>
@endsection