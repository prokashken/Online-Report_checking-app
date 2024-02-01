<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title')</title>
    <link rel="icon" href="{{asset('public/storage/images/title.png')}}" type="image/x-icon">
    <!-- vendor css -->
    <link href="{{asset('public/storage/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/storage/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('public/storage/css/bracket.css')}}">
    @stack('css')
  </head>

  <body>

    @include('layout.left-panel')
    @include('layout.head-panel')
    @include('layout.right-panel')
    
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="#">@yield('upper-headline')</a>
          <!--<span class="breadcrumb-item active"></span>-->
        </nav>
      </div><!-- br-pageheader -->
      <div class="br-pagetitle">
          <h4 style="display: inline;margin:0 auto;color:cyan;">RADIOLOGY REPORTING CENTER</h4> 
      </div><!-- d-flex -->

      <div class="br-pagebody">
        @yield('content')
      </div><!-- br-pagebody -->

    </div><!-- br-mainpanel -->

    {{-- Model for edit Profile --}}
   <!-- BASIC MODAL -->
   <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sign In Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('login') }}">
              @csrf
  
              <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Email:</label>
                  <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Registered Email ID" required>
                  @error('email')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
              </div><!-- form-group -->
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Password:</label>
                  <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password" required>
                  @error('password')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  {{-- <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a> --}}
              </div><!-- form-group -->
              <br>
              <button type="submit" class="btn btn-info btn-block">Sign In</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </form>
        </div>
      </div>
    </div>
  </div>
    {{-- End model --}}
    <!-- ########## END: MAIN PANEL ########## -->
    <script src="{{asset('public/storage/lib/jquery/jquery.min.js')}}"></script>
    @stack('script')
    {{-- <script src="{{asset('public/storage/lib/jquery-ui/ui/widgets/datepicker.js')}}"></script> --}}
    <script src="{{asset('public/storage/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/storage/lib/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('public/storage/lib/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('public/storage/lib/peity/jquery.peity.min.js')}}"></script>
    <script src="{{asset('public/storage/js/bracket.js')}}"></script>


  </body>
</html>
