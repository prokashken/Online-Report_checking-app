<html>
<head>
    <title>Patient List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('public/storage/css/bracket.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
  
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body>
  @include('layout.left-panel')
  @include('layout.head-panel')
  @include('layout.right-panel')   

  <div class="br-mainpanel">
    <div class="br-pageheader">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Bracket</a>
        <span class="breadcrumb-item active"></span>
      </nav>
    </div><!-- br-pageheader -->
    <div class="br-pagetitle">
        <h4 style="display: inline;margin:0 auto;color:cyan;">RADIOLOGY REPORTING CENTER</h4> 
    </div><!-- d-flex -->

    <div class="br-pagebody">

        <div class="container">
            {{-- <h1>Laravel 10 Datatable Date Range Filter using AJAX - Techsolutionstuff</h1> --}}
          
            <div style="margin: 20px 0px;">
                <strong>Date Filter:</strong>
                <input type="text" name="daterange" value="" />
                <button class="btn btn-success filter">Filter</button>
            </div>
          
            <table class="table table-bordered data-table" >
                <thead>
                    <tr>
                          <th width="100px">Action</th>
                          <th>Patient ID</th>
                          <th>Patient Name</th>
                          <th>Patient Passport</th>
                          <th>Patient DOB</th>
                          <th>Medical Center</th>
                          <th>Dicom Image</th>
                          <th>Doctor Status</th>
                          <th>Doctor Remarks</th>
                          <th>Updated ON</th>
                          <th>Created ON</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div><!-- br-pagebody -->

  </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
    <script src="{{asset('public/storage/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/storage/lib/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('public/storage/lib/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('public/storage/lib/peity/jquery.peity.min.js')}}"></script>
    <script src="{{asset('public/storage/js/bracket.js')}}"></script>
    
</body>
       
<script type="text/javascript">
  $(function () {
  
    $('input[name="daterange"]').daterangepicker({
        startDate: moment().subtract(1, 'M'),
        endDate: moment()
    });
        
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('patient.list') }}",
            data:function (d) {
                d.from_date = $('input[name="daterange"]').data('daterangepicker').startDate.format('YYYY-MM-DD');
                d.to_date = $('input[name="daterange"]').data('daterangepicker').endDate.format('YYYY-MM-DD');
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
                {data: 'updated_at',name: 'updated_at'},
        ]
    });
  
    $(".filter").click(function(){
        table.draw();
    });
        
  });
</script>
</html>