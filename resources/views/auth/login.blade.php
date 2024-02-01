<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>DlabNets</title>
    <link rel="icon" href="{{asset('public/storage/images/title.png')}}" type="image/x-icon">
    <!-- vendor css -->
    <link href="{{asset('public/storage/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/storage/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('public/storage/css/bracket.css')}}">
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
        <p style="margin: 0 auto; text-align:center;"><img src="{{asset('public/storage/images/stack-logo.png')}}"></p>
        <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal">[</span> DLab <span class="tx-info">Nets</span> <span class="tx-normal">]</span></div>
        <div class="tx-center mg-b-40">
          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
          {{-- <P> The Admin Template For Perfectionist</P> --}}
        </div>
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <!-- Email Address -->
          <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Enter your username" value="{{old('name')}}" required>
          </div><!-- form-group -->

          <!-- Password -->
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
            {{-- <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a> --}}
          </div><!-- form-group -->

          <!-- Sign In Button -->
          <button type="submit" class="btn btn-info btn-block">Sign In</button>
        </form>
        {{-- <div class="mg-t-60 tx-center">Not yet a member? <a href="" class="tx-info">Sign Up</a></div> --}}
      </div><!-- login-wrapper -->
    </div><!-- d-flex -->

    <script src="{{asset('public/storage/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/storage/lib/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <script src="{{asset('public/storage/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  </body>
</html>
