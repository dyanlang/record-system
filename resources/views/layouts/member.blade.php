@php
use App\Models\User;
use App\Models\Log;
use App\Models\TithesOffer;
use App\Models\Delete;
use App\Models\Disbursement;
use App\Models\RevisionHistory;
use App\Models\Notif;


    $notifications = Notif::where('member_ID', '=', Auth()->user()->uID)
                    ->where('notifs.is_read', '=', '0' )
                    ->where('notifs.uID', '!=', NULL)
                    ->count('is_read');     
            
    $notif_lists =  Notif::leftjoin('users_tb', 'users_tb.uID', '=' ,'notifs.uID')
                    ->where('notifs.member_ID', '=', Auth::user()->uID)
                    ->where('notifs.uID', '!=', Auth()->user()->uID)
                    ->where('notifs.is_read', '!=', '2' )
                    ->select('users_tb.lastname', 'users_tb.firstname', 'users_tb.user_image', 'notifs.*' )
                    ->orderBy('notifs.created_at', 'DESC')
                    ->get();

    $uType = Auth::user()->user_type;


       

@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8"  />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="/logo/">
  <link rel="icon" type="image/png" href="/logo/seventh-day-adventist-logo.png">
  <title>
  {{ config('app.name', 'Record System') }}
  </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>


    <script src= "https://cdn.jsdelivr.net/npm/billboard.js/dist/billboard.min.js"></script>
    <link rel="stylesheet" href= "https://cdn.jsdelivr.net/npm/billboard.js/dist/billboard.min.css" />
    <link rel="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" type="text/css"/>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.1/Chart.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Modals -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    
    <!-- poppers -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    
    <!-- toast -->
	<link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!--     Chart     -->
    <script src="https://d3js.org/d3.v4.min.js"></script>

    <script src= "https://cdn.jsdelivr.net/npm/billboard.js/dist/billboard.min.js"></script>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" integrity="sha512-vebUliqxrVkBy3gucMhClmyQP9On/HAWQdKDXRaAlb/FKuTbxkjPKUyqVOxAcGwFDka79eTF+YXwfke1h3/wfg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/font-awesome-line-awesome/css/all.min.css" integrity="sha512-dC0G5HMA6hLr/E1TM623RN6qK+sL8sz5vB+Uc68J7cBon68bMfKcvbkg6OqlfGHo1nMmcCxO5AinnRTDhWbWsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    
        <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- pusher -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

  <!-- searchbar -->
  <style>
    html {
      scroll-behavior: smooth;
}
 
  </style>

  <!-- NEW DANIEL 
  <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script> -->

  <link href="../assets/css/guide_dashb54.css" rel="stylesheet">

  <script src="../js/dknotus-tour21.js"></script>
  <script src="../js/dknotus-tour.min28.js" ></script>

  <script src="../js/member23.js"></script>


  <script type="text/javascript">
    $(function(){
      $('#languagesCount').html($('#languagesList dd').length);
    });
  </script>
  
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-success position-absolute w-100"  style=" background: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.2))"></div>
  
 
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 fixed-start " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="/home" >
        <img src="/logo/seventh-day-adventist-logo.png" class="navbar-brand-img h-100" >
        <span class="ms-1 mb-0 text-uppercase text-lg font-weight-bold">{{ config('app.name', 'Record System') }}</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav" id="navigation_dashboard">
        <li class="nav-item">
          <a class="nav-link" href="/home">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="las la-chart-bar text-success opacity-10" style="font-size: 26px"></i>
            </div> 
            <span class="nav-link-text text-md mb-0 text-uppercase font-weight-bold  mt-3 ms-1">Home</span>
          </a>
        </li>

        <li class="nav-item">
           <a class="nav-link" href="{{ url('/pending_request') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="las la-donate text-success opacity-10" style="font-size: 26px"></i>
            </div>
            <span class="nav-link-text text-md mb-0 text-uppercase font-weight-bold mt-2 ms-1">Pending Request</span>
          </a>
        </li>
         <li class="nav-item">
           <a class="nav-link" href="{{ url('/member_setting') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="las la-cog text-success opacity-10" style="font-size: 26px"></i>
            </div>
            <span class="nav-link-text text-md mb-0 text-uppercase font-weight-bold mt-2 ms-1"> Settings </span>
          </a>
        </li>

        <li class="nav-item">
           <a class="nav-link" href=" href="(Route::has('logout'))" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-user-run text-success opacity-10" style="font-size: 26px"></i>
            </div>
            <span class="nav-link-text text-md mb-0 text-uppercase font-weight-bold mt-2 ms-1"> Logout </span>
          </a>

            <form id="logout-form" action="{{ url('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
      </ul>
    </div>
   <div class="sidenav-footer  mx-3 mt-2 ">
      <div class="card card-plain shadow-none" id="sidenavCard">
        <!-- <img class="w-50 mx-auto" src="../assets/img/illustrations/icon-documentation.svg" alt="sidebar_illustration"> -->
        <div class="card-body text-center p-3 w-100 pt-0">
          <div class="docs-info">
            <h6 class="mb-0">Need help?</h6>
            <p class="text-xs font-weight-bold mb-0">Please report a problem</p>
          </div>
        </div>
      </div>
      <a href="https://mail.google.com/mail/?view=cm&to=record.system.church@gmail.com" target="_blank" class="btn btn-success btn-sm w-100 mb-3"> Message us!</a>
    </div>
  </aside>

 

  <!-- MAIN 
