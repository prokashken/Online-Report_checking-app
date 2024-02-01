@extends('layout.app')
@section('title')
ONLINE X-RAY REPORT:: Doctor Dashboard
@endsection
@section('upper-headline')
<h5>HOME/CENTRE LIST</h5>
@endsection
@section('content')
<table>
          <tr>
            <th>Logo</th>
            <th>Medical Name</th>
            <th>Action</th>
          </tr>
    @foreach ($medicalList as $item)
        <!--<div class="br-section-wrapper mg-b-10" style="height:20px;">-->
        <!--    <div class="d-sm-flex">-->
        <!--        <img class="rounded-10 mg-t-0 mg-l-auto mg-r-auto" style="height: 30px; width:30px; border-redius:5px;" src='{{asset("$item->medical_centre_logo")}}'>-->
        <!--        <h6 class="br-section-label mg-t-0 mg-l-auto mg-r-auto" style="text-align:center;display:inline; margin: 0 auto;">{{$item->medical_centre_name}}</h6>-->
        <!--        <a href='{{url("medical-patient-list/$item->id")}}' class="btn btn-primary mg-t-0 mg-l-auto mg-r-auto" style="width: 150px;height:50px;">Check Patient List</a>-->
        <!--    </div>-->
        <!--</div>-->

          <tr>
            <td><img class="rounded-10 mg-t-0 mg-l-auto mg-r-auto" style="height: 30px; width:30px; border-redius:5px;" src='{{asset("$item->medical_centre_logo")}}'></td>
            <td>
                <h6 class="br-section-label mg-t-0 mg-l-auto mg-r-auto" style="text-align:center;display:inline; margin: 0 auto;">{{$item->medical_centre_name}}</h6>
            </td>
            <td>
                <a href='{{url("medical-patient-list/$item->id")}}' class="btn btn-primary mg-t-0 mg-l-auto mg-r-auto" style="width: 150px;height:50px;">Check Patient List</a>
            </td>
          </tr>
    @endforeach
     </table>

@endsection
@push('css')
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
@endpush