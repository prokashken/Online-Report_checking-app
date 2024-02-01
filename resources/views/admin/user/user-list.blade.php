@extends('layout.app')
@push('css')
    <link href="{{asset('public/storage/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
    <link href="{{asset('public/storage/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/storage/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/storage/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> --}}
@endpush
@section('upper-headline')
HOME/USERS LIST
@endsection
@section('content')
    <div class="br-section-wrapper">
        <div class="table-wrapper">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Action</th>
                  <th>User Name</th>
                  <th>Role</th>
                  <th>Created On</th>
                  <th>Medical Center Name</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div><!-- table-wrapper -->

    </div>
@endsection

@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="{{asset('public/storage/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/storage/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{asset('public/storage/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/storage/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
<script src="{{asset('public/storage/lib/select2/js/select2.min.js')}}"></script>

{{-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> --}}


<script>
  $(function () {
  
  // $('input[name="daterange"]').daterangepicker({
  //     startDate: moment().subtract(1, 'M'),
  //     endDate: moment()
  // });
      
  var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: "{{ route('user.list') }}",
      },
      columns: [
                {data: 'id',name: 'id'}, 
                {data: 'name',name: 'name'},
                {data: 'role',name: 'role'} ,
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