-->



  <main class="main-content position-relative border-radius-lg  pt-2">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-0">
        <nav aria-label="breadcrumb">

         

            <div class="col  mt-2 mb-2 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-left">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                    </div>
                    </a>
                </li>
                </div>

          

            <div class="row mt-3">
            </div>
        </nav>

    <div class="collapse navbar-collapse mt-sm-0 mt-2 px-2 me-md-0 me-sm-4" id="navbar">

       
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item px-0 d-flex align-items-center">
              <a href="javascript:;" id="live_notification_dashboard" class="nav-link text-white p-0"> 
                <i class="fa fa-bell fixed-plugin-button-nav cursor-pointer" style="font-size: 25px;"></i> 
                <span class="badge alert-danger">
                    <span id="pending">
                        {{ $notifications }}
                    </span>
                </span> 
              </a>
            </li>

           
            
              <!-- Notifications -->
            

            <!-- <li class="nav-item px-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li> -->
            
            <li class="nav-item dropdown pe-2 d-flex align-items-center" id="admin_profile_dashboard">
                <a href="javascript:;" class="nav-link text-white p-2" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                 <i class="fa fa-user me-sm-1" style="font-size: 25px;"  cursor-pointer" aria-hidden="true"></i>
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
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                            
                            @if ($uType == '2' || $uType == '1')
                            <li>
                                <a class="dropdown-item" href="{{ url('/edit_profile') }}">
                                <i class="fa fa-user me-sm-2" ></i> My Profile
                                </a>
                            </li>
                            @endif

                            <li>
                                <a class="dropdown-item" id="simpleBtn">
                                    <i class="fa fa-cog me-sm-2"></i> 
                                    Need Help?
                                </a>
                            </li>
                            
                        </ul>
                        </li>
                    </ul>
                </div>
            </li>
        </div>
    </div>
</nav>
   <!-- End Navbar -->



   <div class="d-flex justify-content-end p-2">
      <div id="notifDiv"></div>
     
   </div>


      @yield('content')
   
    
      

