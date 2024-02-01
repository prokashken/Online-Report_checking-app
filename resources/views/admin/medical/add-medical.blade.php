@extends('layout.app')
@section('upper-headline')
HOME/ADD MEDICAL CENTRE
@endsection
@section('content')
    <div class="br-section-wrapper">
        <h6 class="br-section-label" style="text-align:center;">Add Medical Center</h6>
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        @if (session('status'))
          <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <strong class="d-block d-sm-inline-block-force">Well Done!</strong> {{ session('status') }}.
          </div>
        @endif
        <form action="{{route('medicals.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-xl-12">
              <div class="form-layout form-layout-4">
                <h6 class="br-section-label">Medical Center Info</h6>
                <div class="row">
                  <label class="col-sm-4 form-control-label">Medical Center Name: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" name="medical_centre_name" class="form-control @error('medical_centre_name') is-invalid @enderror" placeholder="Enter Medical Center Name" required>
                    @error('medical_centre_name')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Medical Center ID: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" name="medical_centre_id" class="form-control @error('medical_centre_id') is-invalid @enderror" placeholder="Enter Medical Center ID" required>
                    @error('medical_centre_id')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Address: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" name="medical_centre_address" class="form-control @error('medical_centre_address') is-invalid @enderror" placeholder="Enter Address" required>
                    @error('medical_centre_address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Mobile Number: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input class="form-control @error('medical_centre_mobile') is-invalid @enderror" type="number" name="medical_centre_mobile" placeholder="Enter your Mobile Number" required>
                    @error('medical_centre_mobile')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Upload Logo: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <div class="custom-file @error('medical_centre_logo') is-invalid @enderror">
                            <input type="file" id="file" name="medical_centre_logo" class="custom-file-input" required>
                            <label class="custom-file-label">Choose File</label>
                          @error('medical_centre_logo')
                            <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </div>
                    </div>
                  </div>
                <div class="form-layout-footer mg-t-30">
                  <button class="btn btn-info">Submit Form</button>
                  <a class="btn btn-secondary" href="{{asset("admin/dashboard")}}" style="color:white;">Cancel</a>
                </div><!-- form-layout-footer -->
              </div><!-- form-layout -->
            </div><!-- col-6 -->
          </div>
        </form>   
    </div>
@endsection