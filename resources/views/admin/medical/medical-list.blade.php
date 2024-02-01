@extends('layout.app')
@push('css')
    <link href="{{asset('public/storage/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
    <link href="{{asset('public/storage/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/storage/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/storage/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">
@endpush
@section('upper-headline')
HOME/MEDICAL CENTRE LIST
@endsection
@section('content')
    <div class="br-section-wrapper">
      @if (session('status'))
        <div class="alert alert-info" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <strong class="d-block d-sm-inline-block-force">Well Done!</strong> {{ session('status') }}.
        </div>
      @endif
        <div class="table-wrapper">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Action</th>
                  <th>Medical Centre Name</th>
                  <th>Medical Centre ID</th>
                  <th>Address</th>
                  <th>Mobile No</th>
                  <th>Logo</th>
                  <th>Created On</th>
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
          url: "{{ route('medical.list') }}",
      },
      columns: [
                {data: 'id',name: 'id'}, 
                {data: 'medical_centre_name',name: 'medical_centre_name'},
                {data: 'medical_centre_id',name: 'medical_centre_id'} ,
                {data: 'medical_centre_address',name: 'medical_centre_address'} ,
                {data: 'medical_centre_mobile',name: 'medical_centre_mobile'},
                {data: 'medical_centre_logo',name: 'medical_centre_logo'},
                {data: 'created_at',name: 'created_at'}
      ]
  });

  $(".filter").click(function(){
      table.draw();
  });
      
});
</script>
@endpush