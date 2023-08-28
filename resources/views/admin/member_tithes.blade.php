@extends('layouts.DashB')
@section('content')

<section>
<div class="container-fluid">
<div class="row">
        <div class="col-lg-12 mt-4">
            <div class=" mb-0">
                <h4 class="font-weight-bolder text-white "> {{ $users->firstname }}'s Profile  </h4> 
            </div>
            <div class="no-gutters row">
                <div class="d-flex justify-content-between ">
                    <span class="text-left text-white"> @php  $dtae = date_default_timezone_set('Asia/Manila') @endphp {{  date('F j, Y g:i a  ') }} </span>
                </div>
            </div>
        </div>

    <div class="row mt-4 p-3">
      <div class="col-lg-4">
        <div class="card mb-4" id="profile_pic_church_member_view">
            <div class="p-4">
                <a href="/church_members">
                    <span id="goback_settings" class="text-gray">
                        <i class="las la-arrow-left" style="font-size: 22px"></i>
                        <span> 
                            GO BACK
                        </span> 
                    </span>                   
                </a>
            </div>
          <div class="card-body text-center">
            <img src="/users/{{$users->user_image}}" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3">{{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }}</h5>

            <p class="text-muted mb-1"> 
              @if ($users->user_type == 2)
                      Admin
              @elseif ($users->user_type == 1)
                      Co-Admin
              @else
                      Church Member
              @endif
            </p>

            <!-- <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-primary"> Upload Photo </button>
              <button type="button" class="btn btn-outline-primary ms-1"> </button> 
            </div> -->
          </div>
        </div>
        <div class="card mb-4 mb-lg-0" id="profile_login_activity_church_member_view">
        <div class="card-header">
        <h5 class="text-sm"> Log Activity </h5>
        </div>
          <div class="card-body p-0 keep-scrolling">
            @foreach($log_history  as $log_history)
              <div class="list-group mx-4" >
                <div class=" list-group-item-custom cursor-pointer list-group-item">
                    <div class="media">
                        <div class="media-body">
                            <div class="row my-2">
                            <div class="col-md-4">
                                <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate"> Last Active Date </p>
                                    <h6 class="text-gray  text-sm">
                                        <span class="text-truncate"> {{$log_history->created_at}} </span>
                                    </h6>
                            </div>
                            <div class="col text-end">
                              <h6 class="text-gray  text-xs mt-4">
                                  <span class="text-truncate" >{{$log_history->created_at->diffForHumans()}} 
                                    
                                  </span>
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
      
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body" id="profile_information_church_member_view">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> {{ $users->firstname }} {{ $users->middlename }} {{ $users->lastname }} </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Username</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $users->username }} </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $users->email }}</p>
              </div>
            </div>
            <hr>

            @php
                $phone = $users->user_mobile_number ;
                
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
                <p class="text-muted mb-0">{{ $users->user_street }}, {{ $users->user_barangay }}, {{ $users->user_city }}, {{ $users->user_zip }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Birthday</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $users->birthday }} </p>
              </div>
            </div>

            <br>

            <!-- @if ($users->user_type == '0')
              <div class="row">
                <div class="col-sm-3">
                    <a href="/edit/{{ $users->uID }}" class="dropdown-item">
                      <button type="button" class="btn btn-sm btn-success">Edit</button>
                    </a>
                </div>
              </div>
            @endif -->
          </div>
        </div>
        <div class="row">
          <div class="col-lg mx-2">
            <div class="card mb-5  mb-md-0">
              <div class="card-body">
              <form action="/member_tithes/{{ $users->uID }}" method="POST" enctype="multipart/form-data">
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
                                            <button type="submit" class="btn btn-success btn-sm" name="export_member_tithesPDF" target="_blank">
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
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

