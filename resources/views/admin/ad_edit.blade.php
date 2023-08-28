@extends('layouts.DashB')

@section('content')
<section>
<div class="container-fluid">
<div class="row" id="Profile">
        <div class="col-lg-12 mt-4">
            <div class=" mb-0">
                <h4 class="font-weight-bolder text-white "> My Profile  </h4> 
            </div>
            <div class="no-gutters row"> 
                <div class="d-flex justify-content-between ">
                    <span class="text-left text-white"> @php  $dtae = date_default_timezone_set('Asia/Manila') @endphp {{  date('F j, Y g:i:a  ') }} </span>
                </div>
            </div>
        </div>
  

    <div class="row mt-4">
      <div class="col-lg-4">
        <div class="card mb-4" id="profile_picture_my_profile">
          <div class="card-header pb-0">
            <div class="d-flex justify-content-between">            
              <div>
                  <a href="#" onclick="history.back()">
                      <span id="goback_button_my_profile" class="text-gray">
                          <i class="las la-arrow-left" style="font-size: 22px"></i>
                          <span> 
                              GO BACK
                          </span> 
                      </span>                   
                  </a>
              </div>
            </div>
          </div>
          <div class="card-body text-center">
            
            <img src="/users/{{Auth::user()->user_image}}" alt="profile_image" class="rounded-circle img-fluid" style="width: 150px;">
            
            <h5 class="my-3">

              {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} 

            </h5>

            <p class="text-muted mb-1">

                @if (Auth::user()->user_type == 2)

                  Admin

                @elseif (Auth::user()->user_type == 1)

                  Co-Admin

                @else

                  Church Member

                @endif

            </p>

            <div class="d-flex justify-content-center mb-2">

              <button id="upload_button_my_profile" type="button" class="btn btn-sm btn-primary" href="javascript:;" role="tab" aria-selected="false" data-toggle="modal" data-target="#editA"> 
                  
                  Upload Photo

              </button>
              <!-- <button type="button" class="btn btn-outline-primary ms-1"> </button> -->
            </div>
          </div>
        </div>

        <!-- modal -->

        <div class="modal fade" id="editA" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header bg-primary">
                      <h5 class="modal-title text-white" id="staticBackdropLabel">
                          Edit Profile Picture
                      </h5>
                      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="container">
                    <center>
                        <img src="/users/{{Auth::user()->user_image}}" class="rounded-circle img-fluid logo mb-5 mt-5" style="height: 160px; width: 160px; border-radius: 10%;">
                    </center>
                    
                    <div style="">
                        <form enctype="multipart/form-data" action="{{ route('update_image') }}" method="POST">
            
                            <input type="file"   class="form-control" name="user_image">
                            <br><br>
                            <input type="hidden" class="form-control" name="_token" value="{{ csrf_token() }}">
                      
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-sm btn-success">Submit</button>
                          </div>
                        </form>
                    </div>

                  </div>
              </div>
          </div>
      </div>

      <div class="col-lg">
        <div class="card mb-5 mb-md-0">
          <div class="card-header">
            <h5 class="text-sm"> Log Activity </h5>
          </div>
          <div class="card-body p-0 keep-scrolling">
            <div class="list-group">
              @foreach($log_history  as $log_history)
                <div class="list-group mx-4" >
                  <div class=" list-group-item-custom cursor-pointer list-group-item">
                    <div class="media">
                      <div class="media-body">
                        <div class="row my-2">
                          <div class="col-md-4">
                              <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate"> Last activity </p>
                                  <h6 class="text-gray  text-sm">
                                      <span class="text-truncate"> {{$log_history->created_at}} </span>
                                  </h6>
                          </div>
                          <div class="col text-end">
                            <h6 class="text-gray  text-xs mt-4">
                                <span class="text-truncate" >{{$log_history->created_at->diffForHumans()}} </span>
                            </h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>  
              @endforeach
            </div>
          </div>
        </div> 
      </div>
    </div>
       

        <!-- modal -->
      
      
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body" id="information_my_profile">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> {{ Auth::user()->firstname }} {{ Auth::user()->middlename }} {{ Auth::user()->lastname }} </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Username</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->username }} </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
              </div>
            </div>
            <hr>

              @php
                  $phone = Auth::user()->user_mobile_number ;
                  
                  $ac = substr($phone, 0, 3);
                  $prefix = substr($phone, 3, 3);
                  $suffix = substr($phone, 6);

              @endphp

            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone No. </p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> {{$ac}} {{$prefix}} {{$suffix}} </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> 
                    {{ Auth::user()->user_street }}, 
                    {{ Auth::user()->user_barangay }}, 
                    {{ Auth::user()->user_city }}, 
                    {{ Auth::user()->uZip }} </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Birthday</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->birthday }} </p>
              </div>

            
            </div>

            <div class="row mt-5">
                  <button id="edit_button_my_profile" type="button" class="btn btn-primary" type="button" href="javascript:;" role="tab" aria-selected="false" data-toggle="modal" data-target="#editB"> 
                      Edit Personal Details 
                  </button>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg mx-2">
            <div class="card mb-5  mb-md-0">
              <div class="card-body">
              <form action="/member_tithes/{{ $users->uID }}" method="POST"  formtarget="_blank" target="_blank" enctype="multipart/form-data">
                        @csrf

                        <div class="container">

                            <div class="row">
                                <div class="col-md-3" id="profile_datefrom_church_member_view">
                                <label for="from1" class="col-form-label text-xs ">From</label>
                                    <input type="date" class="form-control input-sm" id="from1" name="from1"  value="<?php if(isset($_POST['from1'])) { echo $_POST['from1']; } ?>" required>
                                </div>
                                <div class="col-md-3" id="profile_dateto_church_member_view">
                                <label for="to1" class="col-form-label  text-xs  ">To</label>
                                    <input type="date" class="form-control input-sm" id="to1" name="to1" value="<?php if(isset($_POST['to1'])) { echo $_POST['to1']; } ?>" required>
                                </div>
                                <div class="col-md-6 pt-3 my-3 d-flex justify-content-end">

                                    <section id="search_btn_church_member_view">
                                    <li class="list-group" data-bs-toggle="tooltip" title="Search Filter">
                                        <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 mr-4">
                                            <button type="submit" class="btn btn-sm btn-outline-success btn-sm" name="mem_search" >
                                                <i class="las la-search" style="font-size: 12pt"></i>
                                                SEARCH FILTER
                                            </button>
                                        </div>

                                    </li>
                                        
                                    <li class="list-group dropdown no-arrow d-sm-none" title="Search Filter">
                                        <button type="submit" class="btn btn-outline-success btn-sm mr-3"  title="Search Filter" name="mem_search" >
                                        <i class="las la-search" style="font-size: 20px"></i></button>
                                    </li>
                                    </section>

                                    <section id="export_pdf_church_member_view"> 
                                    <li class="list-group" data-bs-toggle="tooltip" title="Export PDF">
                                        <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
                                            <button type="submit" class="btn btn-success btn-sm" name="export_member_tithesPDF" target="_blank" rel="noopener">
                                            <i class="las la-file-export" style="font-size: 12pt"></i> EXPORT PDF </button>                 
                                        </div>
                                    </li>
                                        
                                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                                    <li class="list-group no-arrow d-sm-none d-md-none" title="Export PDF">
                                        <button type="submit" class="btn btn-success btn-sm" title="Export PDF" name="export_member_tithesPDF" target="_blank">
                                        <i class="las la-file-export" style="font-size: 20px"></i> </button>                 
                                    </li>        
                                    </section>
                                </div>
                            </div>
                        </div>
                    </form>

                    <br>
                    
                    <div class="table-responsive mx-0 overflow-auto" id="record_church_member_view">
                        <table class="table table-format">
                            <tr>
                                <th scope="col">
                                    Tithes Amount
                                </th>
                                <th scope="col">
                                    Offering Plan Amount
                                </th>
                                <th scope="col">
                                    Other Gifts Amount
                                </th>
                                <th scope="col">
                                    Description
                                </th>
                                <th scope="col">
                                    Type
                                </th>
                                <th scope="col">
                                    Date Created
                                </th>
                            </tr>

                            @foreach ($history as $tithes)
                                <tr>
                                  <td>
                                      {{ number_format($tithes->tithes_offer_tithe_amount, 2) }}
                                  </td>
                                  <td>
                                      {{ number_format($tithes->tithes_offer_offering_plan_amount, 2) }}
                                  </td>
                                  <td>
                                      {{ number_format($tithes->tithes_offer_other_gifts_amount, 2) }}
                                  </td>
                                  <td>
                                      {{ $tithes->tithes_offer_other_gifts_desciption }}
                                  </td>
                                  <td>

                                    @if ($tithes->tithes_offer_type == 'Cash')
                                        <span class="badge badge-sm bg-gradient-warning">
                                        Cash
                                        </span>

                                    @elseif ($tithes->tithes_offer_type == 'GCash')
                                        <span class="badge badge-sm bg-gradient-success">
                                        GCash
                                        </span>

                                    @elseif ($tithes->tithes_offer_type == 'Bank')
                                        <span class="badge badge-sm bg-gradient-info">
                                        Bank
                                        </span>

                                    @else
                                        <span class="badge badge-sm bg-gradient-secondary">
                                            {{ $tithes->tithes_offer_type }}
                                        </span>
                                    @endif     
                                  </td>
                                  <td>
                                      {{ $tithes->created_at->toDateString() }}
                                  </td>
                                </tr>
                            @endforeach


                        </table>
              </div>
            </div>
        
          </div> 

        <!-- modal -->

        <div class="modal fade" id="editB" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="staticBackdropLabel"> Edit Profile Info </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="container">
                    <form method="POST" action="/edit_profile/{{ Auth::user()->uID }}">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <table class="table table-format">
                                        <div class="form-group">
                                            <tr>
                                                <th scope="col">
                                                    <label for="firstname">Firstname</label>
                                                </th>
                                                <td><input type="text" class="form-control" name="firstname" id="firstname"
                                                    value="{{ Auth::user()->firstname }}" required>
                                                </td>
                                                
                                            </tr>
                                        </div>
                                        <div class="form-group">
                                            <tr>
                                                <th scope="col">
                                                    <label for="middlename">Middlename</label>
                                                </th>
                                                <td><input type="text" class="form-control" name="middlename" id="middlename"
                                                    value="{{ Auth::user()->middlename }}">
                                                </td>
                                            </tr>
                                        </div>
                                        <div class="form-group">
                                            <tr>
                                                <th scope="col">
                                                    <label for="lastname">Lastname</label>
                                                </th>
                                                <td><input type="text" class="form-control" name="lastname" id="lastname"
                                                    value="{{ Auth::user()->lastname }}" required>
                                                </td>
                                            </tr>
                                        </div>
                                        
                                        <div class="form-group">
                                            <tr>
                                                <th scope="col">
                                                    <label for="uBday">Birthday</label>
                                                </th>
                                                <td>
                                                    <input type="date" id="datepicker" class="form-control" name="birthday" placeholder="YYYY-MM-DD" value="{{ Auth::user()->birthday }}" required/>
                                                </td>
                                            </tr>
                                        </div>

                                        <div class="form-group">
                                            <tr>
                                                <th scope="col">
                                                    <label for="email">Email Address</label>
                                                </th>
                                                <td>
                                                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required/>
                                                </td>
                                            </tr>
                                        </div>
                                        
                                        <div class="form-group">
                                            <tr>
                                                <th scope="col">
                                                    <label for="uMob">Mobile Number</label>
                                                </th>
                                                <td>
                                                  <input type="number" class="form-control" name="user_mobile_number" id="user_mobile_number"
                                                    value="{{ Auth::user()->user_mobile_number }}" required>
                                                </td>
                                            </tr>
                                        </div>
                                        
                                        <div class="form-group">
                                            <tr>
                                                <th scope="col">
                                                    <label for="uStrt">Street</label>
                                                </th>
                                                <td>
                                                  <input type="text" class="form-control" name="user_street" id="user_street"
                                                    value="{{ Auth::user()->user_street }}" required>
                                                </td>
                                            </tr>
                                        </div>
                                        <div class="form-group">
                                            <tr>
                                                <th scope="col">
                                                    <label for="uBrgy">Barangay</label>
                                                </th>
                                                <td>
                                                  <input type="text" class="form-control" name="user_barangay" id="user_barangay"
                                                    value="{{ Auth::user()->user_barangay }}" required>
                                                </td>
                                            </tr>
                                        </div>
                                        
                                        <div class="form-group">
                                            <tr>
                                                <th scope="col">
                                                    <label for="uCity">City</label>
                                                </th>
                                                <td>
                                                  <input type="text" class="form-control" name="user_city" id="user_city"
                                                    value="{{ Auth::user()->user_city }}" required>
                                                </td>
                                            </tr>
                                        </div>
                                        <div class="form-group">
                                            <tr>
                                                <th scope="col">
                                                    <label for="uZip">Zip Code</label>
                                                </th>
                                                <td>
                                                  <input type="number" class="form-control" name="user_zip" id="user_zip"
                                                    value="{{ Auth::user()->user_zip }}" required>
                                                </td>
                                            </tr>
                                        </div>
                                    </table>

                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


        <!-- modal -->



        <!-- <div class="row">
          <div class="col-lg">
            <div class="card mb-5 mb-md-0">
      
              <div class="card-body p-0">
                <ul class="list-group list-group-flush rounded-3">
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">  
                    <p class="mb-0"> IF OFFICER LOGIN DETAILS </p>
                  </li>

                  <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    
                    <p class="mb-0"> kayo na maglagay tinatamad na ko :) </p>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    
                    <p class="mb-0"> if may husto ilagay, ge lang :) </p>
                  </li>
                  
                </ul>
              </div>
            </div>
        
          </div> -->
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

