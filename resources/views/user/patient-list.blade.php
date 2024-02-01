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
<h5>{{Auth::user()->medicals[0]->medical_centre_name}} | ID: {{Auth::user()->medicals[0]->medical_centre_id}}</h5>
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

        <div class="row">
          <div class="col-xl-12">
            <div class="form-layout form-layout-4">
              <div class="row">
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  @if (Auth::user()->role == 1)
                  <form action="{{url('/upload-patients')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="flex-container">
                      <div>
                        <input type="file" id="file" name="file" style="margin-top: 10px; margin-left: 250px;" required>
                      </div>
                      <div>
                        <button type="submit" class="btn btn-warning" >Import CSV</button>
                      </div>
                    </div>
                  </form>
                  <form action="{{url('/upload-images')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="flex-container">
                      <div>
                        <input type="file" id="img" name="images[]" style="margin-top: 10px; margin-left: 250px;" multiple required>
                      </div>
                      <div>
                        <button type="submit" class="btn btn-warning" style="margin-top: 10px;">Upload DICOM Files</button>
                      </div>
                    </div>
                </form>
                  @endif
                  @if (Auth::user()->role == 2)
                  <a  id="export"  style="margin-top: 10px; margin-left: 545px;" class="btn btn-warning mg-t-10">Export CSV</a>
                  @endif
                    @if (Auth::user()->role == 3)
                      <form action="{{url('/upload-patients')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="flex-container">
                          <div>
                            <input type="file" id="file" name="file" style="margin-top: 10px; margin-left: 250px;" required>
                          </div>
                          <div>
                            <button type="submit" class="btn btn-warning" >Import CSV</button>
                          </div>
                        </div>
                      </form>
                      <form action="{{url('/upload-images')}}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="flex-container">
                            <div>
                              <input type="file" id="img" name="images[]" style="margin-top: 10px; margin-left: 250px;" multiple required>
                            </div>
                            <div>
                              <button type="submit" class="btn btn-warning" style="margin-top: 10px;">Upload DICOM Files</button>
                            </div>
                          </div>
                      </form>
                      <a  id="export"  style="margin-top: 10px; margin-left: 545px;" class="btn btn-warning mg-t-10">Export CSV</a>
                    @endif
                </div>
              </div>
            </div>
          </div>
        </div>
         {{-- <div style="margin: 20px 0px;">
            <strong>Date Filter:</strong>
            <input type="text" name="daterange" value="" />
            <button class="btn btn-success filter">Filter</button>
        </div> --}}
        <div class="flex-container">
          <div><span style="font-weight:bold; margin-left: 300px;">Created At:</span></div>
          <div><span style="font-weight:bold; margin-left: 70px;">Updated At:</span></div>
          <div><span style="color:white; margin-left: 28px;">Updated At:</span></div>
        </div>
        <div class="flex-container">
          <div><input type="date" name="created_at" id="created_at" style="margin-left: 300px;"></div>
          <div><input type="date" name="updated_at" id="updated_at" style="margin-left: 10px;"></div>
          <div><input type="button" value="Filter" name="filter" class="filter btn btn-success" id="filter" style="margin-left: 14px; height:30px; padding-top:2px;"></div>
        </div>
        <div class="table-wrapper">
          <form action="{{url('/delete-all')}}" method="post"  onsubmit="return confirm('Do you really want to delete the task?');">
            @csrf
            @if(Auth::user()->role == 4)
            <input type="checkbox" name="checkbox[]" hidden id="">
             @endif
            {{-- <button type="submit" class="btn btn-danger">Delete</button> --}}
            <table class="table table-bordered data-table" >
              <thead>
                <tr>
                  <th>@if(Auth::user()->role == 4)<button type="submit" class="btn btn-danger">Delete</button>@endif</th>
                  <th>@if(Auth::user()->role == 4)Action @endif</th>
                  <th>Patient ID</th>
                  <th>Patient Passport</th>
                  <th>Patient Name</th>
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
            <input type="checkbox" onclick="toggle(this);" />Select all<br />
          </form>
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



function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}

  $(function () {
  
    // $('input[name="daterange"]').daterangepicker({
    //     startDate: moment().subtract(1, 'M'),
    //     endDate: moment().add(1, 'week')
    // });
        

// $('#filter').click(function(){
//   location.reload(true);

// });

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('patient.list') }}",
            data:function (d) {
                d.from_date = $('#created_at').val();
                d.to_date = $('#updated_at').val();
            }
        },
        columns: [
                {data: 'checkbox',name: 'id'},
                {data: 'id',name: 'id'},
                {data: 'patient_id',name: 'patient_id'},
                {data: 'patient_passport',name: 'patient_passport'} ,
                {data: 'patient_name',name: 'patient_name'} ,
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
    $('#export').click(function() {
  var titles = [];
  var data = [];

  /*
   * Get the table headers, this will be CSV headers
   * The count of headers will be CSV string separator
   */
  $('.dataTable th').each(function() {
    titles.push($(this).text());
  });

  /*
   * Get the actual data, this will contain all the data, in 1 array
   */
//   $('.dataTable td').each(function() {
//     // console.log("test",$(this).html());
//     var value = $(this).html();
//     if(value.length < 58){
//         data.push($(this).text());
//     }
//   });
 $('.dataTable tr').each( (tr_idx,tr) => {
    $(tr).children('td').each( (td_idx, td) => {
        if((td_idx  != '0') && (td_idx  != '1') && (td_idx  != '7') && (td_idx  != '10') && (td_idx  != '11')){
            data.push($(td).text());
        }

    });
});
  /*
   * Convert our data to CSV string
   */
  var CSVString = prepCSVRow(titles, titles.length, '');
  CSVString = prepCSVRow(data, titles.length,'');
  /*
   * Make CSV downloadable
   */
  var downloadLink = document.createElement("a");
  var blob = new Blob(["\ufeff", CSVString]);
  var url = URL.createObjectURL(blob);
  downloadLink.href = url;
  downloadLink.download = "patients.csv";

  /*
   * Actually download CSV
   */
  document.body.appendChild(downloadLink);
  downloadLink.click();
  document.body.removeChild(downloadLink);
});
        
  });
  function prepCSVRow(arr, columnCount, initial) {
  var row = ''; // this will hold data
  var delimeter = ','; // data slice separator, in excel it's `;`, in usual CSv it's `,`
  var newLine = '\r\n'; // newline separator for CSV row

  /*
   * Convert [1,2,3,4] into [[1,2], [3,4]] while count is 2
   * @param _arr {Array} - the actual array to split
   * @param _count {Number} - the amount to split
   * return {Array} - splitted array
   */
  function splitArray(_arr, _count) {
    var splitted = [];
    var result = [];

    _arr.forEach(function(item, idx) {
      if ((idx + 1) % 7 === 0) {
        splitted.push(item);
        result.push(splitted);
        splitted = [];
      } else {
        splitted.push(item);
      }
    });
    return result;
  }
  var plainArr = splitArray(arr, columnCount);
  // don't know how to explain this
  // you just have to like follow the code
  // and you understand, it's pretty simple
  // it converts `['a', 'b', 'c']` to `a,b,c` string
  plainArr.forEach(function(arrItem) {
    arrItem.forEach(function(item, idx) {
      row += item + ((idx + 1) === arrItem.length ? '' : delimeter);
    });
    row += newLine;
  });
  return initial + row;
}

  
</script>
@endpush