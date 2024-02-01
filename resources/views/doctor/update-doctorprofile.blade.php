@php
  use App\Models\Medical;
@endphp
@extends('layout.app')
@section('content')
    <div class="br-section-wrapper">
        <h6 class="br-section-label" style="text-align:center;"></h6>
        @if (session('status'))
          <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <strong class="d-block d-sm-inline-block-force">Well Done!</strong> {{ session('status') }}.
          </div>
        @endif
        <form action="{{url("update-doctorprofile/$id")}}" method="POST">
          @csrf
          <div class="row">
            <div class="col-xl-12">
              <div class="form-layout form-layout-4">
                <h6 class="br-section-label">Change User Info</h6>
                <div class="row">
                    <label class="col-sm-4 form-control-label">Username: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control @error('name') is-invalid @enderror"  placeholder="Enter Username" disabled>
                      @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                </div><!-- row -->
 
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Password: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password">
                    @error('password')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-layout-footer mg-t-30">
                  <button class="btn btn-info">Submit Form</button>
                  <a  href='{{asset("/doctor-home")}}' style="color:white;" class="btn btn-secondary">Cancel</a>
                </div><!-- form-layout-footer -->
              </div><!-- form-layout -->
            </div><!-- col-6 -->
          </div> 
        </form>  
    </div>
@endsection