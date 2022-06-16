@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Doctors / create</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')



<div class="row row-sm" >
    <div class="col-6 ">
        <div class="card"  >
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">User information</h4>
                </div>
            </div>
            <form class="card-body row" id="userForm">
            @csrf
                <div class="form-group col-12">
                    <label class="main-content-label tx-11 tx-medium tx-gray-600">username</label> <input class="form-control" required="" name="username" type="text">
                </div>
                <div class="form-group col-12">
                    <label class="main-content-label tx-11 tx-medium tx-gray-600">email</label> <input class="form-control" required="" name="email" type="text">
                </div>
                <div class="form-group col-6">
                    <label class="main-content-label tx-11 tx-medium tx-gray-600">password</label> <input class="form-control" required="" name="password" type="password">
                </div>
                <div class="form-group col-6">
                    <label class="main-content-label tx-11 tx-medium tx-gray-600">password confirmation</label> <input class="form-control" required="" name="password_confirmation" type="password">
                </div>
                <div class="form-group col-6 d-flex " >
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="male" name="gender" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                          famale
                        </label>
                      </div>
                      <div class="form-check ml-2">
                        <input class="form-check-input" type="radio" value="female" name="gender" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                          male
                        </label>
                      </div>
                </div>
               
                <div class="form-group col-12 mt-3">
                    <button  class="btn btn-primary px-4" onclick="Create()">save</button>
                    <button type="reset" class="btn px-2">clear</button>
                </div>
            </form>
        </div>
    </div>
    </div> 
    <div class="col-6 ">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Doctor information</h4>
                </div>
            </div>
            <form class="card-body row">
                <div class="form-group col-12 d-flex flex-column align-items-center ">
                    <img src="{{ asset('/doc_img/defaultpng.png')}}" class="w-25 border" alt="">
                    <label for="picture"><button  class="btn btn-sm btn-info my-2">Choose a Picture</button> </label>
                    <input type="file" id="picture" name="picture" class="d-none">
                </div>
                <div class="form-group col-6">
                    <label class="main-content-label tx-11 tx-medium tx-gray-600">First name</label> <input class="form-control" required="" name="fname" type="text">
                </div>
                <div class="form-group col-6">
                    <label class="main-content-label tx-11 tx-medium tx-gray-600">Last name</label> <input class="form-control" required="" name="lname" type="text">
                </div>
                <div class="form-group col-6">
                    <label class="main-content-label tx-11 tx-medium tx-gray-600">Age</label> <input class="form-control" required="" name="age" type="text">
                </div>
                <div class="form-group col-6">
                    <label class="main-content-label tx-11 tx-medium tx-gray-600">phone</label> <input class="form-control" required="" name="phone" type="text">
                </div>
                <div class="form-group col-12">
                    <label class="main-content-label tx-11 tx-medium tx-gray-600">Email</label> <input class="form-control" required="" name="proEmail" type="email">
                </div>
                <div class="form-group col-6">
                    <label class="main-content-label tx-11 tx-medium tx-gray-600">Last name</label> 
                    <select class="form-control" required="" type="text"> 
                        @foreach ($specialties as $specialty)
                            <option value="{{ $specialty->id }}"> {{ $specialty->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-6">
                    <label class="main-content-label tx-11 tx-medium tx-gray-600">Last name</label> 
                    <select class="form-control" required="" type="text"> 
                        @foreach ($departments as $department)
                        <option value="{{ $department->id }}"> {{ $department->dept_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12">
                    <label class="main-content-label tx-11 tx-medium tx-gray-600">Description</label> <textarea class="form-control" rows="6" required="" name="description"></textarea>
                </div>
                <div class="form-group col-12 my-2">
                    <button type="submit" class="btn btn-primary ">save</button>
                    <button type="submit" class="btn ">cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!--/div-->
    
    <!--/div-->
</div>
<!-- Container closed -->

@endsection
@section('js')
    <script>
        

        function Create(){
            userForm.onsubmit = async (e) => {
                   e.preventDefault();
                   let datas = new FormData(userForm);
                   datas.append("role" , 2);
				axios({
                        method: "post",
                        url: window.location.origin + '/api/users',
                        data: datas,
                        headers: { "Content-Type": "multipart/form-data" },
                        })
                        .then(function (response) {
                            //handle success
                            console.log(response);
                        })
                        .catch(function (response) {
                            //handle error
                            console.log(response);
                        });
			}
        }
       
    
    
           
    </script>
@endsection