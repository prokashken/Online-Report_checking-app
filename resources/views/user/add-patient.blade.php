@extends('layout.app')
@section('title')
ONLINE X-RAY REPORT:: Add Patient
@endsection
@section('upper-headline')
<h5>{{Auth::user()->medicals[0]->medical_centre_name}} | ID: {{Auth::user()->medicals[0]->medical_centre_id}}</h5>
@endsection
@section('content')
    <div class="br-section-wrapper">
        <h6 class="br-section-label" style="text-align:center;">Add Patient</h6>
        @if (session('status'))
          <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <strong class="d-block d-sm-inline-block-force">Well Done!</strong> {{ session('status') }}.
          </div>
        @endif
        <form action="{{route('patients.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-xl-12">
              <div class="form-layout form-layout-4">
                <h6 class="br-section-label">Patient Info</h6>
                <div class="row">
                  <label class="col-sm-4 form-control-label">Patient ID: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" name="patient_id" class="form-control @error('patient_id') is-invalid @enderror" placeholder="Enter Patient Id" required>
                    @error('patient_id')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Patient Name: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" name="patient_name" class="form-control @error('patient_name') is-invalid @enderror" placeholder="Enter Medical Patient Name" required>
                    @error('patient_name')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Patient Passport Number: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" name="patient_passport" class="form-control @error('patient_passport') is-invalid @enderror" placeholder="Enter Patient Passport Number" required>
                    @error('patient_passport')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Patient Date Of Birth: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input class="form-control @error('patient_dob') is-invalid @enderror" type="date" name="patient_dob" placeholder="Enter Patient DOB" required>
                    @error('patient_dob')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Upload Dicome File: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        {{-- <div class="custom-file @error('medical_centre_logo') is-invalid @enderror"> --}}
                            <input type="file" id="file" name="dicomfile_name" required>
                            {{-- <label class="custom-file-label">Choose File</label> --}}
                          @error('medical_centre_logo')
                            <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        {{-- </div> --}}
                    </div>
                  </div>
                <div class="form-layout-footer mg-t-30">
                  <button class="btn btn-info">Submit Form</button>
                  <a href='{{asset("/patients")}}' style="color:white;" class="btn btn-secondary">Cancel</a>
                </div><!-- form-layout-footer -->
              </div><!-- form-layout -->
            </div><!-- col-6 -->
          </div>
        </form>   
    </div>
@endsection