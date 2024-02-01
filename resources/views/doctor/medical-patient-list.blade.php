@php
    use App\Models\Medical;
    $medicalu = Medical::find($id);


  $medicaList = Auth::user();
  $medicaList = $medicaList->medicals;

  $mediPrevious = $medicaList->where('id', '<', $id)->max('id');
  $mediNext = $medicaList->where('id', '>', $id)->min('id');
@endphp
@extends('layout.app')
@push('css')
     <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
  .flex-container {
    display: flex;
    flex-wrap: nowrap;
    background-color: white;
    margin-bottom: 10px;
  }
  
  .flex-container > div {
    background-color:white;
  }
  </style>
@endpush
@section('title')
ONLINE X-RAY REPORT:: Patient List
@endsection
@section('upper-headline')
<a href="{{ url("medical-patient-list/$mediPrevious") }}" @if($mediPrevious == null) hidden @endif class="btn btn-success mg-r-10" >Previous</a>
<h5>@if ($medicalu) {{$medicalu->medical_centre_name}} @endif | ID: @if ($medicalu) {{$medicalu->medical_centre_id}} @endif</h5>
<a href="{{ url("medical-patient-list/$mediNext") }}" @if($mediNext == null) hidden @endif class="btn btn-success mg-l-10">Next</a>
@endsection
@section('content')
    <div>
      @if (session('status'))
        <div class="alert alert-info" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <strong class="d-block d-sm-inline-block-force">Well Done!</strong> {{ session('status') }}.
        </div>
      @endif
      {{-- <div style="margin: 20px 0px;">
        <strong>Date Filter:</strong>
        <input type="text" name="daterange" value="" />
        <button class="btn btn-success filter">Filter</button>
      </div> --}}
      <div class="flex-container">
        <div><span style="font-weight:bold; margin-left: 700px;">Created At:</span></div>
        <div><span style="font-weight:bold; margin-left: 70px;">Updated At:</span></div>
        <div><span style="color:white; margin-left: 28px;">Updated At:</span></div>
      </div>
      <div class="flex-container">
        <div><input type="date" name="created_at" id="created_at" style="margin-left: 700px;"></div>
        <div><input type="date" name="updated_at" id="updated_at" style="margin-left: 10px;"></div>
        <div><input type="button" value="Filter" name="filter" class="filter btn btn-success" id="filter" style="margin-left: 14px; height:30px; padding-top:2px;"></div>
      </div>
        <div class="table-wrapper">
            <table class="table table-bordered data-table" >
              <thead>
                <tr>
                  <th>Action</th>
                  <th>Patient ID</th>
                  <th>Patient Name</th>
                  <th>Patient Passport</th>
                  <th>Patient DOB</th>
                  <th>Medical Center</th>
                  <th>Dicom Image</th>
                  <th>Doctor Status</th>
                  <th>Doctor Remarks</th>
                  <th>Created ON</th>
                  <th>Updated ON</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div><!-- table-wrapper -->

    </div>
@endsection

@push('script')
 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
  
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript">
  $(function () {
  
    // $('input[name="daterange"]').daterangepicker({
    //     startDate: moment().subtract(1, 'M'),
    //     endDate: moment().add(1, 'week')
    // });
        
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('patient.list') }}",
            data:function (d) {
                d.from_date = $('#created_at').val();
                d.to_date = $('#updated_at').val();
                d.medical_id = {!! json_encode($id) !!};
            }
        },
        columns: [
                {data: 'id',name: 'id'},
                {data: 'patient_id',name: 'patient_id'},
                {data: 'patient_name',name: 'patient_name'} ,
                {data: 'patient_passport',name: 'patient_name'} ,
                {data: 'patient_dob',name: 'patient_dob'},
                {data: 'medical_centre_id',name: 'medical_centre_id'},
                {data: 'dicomfile_name',name: 'dicomfile_name'},
                {data: 'doctor_status',name: 'doctor_status'},
                {data: 'doctor_remarks',name: 'doctor_remarks'},
                {data: 'created_at',name: 'created_at'},
                {data: 'updated_at',name: 'updated_at'}
        ]
    });
  
    $(".filter").click(function(){
        table.draw();
    });
        
  });
</script>
@endpush
