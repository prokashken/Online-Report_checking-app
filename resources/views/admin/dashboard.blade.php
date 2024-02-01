@extends('layout.app')
@section('content')
    {{-- Card --}}
    <div class="card widget-18 shadow-base mg-t-20">
        <div class="wt-content">
            <div class="wt-content-item">
            <h1 class="wt-title" style="color:cyan; font-weight:bold;">WELCOME TO RADIOLOGY REPORTING EXPERT</h1>
            {{-- <p class="mg-b-30">Find and experience great places to stay, dine, drink and shop near you.</p> --}}

            <div class="d-sm-flex">
                <img class="rounded-10 mg-t-20 mg-l-auto mg-r-auto" style="height: 150px; width:150px; border-redius:5px;" src="{{asset('public/storage/images/doctor.jpg')}}">
                <img class="rounded-5 mg-t-20 mg-l-auto mg-r-auto" style="height: 150px; width:150px; border-redius:5px;" src="{{asset('public/storage/images/patient.png')}}">
                <img class="rounded-5 mg-t-20 mg-l-auto mg-r-auto" style="height: 150px; width:150px; border-redius:5px;" src="{{asset('public/storage/images/medical.png')}}">
            </div>

            <nav class="nav">
                <a href="{{asset("/doctors/create")}}" class="nav-link mg-t-20 mg-l-auto mg-r-auto">
                <span class="iconwrap bg-gray-200 icon-32"><i class="fa fa-plus"></i></span>
                <p>Add Doctors</p>
                </a>
                <a href="{{asset("/users/create")}}" class="nav-link mg-t-20 mg-l-auto mg-r-auto">
                <span class="iconwrap bg-gray-200 icon-32"><i class="fa fa-plus"></i></span>
                <p>Add Users</p>
                </a>
                <a href="{{asset("/medicals/create")}}" class="nav-link mg-t-20 mg-l-auto mg-r-auto">
                <span class="iconwrap bg-gray-200 icon-32"><i class="fa fa-plus"></i></span>
                <p>Add Centers</p>
                </a>
            </nav>
            <nav class="nav">
                <a href="{{asset("/doctors")}}" class="nav-link mg-l-auto mg-r-auto">
                <span class="iconwrap bg-gray-200 icon-32"><i class="icon ion-clipboard"></i></span>
                <p>Check Doctor List</p>
                </a>
                <a href="{{asset("/users")}}" class="nav-link mg-l-auto mg-r-auto">
                <span class="iconwrap bg-gray-200 icon-32"><i class="icon ion-clipboard"></i></span>
                <p>Check User List</p>
                </a>
                <a href="{{asset("/medicals")}}" class="nav-link mg-l-auto mg-r-auto">
                <span class="iconwrap bg-gray-200 icon-32"><i class="icon ion-clipboard"></i></span>
                <p>Check Center List</p>
                </a>
            </nav>
            
            </div><!-- tx-center -->
        </div><!-- d-flex -->
    </div>{{-- Card  End--}}
@endsection