<!-- Footer -->
   
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="/" class="font-weight-bold" target="_blank">Team Kape</a>

              </div>
            </div>
          
          </div>
        </div>
      </footer>
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
        <!-- End Toggle Button -->
      </div>
     
      <div class="card-body "  style=" overflow-x: hidden">
       <!-- Notification list -->
       <div id='Notifs_list'>
        @foreach($notif_lists as $notif_list)
        @if($notif_list->is_read == '0')
        
          <div class="list-group">
           <a href="/member_view_notification/{{$notif_list->nID}}">
            <div class=" list-group-item-custom cursor-pointer list-group-item_read">
              <div class="media">
                <div class="media-body">
                  <div class="row">
                    <div class="col-10 mt-1">
                    <div class="d-flex align-items-center">
                      <div class="d-flex flex-column px-1">
                          <img src="/users/{{$notif_list->user_image}}" class="rounded-circle img-fluid" width="40" alt="">  
                      </div>

                      <div class="d-flex flex-column">
                        <h6 class="mb-1 text-dark">
                          <span class="text-sm"> {{$notif_list->firstname}}   {{$notif_list->lastname}} </span>
                          <h6 class="mb-1 text-dark text-xs">
                          <!-- If added new tithes and offerings record -->
                          @if( $notif_list->type == 'Tithes_Offering')
                                    @if( $notif_list->notif_type == "Added")
                                        added new record to tithes and offerings!

                                    @elseif( $notif_list->notif_type == "Approved")
                                        Approved your request!

                                    @elseif( $notif_list->notif_type == "For Approval")
                                        Checked your request but needs an approval!
                                    
                                    @elseif( $notif_list->notif_type == "Declined")
                                        Declined your request!

                                    @elseif($notif_list->notif_type == "Modified")                          
                                        modified a record from tithes and offerings!
                                    
                                    @elseif($notif_list->notif_type == "Retrieve") 
                                        retrieved a record from trash to tithes and offerings!

                                    @elseif($notif_list->notif_type == "Move To Trash") 
                                        move a record from  tithes and offerings to trash!

                                    @endif

                                  
                                @elseif($notif_list -> type == 'Disbursement')
                                    @if( $notif_list->notif_type == "Added")
                                            added new record to disbursement!

                                      @elseif($notif_list->notif_type == "Modified")                          
                                          modified a record from disbursement!
                                      
                                      @elseif($notif_list->notif_type == "Retrieve") 
                                          retrieved a record from trash to disbursement!

                                      @elseif($notif_list->notif_type == "Move To Trash") 
                                          move a record from disbursement to trash!
                                      @endif

                                 @else
                                 {{ $notif_list->notif_type }} {{ $notif_list -> type}}
                                  
                                      
                                
                             @endif


                          </h6> 
                        </h6>
                      </div>
                     
                      </div>
                      </a>
                    </div>
                    

                    <div class="d-flex justify-content-end align-items-center col">
                          <div class="d-flex justify-content-end align-items-start">
                            <div class="dropdown"> 
                              <a class="text-black px-1" type="btn" id="dropdownMenuButton2" data-bs-toggle="dropdown">
                                <i class="las la-ellipsis-v" style="font-size: 20px; font-weight: bolder"></i>
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <a href="/member_view_notification/{{$notif_list->nID}}">  
                                  <li>
                                
                                      <i class="las la-eye mx-2"  style="font-size: 20px"></i> 
                                      <span  class="text-xs"> View </span> 
                                  </li>
                                </a>
                                <li>
                                <a href="#" onclick="mark_as_read({{$notif_list->nID }})" >  
                                  <i class="las la-check mx-2"  style="font-size: 20px"></i> 
                                    <span  class="text-xs"> Mark As Read  </span> 
                                  </a>
                                </li>

                                <li>
                                  <a href="#" onclick="remove_notification({{$notif_list->nID }})" >  
                                    <i class="las la-times-circle  mx-2"  style="font-size: 20px"></i> 
                                    <span class="text-xs"> Remove this Notification  </span> 
                                  </a>
                                </li>

                              </ul>
                            </div> 
                          </div>
                        </div> 
                        <div class="row">
                        <div class="col">
                        <p class="text-xs float-end">  {{$notif_list->updated_at->diffForHumans()}} </p>
                        </div>
                      </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            @else
            <div class="list-group">
              <a href="/member_view_notification/{{$notif_list->nID}}"> 
                <div class=" list-group-item-custom cursor-pointer list-group-item">
                  <div class="media">
                    <div class="media-body">
                      <div class="row">
                        <div class="col-10 mt-1">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column px-1">
                            <img src="/users/{{$notif_list->user_image}}" class="rounded-circle img-fluid" width="40" alt="">  
                        </div>

                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark">
                              <span class="text-sm"> {{$notif_list->firstname}}   {{$notif_list->lastname}} </span>
                              <h6 class="mb-1 text-dark text-xs">
                              <!-- If added new tithes and offerings record -->
                              @if( $notif_list->type == 'Tithes_Offering')
                                    @if( $notif_list->notif_type == "Added")
                                        added new record to tithes and offerings!

                                    @elseif( $notif_list->notif_type == "Approved")
                                        Approved your request!
                                    
                                    @elseif( $notif_list->notif_type == "For Approval")
                                        Checked your request but needs an approval!
                                    
                                    @elseif( $notif_list->notif_type == "Declined")
                                        Declined your request!

                                    @elseif($notif_list->notif_type == "Modified")                          
                                        modified a record from tithes and offerings!
                                    
                                    @elseif($notif_list->notif_type == "Retrieve") 
                                        retrieved a record from trash to tithes and offerings!

                                    @elseif($notif_list->notif_type == "Move To Trash") 
                                        move a record from  tithes and offerings to trash!
                                  @endif


                                  @elseif($notif_list->type == 'Disbursement')
                                    @if($notif_list->notif_type == "Added")
                                            added new record to disbursement!

                                      @elseif($notif_list->notif_type == "Modified")                          
                                          modified a record from disbursement!
                                      
                                      @elseif($notif_list->notif_type == "Retrieve") 
                                          retrieved a record from trash to disbursement!

                                      @elseif($notif_list->notif_type == "Move To Trash") 
                                          move a record from disbursement to trash!
                                      @endif
                                
                                @else
                                 {{ $notif_list->notif_type }} their {{ $notif_list -> type}}
                                    @endif

                                 

                              </h6> 
                            </h6>
                          </div>
                          </div>
                           </a>
                        </div>
                     
                       

                        <div class="d-flex justify-content-end align-items-center col">
                              <div class="d-flex justify-content-end align-items-start">
                                <div class="dropdown"> 
                                  <a class="text-black px-1" type="btn" id="dropdownMenuButton2" data-bs-toggle="dropdown">
                                    <i class="las la-ellipsis-v" style="font-size: 20px; font-weight: bolder"></i>
                                  </a>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  
                                    <a href="/member_view_notification/{{$notif_list->nID}}">  
                                      <li>
                                    
                                          <i class="las la-eye mx-2"  style="font-size: 20px"></i> 
                                          <span  class="text-xs"> View </span> 
                                      </li>
                                    </a>

                          
                                    <li>
                                      <a href="#" onclick="remove_notification({{$notif_list->nID }})" >  
                                        <i class="las la-times-circle  mx-2"  style="font-size: 20px"></i> 
                                        <span class="text-xs"> Remove this Notification  </span> 
                                      </a>
                                    </li>

                                  </ul>
                                </div> 
                              </div>
                            </div> 
                            <div class="row">
                              <div class="col">
                                <p class="text-xs float-end">  {{$notif_list->created_at->diffForHumans()}} </p>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            @endif
            @endforeach  
          </div>
        </div>
      </div> 
    </div>
  </div>

