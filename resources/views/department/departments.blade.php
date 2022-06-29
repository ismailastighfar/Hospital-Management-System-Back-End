@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Departments</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							
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
									<h4 class="card-title mg-b-0">All Departments</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table mg-b-0 text-md-nowrap">
										<thead>
											<tr>
												<th>ID</th>
												<th>Name</th>
												<th>details</th>
												
											</tr>
										</thead>
										<tbody>
                                            @foreach($departments as $dep)
											<tr>
												<th scope="row">{{ $dep->id }}</th>
												<td>{{ $dep->dept_name }}</td>
												<td>{{ $dep->dept_details}}</td>												
												<td><a class="btn btn-sm btn-danger btn-block" onclick="Delete({{ $dep->id }})" >Delete</a></td>
												<td><a class="btn btn-sm btn-success btn-block" href='{{ url( "/departments/edit/".$dep->id ) }}'  >Edit</a></td>
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
		
		<script>
			function Delete(id){
               
				axios({
                        method: "delete",
                        url: window.location.origin + '/api/departments/' + id,
    
                        })
                        .then(function (response) {
                            window.location.reload();	
                            console.log(response);
                        })
                        .catch(function (response) {
                            //handle error
                            console.log(response);
                        });
			}

           
        
		</script> 
@endsection
