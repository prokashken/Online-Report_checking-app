    <!-- ########## START: HEAD PANEL ########## -->
    <div class="br-header">
        <div class="br-header-left">
          <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
          <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
          {{-- <div class="input-group hidden-xs-down wd-170 transition">
            <input id="searchbox" type="text" class="form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
            </span>
          </div><!-- input-group --> --}}
        </div><!-- br-header-left -->
        <div class="br-header-right">
          <nav class="nav">
            <div class="dropdown">
              
              <div class="dropdown-menu dropdown-menu-header">

              </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
            <div class="dropdown">
              {{-- <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
                <i class="icon ion-ios-bell-outline tx-24"></i>
                <!-- start: if statement -->
                <span class="square-8 bg-danger pos-absolute t-15 r-5 rounded-circle"></span>
                <!-- end: if statement -->
              </a> --}}
              <div class="dropdown-menu dropdown-menu-header">
  
                <div class="media-list">
                </div><!-- media-list -->
              </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
            <div class="dropdown">
              <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                <span class="logged-name hidden-md-down">
                  @if (Auth::user()->user_type == 1)
                    {{Auth::user()->doctor_name}}
                  @else
                    {{Auth::user()->name}}
                  @endif
                </span>
                <img src="{{asset('public/storage/images/avatar.jpg')}}" class="wd-32 rounded-circle" alt="">
                <span class="square-10 bg-success"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-header wd-250">
                <div class="tx-center">
                  <a href=""><img src="{{asset('public/storage/images/avatar.jpg')}}" class="wd-80 rounded-circle" alt=""></a>
                  @if (Auth::user()->user_type == 1)
                    <h6 class="logged-fullname">{{Auth::user()->doctor_name}}</h6>
                  @else
                    <h6 class="logged-fullname">{{Auth::user()->name}}</h6>
                  @endif
                  {{-- <p>youremail@domain.com</p> --}}
                </div>
                <hr>
                <div class="tx-center">
                  {{-- <span class="profile-earning-label">Earnings After Taxes</span>
                  <h3 class="profile-earning-amount">$13,230 <i class="icon ion-ios-arrow-thin-up tx-success"></i></h3>
                  <span class="profile-earning-text">Based on list price.</span> --}}
                </div>
                <hr>
                <ul class="list-unstyled user-profile-nav">
                  @php
                      $id = Auth::user()->id;
                  @endphp
                  @if (Auth::user()->user_type == 0)
                    <li><a href='{{url("edit-adminprofile/$id")}}' ><i class="icon ion-ios-person"></i> Edit Profile</a></li>
                  @endif
                  @if (Auth::user()->user_type == 1)
                    <li><a href='{{url("edit-doctorprofile/$id")}}' ><i class="icon ion-ios-person"></i> Edit Profile</a></li>
                  @endif
                @if (Auth::user()->user_type == 2)
                  <li><a href='{{url("edit-userprofile/$id")}}' ><i class="icon ion-ios-person"></i> Edit Profile</a></li>
                @endif
                 
                  {{-- <a href="" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-toggle="modal" data-target="#modaldemo1">View Live Demo</a> --}}

                  {{-- <li><a href=""><i class="icon ion-ios-gear"></i> Settings</a></li>
                  <li><a href=""><i class="icon ion-ios-download"></i> Downloads</a></li>
                  <li><a href=""><i class="icon ion-ios-star"></i> Favorites</a></li>
                  <li><a href=""><i class="icon ion-ios-folder"></i> Collections</a></li> --}}
                  <form action="{{route('logout')}}" method="post">
                    @csrf
                    <li><button type="submit"><i class="icon ion-power"></i> Sign Out</button></li>
                  </form>
                </ul>
              </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
          </nav>
          <div class="navicon-right">
            <a id="btnRightMenu" href="" class="pos-relative">
              {{-- <i class="icon ion-ios-chatboxes-outline"></i> --}}
              <!-- start: if statement -->
              {{-- <span class="square-8 bg-danger pos-absolute t-10 r--5 rounded-circle"></span> --}}
              <!-- end: if statement -->
            </a>
          </div><!-- navicon-right -->
        </div><!-- br-header-right -->
      </div><!-- br-header -->
      <!-- ########## END: HEAD PANEL ########## -->