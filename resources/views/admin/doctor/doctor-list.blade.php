@extends('layout.app')
@push('css')
    <link href="{{asset('public/storage/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
    <link href="{{asset('public/storage/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/storage/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/storage/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">
@endpush
@section('upper-headline')
HOME/DOCTORS LIST
@endsection
@section('content')
    <div class="br-section-wrapper">
        <div class="table-wrapper">
            <table id="datatable1" class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Action</th>
                  <th>User Name</th>
                  <th>Doctor Name</th>
                  <th>Mobile No</th>
                  <th>Created On</th>
                  <th>Medical Centre Name</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div><!-- table-wrapper -->

    </div>
@endsection

@push('script')

<script src="{{asset('public/storage/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/storage/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{asset('public/storage/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/storage/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
<script src="{{asset('public/storage/lib/select2/js/select2.min.js')}}"></script>



<script>
  // $(document).ready(function () {
  //       $('#datatable1').DataTable({
  //         responsive: true,
  //               language: {
  //               searchPlaceholder: 'Search...',
  //               sSearch: '',
  //               lengthMenu: '_MENU_ items/page',
  //               },
  //           processing: true,
  //           serverSide: true,
  //           ajax:"{{url('doc/list')}}",
  //           columns: [
  //               {
  //                 data: 'medical_center_id'
  //               },
  //               {
  //                 data: 'doctor_name'
  //               } ,
  //               {
  //                 data: 'name'
  //               } ,
  //               {
  //                 data: 'mobile'
  //               },
  //               {
  //                 data: 'created_at'
  //               },
  //               {
  //                 data: 'id'
  //               }                         
  //           ]
  //       });
  //       $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
  //   });

  
  $(function () {
  
  // $('input[name="daterange"]').daterangepicker({
  //     startDate: moment().subtract(1, 'M'),
  //     endDate: moment()
  // });
      
  var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: "{{ route('doctor.list') }}",
      },
      columns: [
                {data: 'id',name: 'id'}, 
                {data: 'name',name: 'name'},
                {data: 'doctor_name',name: 'doctor_name'} ,
                {data: 'mobile',name: 'mobile'} ,
                {data: 'created_at',name: 'created_at'} ,
                {data: 'medical_center_id',name: 'medical_center_id'}
      ]
  });

  $(".filter").click(function(){
      table.draw();
  });
      
});
</script>
@endpush