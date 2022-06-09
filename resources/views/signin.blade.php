@extends('layouts.master2')
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">
				<!-- The image half -->
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row wd-100p mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
							<img src="{{URL::asset('assets/img/istockphoto-1092994126-612x612.jpg')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
						</div>
					</div>
				</div>
				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="card-sigin">
										<div class="card-sigin">
											<div class="main-signup-header">
												<h2>Welcome back!</h2>
												<h5 class="font-weight-semibold mb-4">Please sign in to continue.</h5>
												<form action="{{ route('login') }}" method='post'>
													@csrf
													<div class="form-group">
														<label>Email</label><input name='email' value="{{ old('email') }}" class="form-control" placeholder="Enter your email" type="email">
													</div>
													@error('email')
														<div class="alert alert-danger">
															{{ $message }}
														</div>
													@enderror
													<div class="form-group">
														<label>Password</label><input name='password' class="form-control" value="{{ old('password') }}" placeholder="Enter your password" type="password">
													</div>
													@error('password')
														<div class="alert alert-danger">
															{{ $message }}
														</div>
													@enderror
													@if (session('status'))
														<div class="alert alert-danger my-2">
															{{ session('status') }}
														</div>
													@endif
													<button type='submit' class="btn btn-main-primary btn-block my-3">Sign In</button>
													
												</form>
												<div class="main-signin-footer mt-5">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->
			</div>
		</div>
@endsection
@section('js')
@endsection