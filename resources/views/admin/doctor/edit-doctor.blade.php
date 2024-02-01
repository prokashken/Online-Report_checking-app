@php
  use App\Models\Medical;
@endphp 
@extends('layout.app')
@section('upper-headline')
HOME/EDIT DOCTOR
@endsection
@push('css')

<style>
  .multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
  overflow-y:hidden;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}
</style>
<style>
         .MultiCheckBox {
            border:1px solid #e2e2e2;
            padding: 5px;
            border-radius:4px;
            cursor:pointer;
        }

        .MultiCheckBox .k-icon{ 
            font-size: 15px;
            float: right;
            font-weight: bolder;
            margin-top: -7px;
            height: 10px;
            width: 14px;
            color:#787878;
        } 

        .MultiCheckBoxDetail {
            display:none;
            position:absolute;
            border:1px solid #e2e2e2;
            overflow-y:hidden;
            z-index: 1;
        }

        .MultiCheckBoxDetailBody {
            overflow-y:scroll;
        }

            .MultiCheckBoxDetail .cont  {
                clear:both;
                overflow: hidden;
                padding: 2px;
                background-color: black;
            }

            .MultiCheckBoxDetail .cont:hover  {
                background-color:#cfcfcf;
            }

            .MultiCheckBoxDetailBody > div > div {
                float:left;
            }

        .MultiCheckBoxDetail>div>div:nth-child(1) {
        
        }

        .MultiCheckBoxDetailHeader {
            overflow:hidden;
            position:relative;
            height: 28px;
            background-color:#3d3d3d;
        }

            .MultiCheckBoxDetailHeader>input {
                position: absolute;
                top: 4px;
                left: 3px;
            }

            .MultiCheckBoxDetailHeader>div {
                position: absolute;
                top: 5px;
                left: 24px;
                color:#fff;
            }
</style>
@endpush
@section('content')
    <div class="br-section-wrapper">
        <h6 class="br-section-label" style="text-align:center;">Edit Doctor</h6>
        @if (session('status'))
          <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <strong class="d-block d-sm-inline-block-force">Well Done!</strong> {{ session('status') }}.
          </div>
        @endif
       <form action="{{url("/doctors/$doctor->id")}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-xl-12">
            <div class="form-layout form-layout-4">
              <h6 class="br-section-label">Doctor Info</h6>
              <div class="row">
                <label class="col-sm-4 form-control-label">Medical Center: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  {{-- <select class="form-control select2 @error('medical_center_id') is-invalid @enderror" name="medical_center_id[]" data-placeholder="Select Medical Center" multiple>
                    <option selected="" disabled="">--Choose One--</option>
                      @foreach (Medical::List() as $item)
                        @php
                          if (in_array($item->id, $doctor_medicals)) {
                            $selected = "selected";
                          } else {
                            $selected = "";
                          }
                        @endphp
                        <option {{$selected}} value="{{$item->id}}">{{$item->medical_centre_name}}</option>
                      @endforeach
                  </select> --}}
                  {{-- <select id="test" class="form-control select2 @error('medical_center_id') is-invalid @enderror" name="medical_center_id[]">
                    @foreach (Medical::List() as $item)
                      @php
                        if (in_array($item->id, $doctor_medicals)) {
                          $selected = "selected";
                        } else {
                          $selected = "";
                        }
                      @endphp
                      <option se value="{{$item->id}}">{{$item->medical_centre_name}}</option>
                    @endforeach
                  </select> --}}
                  <form>
                    <div class="multiselect">
                      <div class="selectBox" onclick="showCheckboxes()">
                        <select>
                          <option>Select an option</option>
                        </select>
                        <div class="overSelect"></div>
                      </div>
                      <div id="checkboxes">
                        @foreach (Medical::List() as $item)
                        @php
                          if (in_array($item->id, $doctor_medicals)) {
                            $checked = "checked";
                          } else {
                            $checked = "";
                          }
                        @endphp
                            <label for="one">
                              <input type="checkbox" name="medical_center_id[]" {{$checked}} id="one" value="{{$item->id}}" />{{$item->medical_centre_name}}</label>
                        @endforeach
                      </div>
                    </div>
                  </form>                  
                  @error('medical_center_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div><!-- row -->
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Doctor Name: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" name="doctor_name" value="{{$doctor->doctor_name}}" class="form-control @error('doctor_name') is-invalid @enderror" placeholder="Enter Doctor name" required>
                  @error('doctor_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
            </div>
              <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Mobile Number: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" name="mobile" value="{{$doctor->mobile}}" class="form-control @error('mobile') is-invalid @enderror" placeholder="Enter Mobile Number" required>
                    @error('mobile')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Username: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" name="name" value="{{$doctor->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Username" required>
                  @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
            </div>
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
                <a href='{{asset("/doctors")}}' class="btn btn-secondary" style="color: white;">Cancel</a>
              </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
          </div><!-- col-6 -->
        </div>   
       </form>
    </div>
@endsection

@push('script')
<script>
  var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
</script>
@endpush