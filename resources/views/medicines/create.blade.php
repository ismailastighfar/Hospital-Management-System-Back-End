@extends('layouts.master')
@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/Create Medicine</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

				

				<!-- row -->
                <form id="formElem"> 
                    @csrf
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
								
								</div>
								<p class="mg-b-20"></p>
								<div class="pd-30 pd-sm-40 bg-gray-200">
									<div class="row row-xs align-items-center mg-b-20">
										<div class="col-md-4">
											<label class="form-label mg-b-0">medicine name</label>
										</div>
										<div class="col-md-8 mg-t-5 mg-md-t-0">
											<input class="form-control"  type="text" name="name">
										</div>
									</div>
									<div class="row row-xs align-items-center mg-b-20">
										<div class="col-md-4">
											<label class="form-label mg-b-0">medicine description</label>
										</div>
										<div class="col-md-8 mg-t-5 mg-md-t-0">
											<input class="form-control"  type="text" name="description">
										</div>
									</div>
									
                                    <div class="row row-xs align-items-center mg-b-20">
										<div class="col-md-4">
											<label class="form-label mg-b-0">medicine quantity</label>
										</div>
										<div class="col-md-8 mg-t-5 mg-md-t-0">
											<input class="form-control"  type="text" name="quantity">
										</div>
									</div>

                                    <div class="row row-xs align-items-center mg-b-20">
										<div class="col-md-4">
											<label class="form-label mg-b-0">medicine price</label>
										</div>
										<div class="col-md-8 mg-t-5 mg-md-t-0">
											<input class="form-control"  type="text" name="price">
										</div>
									</div>

									<div class="row row-xs align-items-center mg-b-20">
                                        <select class="form-control" name="categorie">
                                           @foreach ($categories as $cat)
										   <option value="{{$cat->id}}" > {{$cat->name}}</option>
										   @endforeach
										</select>
									</div>


									<button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" onclick="Create()">Create</button>
									<button type="reset" class="btn btn-dark pd-x-30 mg-t-5">Cancel</button>
                                    
                                    

								</div>
							</div>
						</div>
					</div>
				</div>
                </form>
				<!-- /row -->

				
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Select2 js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Form-layouts js -->
<script src="{{URL::asset('assets/js/form-layouts.js')}}"></script>

 <script>
			function Create(){
                formElem.onsubmit = async (e) => {
                   e.preventDefault();
                   let datas = new FormData(formElem);
				   console.log(datas)
				axios({
                        method: "post",
                        url: window.location.origin + '/api/medicines',
                        data: datas,
                        headers: { "Content-Type": "multipart/form-data" },
                        })
                        .then(function (response) {
						 alert("medicine created succefully")
                        })
                        .catch(function (response) {
                            //handle error
                            console.log(response);
                        });
			}
        }
		</script> 
@endsection