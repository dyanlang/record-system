@php
use App\Models\User;
use App\Models\Log;
use App\Models\TithesOffer;
use App\Models\Delete;
use App\Models\Disbursement;
use App\Models\RevisionHistory;
use App\Models\Notif;


    $notifications = Notif::where('uID', '!=', Auth()->user()->uID)
                    ->whereOr('member_ID', '!=', Auth()->user()->uID)
                    ->where('notifs.is_read', '=', '0' )
                    ->count('is_read');     
            
    $notif_list =  Notif::leftjoin('users_tb', 'users_tb.uID', '=' ,'notifs.uID')
                  ->select('users_tb.lastname', 'users_tb.firstname', 'users_tb.user_image', 'notifs.*' )
                  ->where('notifs.uID', '!=', Auth()->user()->uID)->orWhere('notifs.uID', '=', null)
                  ->where('notifs.member_ID', '!=', Auth()->user()->uID)
                  ->where('notifs.is_read', '!=', '2' )
                  ->orderBy('notifs.created_at', 'DESC')
                  ->get();

    $uType = Auth::user()->user_type;
@endphp



<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
      @include('layouts.include.include')
  </head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-success position-absolute w-100"  
        style=" background: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.2))">
    </div>
  
<!-- NAVIGATION MENU  -->
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 fixed-start" 
          id="sidenav-main">
   
          <div class="sidenav-header">
              <i class="fas fa-times p-3 cursor-pointer 
                  text-secondary opacity-5 position-absolute 
                  end-0 top-0 d-none d-xl-none" 
                  aria-hidden="true" 
                  id="iconSidenav">
              </i>
              <a class="navbar-brand m-0" 
                 href="/home">
                <img src="/logo/seventh-day-adventist-logo.png" 
                    class="navbar-brand-img h-100" >
                    <span class="ms-1 mb-0 text-uppercase  text-lg font-weight-bold">
                      {{ config('app.name', 'Record System') }}
                    </span>
              </a>
          </div>
          
          <hr class="horizontal dark mt-0">

          <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav" 
                id="navigation_dashboard">
              
                <li class="nav-item">
                  <a class="nav-link" href="/home">
                      <div class="icon icon-shape icon-sm border-radius-md 
                            text-center me-2 d-flex align-items-center 
                            justify-content-center">

                          <i class="las la-chart-area text-success opacity-10" 
                            style="font-size: 26px">
                          </i> 
                          
                          <i class="las la-battery-three-quarters"></i>
                      </div> 
                      <span class="nav-link-text text-md mb-0 text-uppercase font-weight-bold  mt-3 ms-1">
                        Dashboard
                      </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a  class="nav-link" 
                        href="{{ url('/tithes&offerings/reports') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="las la-donate text-success opacity-10" 
                               style="font-size: 26px">
                            </i> 
                        </div>
                        <span class="nav-link-text text-md mb-0 text-uppercase font-weight-bold mt-2 ms-1">
                          Tithes & Offerings
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" 
                     href="{{ url('/sabbath-offerings/records') }}">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="las la-coins text-success opacity-10" 
                              style="font-size: 26px">
                          </i>
                      </div>
                      <span class="nav-link-text text-md mb-0 text-uppercase font-weight-bold mt-2 ms-1"> 
                        Sabbath Offering
                      </span>
                    </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" 
                     href="{{ url('/church_members') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="las la-users text-success opacity-10" 
                          style="font-size: 26px">
                        </i>
                    </div>
                    <span class="nav-link-text text-md mb-0 text-uppercase font-weight-bold  mt-2 ms-1">
                        Church Members List
                    </span>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a class="nav-link" 
                     href="{{ url('/disbursement_report') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-paper-diploma text-success text-lg opacity-10">
                      </i>
                    </div>
                    <span class="nav-link-text text-md mb-0 text-uppercase font-weight-bold ms-1">
                          Disbursement
                    </span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" 
                     href="/deleted_tithes_offerings">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="las la-trash text-success opacity-10" 
                          style="font-size: 26px">
                        </i>
                      </div>
                      <span class="nav-link-text text-md mb-0 text-uppercase font-weight-bold mt-2 ms-1">
                          Trash
                      </span>
                  </a>
                </li>
            </ul>
          </div>

          <div class="sidenav-footer  mx-3 mt-2">
              <div class="card card-plain shadow-none" 
                    id="sidenavCard">
                <div class="card-body text-center p-3 w-100 pt-0">
                  <div class="docs-info">
                    <h6 class="mb-0">
                      Need help?
                    </h6>
                    <p class="text-xs font-weight-bold mb-0">
                      Please, report us the problem.
                    </p>
                  </div>
                </div>
              </div>
              <a href="https://mail.google.com/mail/?view=cm&to=record.system.church@gmail.com" 
                 target="_blank" class="btn btn-success btn-sm w-100 mb-3"> 
                 Contact us!
              </a>
          </div>
    </aside>


