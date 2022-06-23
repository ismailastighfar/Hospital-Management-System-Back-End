@extends('layouts.master2')
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
<style>
    .containerC{
        min-height: 100vh
    }
</style>
@endsection

@section('content')
    <div class=" containerC w-100 m-5 row d-flex justify-content-center align-items-center" >
        <a class="col-3 d-flex justify-content-center align-items-center btn btn-info-outline border mx-2 border-info p-3" href="{{ url('/login') }}">admin</a>
        <a class="col-3 d-flex justify-content-center align-items-center btn btn-info-outline border mx-2 border-info p-3"  href="{{ url('/doctor/login') }}">doctor</a> 
    </div>
@endsection
@section('js')

@endsection