<div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
  </div>
</div>    
  

<script type="text/javascript">
    function remove_notification(nID) {
        swal.fire({
            title: "Remove this notification?",
            icon: 'question',
            showCancelButton: !0,
            confirmButtonText: "Yes, Remove it!",
            confirmButtonColor: '#2dce89',
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then((result) => {

            if (result.isConfirmed) {

                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "/remove_notification/" + nID,
                    data: {_token: CSRF_TOKEN},
                    // dataType: 'JSON',
                    // processData: true,
                    // contentType: false,
                    success: function (results) {
                      
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "2000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                                toastr.success("You have remove notification!");

                        // refresh page after 2 seconds
                        setTimeout(function(){
                            $("#notifDiv").fadeOut();
                            $("#pending").load(window.location.href + " #pending" );
                            $("#reload").load(window.location.href + " #reload" );
                            $("#Notifs_list").load(window.location.href + " #Notifs_list" );
                        },2000);
                    }
                });

            }
        
        }, function (dismiss) {
            return false;
    })
}
</script>


<script type="text/javascript">
    function mark_as_read(nID) {
        swal.fire({
            title: "Mark notification as read?",
            icon: 'question',
            showCancelButton: !0,
            confirmButtonText: "Yes, Mark it!",
            confirmButtonColor: '#2dce89',
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then((result) => {

            if (result.isConfirmed) {

                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "/mark_as_read/" + nID,
                    data: {_token: CSRF_TOKEN},
                    // dataType: 'JSON',
                    // processData: true,
                    // contentType: false,
                    success: function (results) {
                      
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "3000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                                toastr.success("The notification is now mark as read!");

                        // refresh page after 2 seconds
                        setTimeout(function(){
                            $("#pending").load(window.location.href + " #pending" );
                            $("#reload").load(window.location.href + " #reload" );
                            $("#Notifs_list").load(window.location.href + " #Notifs_list" );
                        },2000);
                    }
                });

            }
        
        }, function (dismiss) {
            return false;
    })
}
</script>


  <!-- <script src="http://code.jquery.com/jquery-3.4.1.js"></script> -->
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
  @stack('javascript')

<!--   Core JS Files   -->
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