<!-- TOP NAV MENU -->
  <main class="main-content position-relative border-radius-lg  pt-2">
      <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " 
          id="navbarBlur" 
          data-scroll="false">

          <div class="container-fluid py-1 px-0">
            <nav aria-label="breadcrumb">
              <div class="col  mt-2 mb-2 pb-0 pt-1 px-0 me-sm-6 me-5">
                  <li class="nav-item d-xl-none ps-3 d-flex align-items-left">
                      <a href="javascript:;" 
                        class="nav-link text-white p-0" 
                        id="iconNavbarSidenav">
                        
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                      </a>
                  </li>
              </div>  
          </nav>
          
            <div class="collapse navbar-collapse mt-sm-0 mt-2 px-2 me-md-0 me-sm-4" 
                id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                  <div class="search">
                    <form  action="/search" method="POST">
                      @csrf
                      <div class="input-group" 
                          id="search_dashboard">
                          <span class="input-group-text text-body">
                            <i class="fas fa-search" 
                              aria-hidden="true">
                            </i>
                          </span>
                          <input type="text" 
                                  name="search" 
                                  class="form-control" 
                                  placeholder="Type here...">
                      </div>
                    </form>
                </div>
            </div>

              <ul class="navbar-nav justify-content-end">
                <li class="nav-item px-0 d-flex align-items-center">
                  <a href="javascript:;" id="live_notification_dashboard" 
                    class="nav-link text-white p-0"> 
                      <i class="fa fa-bell fixed-plugin-button-nav cursor-pointer" 
                        style="font-size: 25px;">
                      </i> 
                        <span  class="badge badge-xs bg-gradient-danger"> 
                          <span style="font-size: 10px;"
                                id="pending">
                                {{ $notifications }} 
                          </span>
                        </span>  
                  </a>
                </li>

                <li class="nav-item dropdown pe-2 d-flex align-items-center" 
                    id="admin_profile_dashboard">
                      <a href="javascript:;" 
                        class="nav-link text-white p-2" 
                        id="dropdownMenuButton" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">

                        <i class="fa fa-user me-sm-1" 
                          style="font-size: 25px;"  
                          cursor-pointer' aria-hidden="true">
                        </i>
                            <span class="d-sm-inline d-none">
                                @if ($uType == '2') 
                                    ADMIN 
                                @elseif ($uType == '1') 
                                    CO-ADMIN 
                                @else
                                    MEMBER    
                                @endif
                                | {{   Auth::user()->username; }}

                            </span>
                        </a>
                            <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" 
                              aria-labelledby="dropdownMenuButton">       
                                  @if ($uType == '2' || $uType == '1')
                                    <li>
                                        <a class="dropdown-item" href="{{ url('/edit_profile') }}">
                                        <i class="fa fa-user me-sm-2" ></i> My Profile
                                        </a>
                                    </li>
                                  @endif

                                  <li>
                                    <a class="dropdown-item"
                                      href="/ad_setting">  
                                      <i class="fa fa-cog me-sm-2">

                                      </i> Settings
                                    </a>
                                  </li>

                                  <li>
                                    <a class="dropdown-item" 
                                      id="simpleBtn">  
                                      <i class="fa fa-question me-sm-2">
                                      </i> Need Help?
                                    </a>
                                  </li>

                                  <li>
                                    <a class="dropdown-item" 
                                      href=" href="(Route::has('logout'))" 
                                      onclick="event.preventDefault(); 
                                      document.getElementById('logout-form').submit();">
                                        <i class="ni ni-user-run "></i> 
                                          <span class="nav-link-text ms-1">
                                            {{ __('Logout') }}
                                          </span> 
                                    </a>
                                      <form id="logout-form" 
                                            action="{{ url('logout') }}" 
                                            method="POST" 
                                            class="d-none">
                                        @csrf
                                      </form>
                                    </li>
                                </ul>
                              </li>
                          </ul>
                      </div>
                  </li>
              </div>
          </div>
        </nav>

            <div class="d-flex justify-content-end p-2">
              <div id="notifDiv"></div>
            </div>

            @yield('content')    
            @include('layouts.include.footer')
        
    </div>
  </main>

    <div class="fixed-plugin ps">
      <div class="card shadow-lg">
        <div class="card-header pb-0 ">
          <div class="float-start">
            <h4 class="mt-3 mb-0">Notifications</h4>
          </div>
            <div class="float-end">
              <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                <i class="fa fa-close"></i>
              </button>
            </div>
        </div>
      
        @include('layouts.notification.notification')   

      </div> 
    </div>
  </div>

  <div id="overlay">
      <div class="cv-spinner">
        <span class="spinner"></span>
      </div>
  </div> 

 
<!-- ---------------------------------------------------------  -->



  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
  @stack('javascript')

  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
 
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  
  <!-- Data Table Script -->

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>

  




</body>

</html>