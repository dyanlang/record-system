@php
use Carbon\Carbon;
$today =  Carbon::now()->format('d-m-Y');
@endphp
@extends('layouts.DashB')
@section('content') 


<div class="container-fluid overflow-hidden">
   
      <h4 class="font-weight-bolder text-white mb-0"> Home Dashboard / Analytics</h4>
      <h6 class=" text-white mb-2"> Month of {{ $Month }} </h6>  
        <div class="row" id="Dashboard"> 
          <!-- start -->
        <div class="col-xl-2 col-sm-6" >
          <div class="card">
            <div class="card-body p-3" id="card_membering_dashboard">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-xs mb-0 text-uppercase font-weight-bold text-truncate"> Members </p>
                        <h6 class="font-weight-bolder text-truncate"> {{ $members }} </h6>
                        <p class="mb-0 text-truncate">
                      
                          @if ($new_members <= '1')
                              <span class="text-success text-xs font-weight-bolder text-truncate">{{ $new_members }}</span> <h class="text-xs">new member</h> 
                          @else 
                              <span class="text-success text-xs font-weight-bolder text-truncate">+{{ $new_members }}</span> <h class="text-xs">new members</h> 
                          @endif
                          
                        
                        </p>
                         
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-primary shadow-secondary text-center ">
                      <i class="las la-users opacity-10" style="font-size:38px" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <!--  end -->
          <!-- start -->
          <div class="col-xl-2 col-sm-6" >
          <div class="card">
            <div class="card-body p-3" id="card_tithes_dashboard">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-xs mb-0 text-uppercase font-weight-bold text-truncate">Tithes </p>
                      <h6 class="font-weight-bolder text-truncate"> ₱{{$tithes_format}} </h6>
                     
                      <p class="mb-0 text-truncate">

                        @if ( $cur_tithes <= $prev_tithes)

                          <!-- Decreases -->
              
                          <span class="text-danger text-xs font-weight-bolder text-truncate">  <i class="fa fa-arrow-down text-danger"></i> {{ $percentage}}% </span>  

                        @else

                          <!-- Increases -->

                          <span class="text-success text-xs font-weight-bolder text-truncate">   <i class="fa fa-arrow-up text-success"></i>{{ $percentage}}% </span>
                        
                        @endif
                      </p>

                    </div>
                  </div>
                  <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center ">
                  <i class="las la-money-bill  opacity-10" style="font-size:40px" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          <!-- end -->
          <div class="col-xl-2 col-sm-6" >
          <div class="card">
            <div class="card-body p-3" id="card_offerings_offerings_dashboard">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-xs mb-0 text-uppercase font-weight-bold text-truncate">Offerings</p>
                    <h6 class="font-weight-bolder  text-truncate">
                        ₱{{ $offerings_format}}
                    </h6>
                    <p class="mb-0  text-truncate">

                      @if ( $cur_offerings <= $prev_offerings)

                        <!-- Decreases -->

                        <span class="text-danger text-xs font-weight-bolder">
                          <i class="fa fa-arrow-down text-danger"></i>
                          {{ $percentage1}}% 
                        </span>  

                      @else

                        <!-- Increases -->

                        <span class="text-success text-xs font-weight-bolder">
                          <i class="fa fa-arrow-up text-success"></i>
                          {{ $percentage1 }}%
                        </span>  

                        @endif
                    </p>

                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-info shadow-success text-center ">
                  <i class="las la-hand-holding-heart opacity-10" style="font-size:40px" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-2 col-sm-6 text-truncate">
          <div class="card" id="card_othergifts_dashboard">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-xs mb-0 text-uppercase font-weight-bold text-truncate">Other Gifts</p>
                    <h6 class="font-weight-bolder  text-truncate">
                        ₱{{ $other_gifts_format}}
                    </h6>
                    <p class="mb-0  text-truncate">

                      @if ( $cur_other_gifts <= $prev_other_gifts)

                        <!-- Decreases -->

                        <span class="text-danger text-xs font-weight-bolder">
                          <i class="fa fa-arrow-down text-danger"></i>
                          {{ $percentage2}}% 
                        </span>  

                      @else

                        <!-- Increases -->

                        <span class="text-success text-xs font-weight-bolder">
                          <i class="fa fa-arrow-up text-success"></i>
                          {{ $percentage2  }}%
                        </span>  

                        @endif
                    </p>

                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center ">
                  <i class="las la-gifts opacity-10" style="font-size:40px" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-2 col-sm-6 text-truncate" >
          <div class="card">
            <div class="card-body p-3" id="card_sabbath_dashboard">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-xs mb-0 text-uppercase font-weight-bold text-truncate">Sabbath Offerings </p>
                    <h6 class="font-weight-bolder">
                        ₱{{ $sabbath_format}}
                    </h6>
                    <p class="mb-0 text-truncate">

                      @if ( $cur_sabbath <= $prev_sabbath)

                        <!-- Decreases -->

                        <span class="text-danger text-xs font-weight-bolder">
                          <i class="fa fa-arrow-down text-danger"></i>
                          {{ $percentage_sabbath}}% 
                        </span>  

                      @else

                        <!-- Increases -->

                        <span class="text-success text-xs font-weight-bolder">
                          <i class="fa fa-arrow-up text-success"></i>
                          {{ $percentage_sabbath }}%
                        </span>  

                        @endif
                    </p>

                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-secondary shadow-success text-center ">
                  <i class="las la-coins opacity-10" style="font-size:40px" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-2 col-sm-6 text-truncate" >
          <div class="card">
            <div class="card-body p-3" id="card_totalaverage_dashboard">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-xs mb-0 text-uppercase font-weight-bold  text-truncate">Total Average </p>
                    <h6 class="font-weight-bolder">
    
                        ₱ {{   $Monthly_Total }} 
                    </h6>
                    <p class="mb-0 text-truncate">
                      
                      @if ( $Current_Month_Total <= $Prev_Month_Total)
                          <!-- Decreases -->
                          <span class="text-danger text-xs font-weight-bolder">
                            <i class="fa fa-arrow-down text-danger"></i>
                              {{ $Current_Percentage}}%
                          </span>  

                      @else
                          <!-- Increases -->
                          <span class="text-success text-xs font-weight-bolder">
                            <i class="fa fa-arrow-up text-success"></i>
                            {{ $Current_Percentage}}%
                          </span>  
                      @endif                        
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center ">
                  <i class="las la-money-check opacity-10" style="font-size:40px" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="row mt-4">
        <div class="col-lg-8">
          <div class="card" id="card_monthly_average_dashboard">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-md mb-0 text-uppercase font-weight-bold">
                <i class="ni ni-chart-bar-32"></i> Monthly Average </h6>
            </div>

            <div class="card-body"> 
              <div class="chart">
                <canvas id="monthly-line" class="chart-canvas" height="250"></canvas>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card" id="card_tithes_overview_dashboard">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-md mb-0 text-uppercase font-weight-bold">
                <i class="ni ni-chart-bar-32"></i> Tithes Overview </h6>
            </div>

            <div class="card-body"> 
              <div class="chart">
                <canvas id="tithes-line" class="chart-canvas" height="250"></canvas>
              </div>
            </div>
          </div>
        </div>
    </div>
       
 

          
      <div class="row mt-4">
        <div class="col-lg-4">  
          <div class="card" id="card_offerings_overview_dashboard">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-md mb-0 text-uppercase font-weight-bold"><i class="ni ni-chart-bar-32"></i> Offerings Overview </h6>
            </div>
            <div class="card-body" >
              <div class="chart"> 
                <canvas id="offering-line" class="chart-canvas" height="250"></canvas>
              </div>
            </div>
          </div>
        </div>


        <div class="col-lg-4">
          <div class="card" id="card_others_overview_dashboard">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-md mb-0 text-uppercase font-weight-bold">
                <i class="ni ni-chart-bar-32"></i> Others Overview </h6>
            </div>

            <div class="card-body"> 
              <div class="chart">
                <canvas id="others-line" class="chart-canvas" height="250"></canvas>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card" id="card_sabbath_overview_dashboard">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-md mb-0 text-uppercase font-weight-bold">
                <i class="ni ni-chart-bar-32"></i> Sabbath Offerings Overview </h6>
            </div>

            <div class="card-body"> 
              <div class="chart">
                <canvas id="sabbath-line" class="chart-canvas" height="250"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="row mt-4">
        <div class="col-lg-6 mb-lg-0 ">
          <div class="card" id="card_disbursement_overview_dashboard">
            <div class="card-header">
              <h6 class="text-sm mb-0 text-uppercase font-weight-bold">
                <i class="las la-chart-pie" style="font-size: 24px"  ></i> Disbursement Overview </h6>
            </div>

            <div class="card-body">
              <div class="chart-container"> 
                <canvas id="chart-bars" class="chart-canvas" min-width="100%" height="378" ></canvas>
              </div>
            </div> 
          </div> 
        </div>
    

      <div class="col-lg-6">
        <div class="card" id="card_recent_disbursement_dashboard">
          <div class="card-header pb-3">
            <div class="row">
              <div class="col">
                <h6  class="text-sm mb-0 text-uppercase font-weight-bold"><i class="las la-donate" style="font-size: 24px;"></i> Recent Disbursement </h6>
              </div>
              <div class="col-6 text-end"><a href="/disbursement_report" id="card_view_all_disbursement_dashboard">
                <p class="text-sm  text-success ">View All <i class="las la-angle-double-right"></i></p> </a>
              </div>
            </div>
          </div>
          <div class="card-body keep-scrolling-1 pb-4">
              @if($disbursement->count() > 0)
                @foreach ($disbursement as $disbursements)
                  <div class="list-group">
                    <div class=" list-group-item-custom cursor-pointer list-group-item">
                      <div class="media">
                        <div class="media-body">
                          <div class="row">
            
                            <div class="col-md-4 text-truncate">
                              <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Department </p>
                              <span>
                                <p class="text-sm text-truncate">  
                               @if($disbursements->disbursement_purpose == 'Childrens department')
                                  Children's Department
                              @elseif($disbursements->disbursement_purpose == 'Womens department')
                                  Women's department
                              @else
                                  {{  $disbursements->disbursement_purpose}}  
                               @endif
                                </p>                                 
                            </div>

                            <div class="col-md-3 text-truncate">
                              <p class="mb-1 text-xs text-color-gray-lighter gotham-book text-truncate"> Amount </p>
                              <span><p class="text-sm text-truncate">   ₱ {{ $disbursements->disbursement_amount }} </h6></span>
                            </div>

                            <div class="col-md-3 text-truncate">
                              <p class="mb-1  text-xs text-color-gray-lighter gotham-book">Status</p>
                              <h6 class="text-xs">
                                @if($disbursements->disbursement_type_status == 'Pending') 
                                    <span  class="badge badge-xs bg-gradient-warning"> Pending </span>

                                @elseif($disbursements->disbursement_type_status == 'Needs Review') 
                                    <span  class="badge badge-xs bg-gradient-info"> Needs Review </span>

                                @elseif($disbursements->disbursement_type_status == 'Approved')   
                                    <span  class="badge badge-xs bg-gradient-success"> Approved </span>
              
                                @else
                                    <span  class="badge badge-xs bg-gradient-secondary text-truncate"> {{ $disbursements->disbursement_type_status}} </span>
                                @endif
                              </h6>
                            </div>
                            <div class="col text-truncate">
                              <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Date </p>
                              <span><p class="text-xs text-truncate">

                              @php $today = date("Y-m-d H:i:s")  @endphp

                                {{$disbursements->created_at->diffForHumans()}} 
                            </p></span>
                            </div>


                            <div class="d-flex justify-content-end align-items-center col-sm-1">
                              <div class="d-flex justify-content-end align-items-start">
                                <div class="dropdown"> 
                                  <a class="text-black px-0" type="btn" id="dropdownMenuButton2" data-bs-toggle="dropdown">
                                    <i class="las la-ellipsis-v" style="font-size: 20px; font-weight: bolder"></i>
                                  </a>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <li>
                                      <a class="dropdown-item" href="/disbursement_view/{{ $disbursements->dsID }}">  
                                        <i class="las la-door-open"  style="font-size: 20px"></i> 
                                        <span> VIEW </span> 
                                      </a>
                                    </li>
                                  </ul>
                                </div> 
                              </div>
                            </div>  
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              @endforeach 
              @else
              <center>
                  <div class="text-gray my-8 mx-auto"> 
                      <h4 class="opacity-2"> There's no recent activities here. </h4>
                  </div>
              </center>
            @endif
            </div> 
          </div>
      </div> 
  </div>


  <!--  -->
  
  <div class="row" id="Contributors">
    <div class="col-span-12 col-sm-2 ">
      <div class="">
              <h6  class="text-sm mb-1 text-uppercase font-weight-bold m-3">
                
                <i class="las la-chalkboard" style="font-size: 24px;"></i> Summary </h6>

        <div class="">  
        
    

        <div class="list-group mt-2 col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box px-5 py-3">
                    <div class="row">
                      <div class="col"> 
                        <div class="text-3xl font-medium text-center leading-8"> {{ $lapsed_count}} </div>
                        <div class="text-base  text-center text-xs text-slate-500 mt-1 text-truncate">  Lapsed Contributors </div>
                      </div>
                    </div> 
                </div>
            </div>
        </div>

        <div class="list-group mt-2 col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box px-5 py-3">
                   <div class="row">
                      <div class="col"> 
                        <div class="text-3xl font-medium text-center leading-8"> {{ $recent_count}} </div>
                        <div class="text-base  text-center text-xs text-slate-500 mt-1 text-truncate">  Recent Contributors </div>
                      </div>
                    </div> 
                </div>
            </div>
        </div>

        <div class="list-group mt-2 col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box px-5 py-3">
                   <div class="row">
                      <div class="col"> 
                      <div class="text-3xl font-medium text-center leading-8"> {{$frequent_count}} </div>
                        <div class="text-base  text-center text-xs text-slate-500 mt-1 text-truncate">  Frequent Contributors </div>
                      </div>
                    </div> 
                </div>
            </div>
        </div>

        
        <div class="list-group mt-2 col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box px-5 py-3">
                   <div class="row">
                      <div class="col"> 
                      <div class="text-3xl font-medium text-center leading-8"> {{$first_time_count}} </div>
                      <div class="text-base  text-center text-xs text-slate-500 mt-1 text-truncate">  First-time Contributors </div>
                      </div>
                    </div> 
                </div>
            </div>
        </div>
      </div>    
    </div> 
  </div>

      <!--  -->
  
    <div class="col-md-5">
      <div class="card mt-4 p-1" id="card_first_contributor_dashboard">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col">
              <h6  class="text-sm mb-1 text-uppercase font-weight-bold">
                <i class="las la-users" style="font-size: 24px;"></i> First-time Contributors </h6>
            </div>
          </div>
        </div>
        <div class="card-body keep-scrolling">          
          @if($first_time->count() > 0)
            @foreach ($first_time as $officers)
              <div class="list-group">
                <div class=" list-group-item-custom cursor-pointer list-group-item">
                  <div class="media">
                    <div class="media-body">
                      <div class="row">
                        <div class="col-7">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column px-1">
                              <img src="/users/{{$officers->user_image}}" class="rounded-circle img-fluid" width="40" alt="">  
                          </div>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">
                              {{$officers->firstname}}   {{$officers->lastname}}
                            </h6>
                            <h6 class="text-sm mb-0 px-1"> 
                                @if ($officers->user_type == '2') 
                                 <span class="text-xs  text-color-gray-lighter gotham-book">  Admin  </span>
                                @elseif ($officers->user_type == '1') 
                                <span class="text-xs  text-color-gray-lighter gotham-book">  Co-Admin  </span>
                                @endif
                            </h6>
                          </div>
                          </div>
                        </div>

                        <div class="col  text-truncate">
                          <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Date </p>
                          <span><p class="text-xs text-truncate">  {{ $officers->created_at->diffForHumans()}}</h6></span>
                        </div>
                  
                      <div class="d-flex justify-content-end align-items-center col">
                              <div class="d-flex justify-content-end align-items-start">
                                <div class="dropdown"> 
                                  <a class="text-black px-1" type="btn" id="dropdownMenuButton2" data-bs-toggle="dropdown">
                                    <i class="las la-ellipsis-v" style="font-size: 20px; font-weight: bolder"></i>
                                  </a>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <li>
                                      <a class="dropdown-item" href="/member_tithes/{{ $officers->member_ID}}">  
                                        <i class="las la-door-open"  style="font-size: 25px"></i> 
                                        <span> VIEW </span> 
                                      </a>
                                    </li>
                                  </ul>
                                </div> 
                              </div>
                            </div>  
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach 
              @else
              <center>
                  <div class="text-gray my-10 mx-auto "> 
                      <h4 class="opacity-2"> There's no recent activities here. </h4>
                  </div>
              </center>
            @endif
            </div> 
          </div>
      </div> 

      <!--  -->

    <div class="col-md-5">
      <div class="card mt-4 p-1" id="card_recent_contributor_dashboard">
      <div class="card-header pb-0">
          <div class="row">
            <div class="col">
              <h6  class="text-sm mb-1 text-uppercase font-weight-bold">
                <i class="las la-users" style="font-size: 24px;"></i> Recent Contributors </h6>
            </div>
          </div>
        </div>
        <div class="card-body  keep-scrolling" >
          @if($recent_contribution->count() > 0)
            @foreach ($recent_contribution as $officers)
              <div class="list-group">
                <div class=" list-group-item-custom cursor-pointer list-group-item">
                  <div class="media">
                    <div class="media-body">
                      <div class="row">
                        <div class="col-7">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column px-1">
                              <img src="/users/{{$officers->user_image}}" class="rounded-circle img-fluid" width="40" alt="">  
                          </div>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">
                              {{$officers->firstname}}   {{$officers->lastname}}
                            </h6>
                            <h6 class="text-sm mb-0 px-1"> 
                                @if ($officers->user_type == '2') 
                                 <span class="text-xs  text-color-gray-lighter gotham-book">  Admin  </span>
                                @elseif ($officers->user_type == '1') 
                                <span class="text-xs  text-color-gray-lighter gotham-book">  Co-Admin  </span>
                                @endif
                            </h6>
                          </div>
                          </div>
                        </div>

                        <div class="col">
                          <p class="mb-1 text-xs text-color-gray-lighter gotham-book">  Date  </p>
                          <span><p class="text-xs text-truncate">  {{ $officers->updated_at->diffForHumans()}}</h6></span>
                        </div>
                  
                      <div class="d-flex justify-content-end align-items-center col">
                              <div class="d-flex justify-content-end align-items-start">
                                <div class="dropdown"> 
                                  <a class="text-black px-1" type="btn" id="dropdownMenuButton2" data-bs-toggle="dropdown">
                                    <i class="las la-ellipsis-v" style="font-size: 20px; font-weight: bolder"></i>
                                  </a>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <li>
                                       <a class="dropdown-item" href="/member_tithes/{{ $officers->member_ID}}">  
                                        <i class="las la-door-open"  style="font-size: 25px"></i> 
                                        <span> VIEW </span> 
                                      </a>
                                    </li>
                                  </ul>
                                </div> 
                              </div>
                            </div>  
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach 
              @else
              <center>
                  <div class="text-gray my-10 mx-auto "> 
                      <h4 class="opacity-2"> There's no recent activities here. </h4>
                  </div>
              </center>
            @endif
            </div> 
          </div>
          </div>



      <!--  -->
  <div class="row mt-4">
    <div class="col-lg-6">
      <div class="card" id="card_frequent_contributor_dashboard">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col ">
              <h6  class="text-sm mb-1 text-uppercase font-weight-bold">
                <i class="las la-user-friends" style="font-size: 24px;"></i> Frequent Contributors  </h6>
            </div>
          </div>
        </div>
        <div class="card-body keep-scrolling" >          
        @if($frequent->count() > 0)
            @foreach ($frequent  as $officers)
          
              <div class="list-group">
                <div class=" list-group-item-custom cursor-pointer list-group-item">
                  <div class="media">
                    <div class="media-body">
                      <div class="row">
                        <div class="col-7">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column px-1">
                              <img src="/users/{{$officers->user_image}}" class="rounded-circle img-fluid" width="40" alt="">  
                          </div>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">
                              {{$officers->firstname}}   {{$officers->lastname}}
                            </h6>
                            <h6 class="text-sm mb-0 px-1"> 
                                @if ($officers->user_type == '2') 
                                 <span class="text-xs  text-color-gray-lighter gotham-book">  Admin  </span>
                                @elseif ($officers->user_type == '1') 
                                <span class="text-xs  text-color-gray-lighter gotham-book">  Co-Admin  </span>
                                @endif
                            </h6>
                          </div>
                          </div>
                        </div>

                        <div class="col  text-truncate ">
                          <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Last Contribution </p>
                          <span><p class="text-xs text-truncate">  {{ $officers->updated_at->diffForHumans()}}</h6></span>
                        </div>
                  
                      <div class="d-flex justify-content-end align-items-center col">
                              <div class="d-flex justify-content-end align-items-start">
                                <div class="dropdown"> 
                                  <a class="text-black px-1" type="btn" id="dropdownMenuButton2" data-bs-toggle="dropdown">
                                    <i class="las la-ellipsis-v" style="font-size: 20px; font-weight: bolder"></i>
                                  </a>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <li>
                                      <a class="dropdown-item"  href="/member_tithes/{{ $officers->member_ID}}">  
                                        <i class="las la-door-open"  style="font-size: 25px"></i> 
                                        <span> VIEW </span> 
                                      </a>
                                    </li>
                                  </ul>
                                </div> 
                              </div>
                            </div>  
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              @endforeach 
              @else
              <center>
                  <div class="text-gray my-10 mx-auto "> 
                      <h4 class="opacity-2"> There's no recent activities here. </h4>
                  </div>
              </center>
            @endif
            </div> 
          </div>
      </div> 



      <div class="col-lg-6">
      <div class="card" id="card_lapsed_contributor_dashboard">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col">
              <h6  class="text-sm mb-1 text-uppercase font-weight-bold">
                <i class="las la-user-friends" style="font-size: 24px;"></i> Lapsed Contributors  </h6>
            </div>
          </div>
        </div>
        <div class="card-body keep-scrolling">          
       
        @if($lapsed->count() > 0)
            @foreach ($lapsed as $officers)
          
              <div class="list-group">
                <div class=" list-group-item-custom cursor-pointer list-group-item">
                  <div class="media">
                    <div class="media-body">
                      <div class="row">
                        <div class="col-7">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column px-1">
                              <img src="/users/{{$officers->user_image}}" class="rounded-circle img-fluid" width="40" alt="">  
                          </div>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">
                              {{$officers->firstname}}   {{$officers->lastname}}
                            </h6>
                            <h6 class="text-sm mb-0 px-1"> 
                                @if ($officers->user_type == '2') 
                                 <span class="text-xs  text-color-gray-lighter gotham-book">  Admin  </span>
                                @elseif ($officers->user_type == '1') 
                                <span class="text-xs  text-color-gray-lighter gotham-book">  Co-Admin  </span>
                                @endif
                            </h6>
                          </div>
                          </div>
                        </div>

                        <div class="col  text-truncate ">
                          <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Last Contribution </p>
                          <span><p class="text-xs text-truncate">  {{ $officers->updated_at->diffForHumans()}}</h6></span>
                        </div>
                  
                      <div class="d-flex justify-content-end align-items-center col">
                              <div class="d-flex justify-content-end align-items-start">
                                <div class="dropdown"> 
                                  <a class="text-black px-1" type="btn" id="dropdownMenuButton2" data-bs-toggle="dropdown">
                                    <i class="las la-ellipsis-v" style="font-size: 20px; font-weight: bolder"></i>
                                  </a>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <li>
                                       <a class="dropdown-item" href="/member_tithes/{{ $officers->member_ID}}">  
                                        <i class="las la-door-open"  style="font-size: 25px"></i> 
                                        <span> VIEW </span> 
                                      </a>
                                    </li>
                                  </ul>
                                </div> 
                              </div>
                            </div>  
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              @endforeach 

              @foreach ($never_contribute as $officers)
          
          <div class="list-group">
            <div class=" list-group-item-custom cursor-pointer list-group-item">
              <div class="media">
                <div class="media-body">
                  <div class="row">
                    <div class="col-7">
                    <div class="d-flex align-items-center">
                      <div class="d-flex flex-column px-1">
                          <img src="/users/{{$officers->user_image}}" class="rounded-circle img-fluid" width="40" alt="">  
                      </div>
                      <div class="d-flex flex-column">
                        <h6 class="mb-1 text-dark text-sm">
                          {{$officers->firstname}}   {{$officers->lastname}}
                        </h6>
                        <h6 class="text-sm mb-0 px-1"> 
                            @if ($officers->user_type == '2') 
                             <span class="text-xs  text-color-gray-lighter gotham-book">  Admin  </span>
                            @elseif ($officers->user_type == '1') 
                            <span class="text-xs  text-color-gray-lighter gotham-book">  Co-Admin  </span>
                            @endif
                        </h6>
                      </div>
                      </div>
                    </div>

                    <div class="col  text-truncate ">
                      <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Last Contribution </p>
                      <span><p class="text-xs text-truncate">  {{ $officers->updated_at->diffForHumans()}}</h6></span>
                    </div>
              
                  <div class="d-flex justify-content-end align-items-center col">
                          <div class="d-flex justify-content-end align-items-start">
                            <div class="dropdown"> 
                              <a class="text-black px-1" type="btn" id="dropdownMenuButton2" data-bs-toggle="dropdown">
                                <i class="las la-ellipsis-v" style="font-size: 20px; font-weight: bolder"></i>
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <li>
                                   <a class="dropdown-item" href="/member_tithes/{{ $officers->uID}}">  
                                    <i class="las la-door-open"  style="font-size: 25px"></i> 
                                    <span> VIEW </span> 
                                  </a>
                                </li>
                              </ul>
                            </div> 
                          </div>
                        </div>  
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          @endforeach 
              @else
              <center>
                  <div class="text-gray my-10 mx-auto "> 
                      <h4 class="opacity-2"> There's no recent activities here. </h4>
                  </div>
              </center>
            @endif
            </div> 
          </div>
      </div> 
</div>

      <!--  -->

      
<div class="row mt-4">
    <div class="col-lg-4">
      <div class="card" id="card_officer_dashboard">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col">
              <h6  class="text-sm mb-1 text-uppercase font-weight-bold">
                <i class="las la-user-friends" style="font-size: 24px;"></i> Officers  </h6>
            </div>
          </div>
        </div>
        <div class="card-body keep-scrolling">          
          @if($user->count() > 0)
            @foreach ($user as $officers)
            @if($officers->user_type  == '2'|| $officers->user_type == '1' )
              <div class="list-group">
                <div class=" list-group-item-custom cursor-pointer list-group-item">
                  <div class="media">
                    <div class="media-body">
                      <div class="row">
                        <div class="col-7">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column px-1">
                              <img src="/users/{{$officers->user_image}}" class="rounded-circle img-fluid" width="40" alt="">  
                          </div>
                          <div class="d-flex flex-column ">
                            <h6 class="mb-1 text-dark text-sm">
                              {{$officers->firstname}}   {{$officers->lastname}}
                            </h6>
                            <h6 class="text-sm mb-0 px-1"> 
                                @if ($officers->user_type == '2') 
                                 <span class="text-xs  text-color-gray-lighter gotham-book">  Admin  </span>
                                @elseif ($officers->user_type == '1') 
                                <span class="text-xs  text-color-gray-lighter gotham-book">  Co-Admin  </span>
                                @endif
                            </h6>
                          </div>
                          </div>
                        </div>

                        <div class="col  text-truncate">
                          <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Date Joined </p>
                          <span><p class="text-xs text-truncate">  
                            {{ $officers->created_at->diffForHumans()}}
                        

                          </h6></span>
                        </div>
                  
                      <div class="d-flex justify-content-end align-items-center col">
                              <div class="d-flex justify-content-end align-items-start">
                                <div class="dropdown"> 
                                  <a class="text-black px-1" type="btn" id="dropdownMenuButton2" data-bs-toggle="dropdown">
                                    <i class="las la-ellipsis-v" style="font-size: 20px; font-weight: bolder"></i>
                                  </a>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <li>
                                     <a class="dropdown-item" href="/member_tithes/{{ $officers->uID}}">  
                                        <i class="las la-door-open"  style="font-size: 25px"></i> 
                                        <span> VIEW </span> 
                                      </a>
                                    </li>
                                  </ul>
                                </div> 
                              </div>
                            </div>  
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                @endforeach 
              @else
              <center>
                  <div class="text-gray my-10 mx-auto "> 
                      <h4 class="opacity-2"> There's no recent activities here. </h4>
                  </div>
              </center>
            @endif
            </div> 
          </div>
      </div> 

    <div class="col-lg-4">
      <div class="card" id="card_members_members_dashboard">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col">
              <h6  class="text-sm mb-1 text-uppercase font-weight-bold">
                <i class="las la-user-friends" style="font-size: 24px;"></i> Members  </h6>
            </div>
          </div>
        </div>
        <div class="card-body keep-scrolling" >          
          @if($user->count() > 0)
            @foreach ($user as $officers)
            @if($officers->user_type == '0' )

              <div class="list-group">
                <div class=" list-group-item-custom cursor-pointer list-group-item">
                  <div class="media">
                    <div class="media-body">
                      <div class="row">
                        <div class="col-7">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column px-0">
                              <img src="/users/{{$officers->user_image}}" class="rounded-circle img-fluid" width="40" alt="">  
                          </div>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">
                              {{$officers->firstname}}   {{$officers->lastname}}
                            </h6>
                            <h6 class="text-sm mb-0 px-1"> 
                                @if ($officers->user_type == '0') 
                                 <span class="text-xs  text-color-gray-lighter gotham-book">  Member  </span>
                                @elseif ($officers->user_type == '1') 
                                <span class="text-xs  text-color-gray-lighter gotham-book">  Co-Admin  </span>
                                @endif
                            </h6>
                          </div>
                          </div>
                        </div>

                        <div class="col text-truncate">
                          <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Date Joined </p>
                          <span><p class="text-xs text-truncate">  

                       
                          {{ $officers->created_at->diffForHumans()}}   
                        
                          </h6></span>
                        </div>
                  
                      <div class="d-flex justify-content-end align-items-center col-sm-1">
                              <div class="d-flex justify-content-end align-items-start">
                                <div class="dropdown"> 
                                  <a class="text-black px-0" type="btn" id="dropdownMenuButton2" data-bs-toggle="dropdown">
                                    <i class="las la-ellipsis-v" style="font-size: 20px; font-weight: bolder"></i>
                                  </a>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <li>
                                       <a class="dropdown-item" href="/member_tithes/{{ $officers->uID}}">  
                                        <i class="las la-door-open"  style="font-size: 25px"></i> 
                                        <span> VIEW </span> 
                                      </a>
                                    </li>
                                  </ul>
                                </div> 
                              </div>
                            </div>  
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                @endforeach 
              @else
              <center>
                  <div class="text-gray my-10 mx-auto "> 
                      <h4 class="opacity-2"> There's no recent activities here. </h4>
                  </div>
              </center>
            @endif
            </div> 
          </div>
      </div> 

      <div class="col-lg-4">
      <div class="card" id="card_user_activity_dashboard">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col">
              <h6  class="text-sm mb-1 text-uppercase font-weight-bold">
                <i class="las la-user-friends" style="font-size: 24px;"></i> Users Activity  </h6>
            </div>
          </div>
        </div>
        <div class="card-body keep-scrolling" >          
          @if($user_activity->count() > 0)
            @foreach ($user_activity as $officers)
              <div class="list-group">
                <div class=" list-group-item-custom cursor-pointer list-group-item">
                  <div class="media">
                    <div class="media-body">
                      <div class="row">
                        <div class="col-7">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column px-1">
                              <img src="/users/{{$officers->user_image}}" class="rounded-circle img-fluid" width="40" alt="">  
                          </div>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">
                              {{$officers->firstname}}   {{$officers->lastname}}
                            </h6>
                            <h6 class="text-sm mb-0 px-1"> 
                                @if ($officers->user_type == '0') 
                                 <span class="text-xs  text-color-gray-lighter gotham-book">  Member  </span>
                                @elseif ($officers->user_type == '1') 
                                <span class="text-xs  text-color-gray-lighter gotham-book">  Co-Admin  </span>
                                @endif
                            </h6>
                          </div>
                          </div>
                        </div>

                        <div class="col text-truncate">
                          <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Activity </p>
                          <span><p class="text-xs">  

                       
                         <!-- @if( $officers->logSTAT == '1')
                          
                                 <span  class="badge badge-sm bg-gradient-success">  active  </span> </h6>
                          @else
                                {{ $officers->created_at->diffForHumans()}}   

                          @endif -->

                          @if(Cache::has('user-is-online-' .$officers->uID))
                            <span class="text-success">Online</span>
                          @else
                              <span class="text-secondary">   

                              {{ \Carbon\Carbon::parse($officers->user_activity)->diffForHumans() }}
                              </span>
                          @endif
                        
                          </h6></span>
                        </div>
                  
                      <div class="d-flex justify-content-end align-items-center col">
                              <div class="d-flex justify-content-end align-items-start">
                                <div class="dropdown"> 
                                  <a class="text-black px-0" type="btn" id="dropdownMenuButton2" data-bs-toggle="dropdown">
                                    <i class="las la-ellipsis-v" style="font-size: 20px; font-weight: bolder"></i>
                                  </a>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <li>
                                       <a class="dropdown-item" href="/member_tithes/{{ $officers->uID}}">  
                                        <i class="las la-door-open"  style="font-size: 25px"></i> 
                                        <span> VIEW </span> 
                                      </a>
                                    </li>
                                  </ul>
                                </div> 
                              </div>
                            </div>  
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach 
              @else
              <center>
                  <div class="text-gray my-10 mx-auto "> 
                      <h4 class="opacity-2"> There's no recent activities here. </h4>
                  </div>
              </center>
            @endif
            </div> 
          </div>
      </div> 
      
    </div>
          

</div>


<script src="../assets/js/plugins/chartjs.min.js"></script>
 
  <script>

        var ctx1 = document.getElementById("monthly-line").getContext("2d"); 
        var gradientStroke1 = ctx1.createLinearGradient(0, 0, 0, 50);
             
              
              new Chart(ctx1, {
                type: "line",
                data: {
                  labels: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ],
                  datasets: [{
                    label: "Monthly Total",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "rgb(91,219,210)",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [ {{$MONTH_JAN}},{{ $MONTH_FEB}}, {{$MONTH_MAR}}, {{$MONTH_APR}},{{ $MONTH_MAY}},{{ $MONTH_JUN}},
                            {{$MONTH_JUL}},{{ $MONTH_AUG}}, {{$MONTH_SEP}}, {{$MONTH_OCT}}, {{$MONTH_NOV}} , {{$MONTH_DEC}} 
                         ],
                    maxBarThickness: 6
              
                  },

                  {
                    label: "Monthly Average",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "rgb(139,0,0)",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                 
                    data: [ 
                        {{$JAN_TOTAL_AVE}}, {{ $FEB_TOTAL_AVE}}, {{$MAR_TOTAL_AVE}}, {{$APR_TOTAL_AVE}},{{ $MAY_TOTAL_AVE}},{{ $JUN_TOTAL_AVE}}, {{$JUL_TOTAL_AVE}},{{ $AUG_TOTAL_AVE}},
                        {{$SEP_TOTAL_AVE}}, {{$OCT_TOTAL_AVE}}, {{$NOV_TOTAL_AVE}} , {{$DEC_TOTAL_AVE}}  ],
                    maxBarThickness: 6
              
                  },

                  {
                    label: "Monthly Disbursement",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "rgb(20,93,62)",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
     
                    data: [ {{$disbursement_JAN}},{{ $disbursement_FEB}}, {{$disbursement_MAR}},{{ $disbursement_APR}}, {{$disbursement_MAY}},{{ $disbursement_JUN}},
                            {{ $disbursement_JUL}}, {{$disbursement_AUG}},{{ $disbursement_SEP}}, {{$disbursement_OCT}}, {{$disbursement_NOV}}, {{$disbursement_DEC}}  ],
                    maxBarThickness: 6
              
                  }],

                  
                },
                options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                    legend: {
                      display: true,
                    }
                  },
                  interaction: {
                    intersect: false,
                    mode: 'index',
                  },
                  scales: {
                    y: {
                      grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        color: "gray",
                        borderDash: [5, 5]
                      },
                      ticks: {
                        display: true,
                        padding: 10,
                        color: 'gray',
                        font: {
                          size: 10,
                          family: "Open Sans",
                          style: 'normal',
                          lineHeight: 2
                        },
                      }  
                    },
                    x: {
                      grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 7]
                      },
                      ticks: {
                        display: true,
                        color: "gray",
                        padding: 10,
                        font: {
                          size: 9,
                          family: "Open Sans",
                          style: 'normal',
                          lineHeight: 2
                        },
                      }
                    },
                  },
                },
              });
              
</script>


<!-- tithes-overview -->
 <script>

        var ctx1 = document.getElementById("tithes-line").getContext("2d"); 
        var gradientStroke1 = ctx1.createLinearGradient(0, 0, 0, 50);
             
              
              new Chart(ctx1, {
                type: "line",
                data: {
                  labels: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ],
                  datasets: [{
                    label: "Tithes",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "rgba(4, 147, 114)",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [ {{$JAN}},{{ $FEB}}, {{$MAR}},{{ $APR}}, {{$MAY}},{{ $JUN}},{{ $JUL}}, {{$AUG}},{{ $SEP}}, {{$OCT}}, {{$NOV}}, {{$DEC}}  ],
                    maxBarThickness: 6
              
                  }],
                },
                options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                    legend: {
                      display: true,
                    }
                  },
                  interaction: {
                    intersect: false,
                    mode: 'index',
                  },
                  scales: {
                    y: {
                      grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        color: "gray",
                        borderDash: [5, 5]
                      },
                      ticks: {
                        display: true,
                        padding: 10,
                        color: 'gray',
                        font: {
                          size: 10,
                          family: "Open Sans",
                          style: 'normal',
                          lineHeight: 2
                        },
                      }  
                    },
                    x: {
                      grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 7]
                      },
                      ticks: {
                        display: true,
                        color: "gray",
                        padding: 10,
                        font: {
                          size: 9,
                          family: "Open Sans",
                          style: 'normal',
                          lineHeight: 2
                        },
                      }
                    },
                  },
                },
              });
              
</script>

<!-- Offering-overview -->
<script>
     
        var ctx3 = document.getElementById("offering-line").getContext("2d");
        var gradientStroke1 = ctx3.createLinearGradient(0, 0, 0, 50);        
         
        
            new Chart(ctx3, {
                type: "line",
                data: {
                  labels: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ],
                  datasets: [{
                    label: "Offerings",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "rgba(4, 120, 168)",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [ {{$JAN1}},{{ $FEB2 }}, {{$MAR3 }},{{ $APR4 }}, {{$MAY5}},{{ $JUN6 }},{{ $JUL7 }}, {{$AUG8 }},{{ $SEP9 }}, {{$OCT10 }}, {{$NOV11 }}, {{$DEC12}}  ],
                    maxBarThickness: 6
              
                  }],
                },
                options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                    legend: {
                      display: true,
                    }
                  },
                  interaction: {
                    intersect: false,
                    mode: 'index',
                  },
                  scales: {
                    y: {
                      grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        color: "gray",
                        borderDash: [5, 5]
                      },
                      ticks: {
                        display: true,
                        padding: 10,
                        color: 'gray',
                        font: {
                          size: 10,
                          family: "Open Sans",
                          style: 'normal',
                          lineHeight: 2
                        },
                      }  
                    },
                    x: {
                      grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 7]
                      },
                      ticks: {
                        display: true,
                        color: "gray",
                        padding: 10,
                        font: {
                          size: 9,
                          family: "Open Sans",
                          style: 'normal',
                          lineHeight: 2
                        },
                      }
                    },
                  },
                },
              });
        
</script>

<!-- Other Gifts -->


<script>
     
        var ctx4 = document.getElementById("others-line").getContext("2d");
        var gradientStroke1 = ctx3.createLinearGradient(0, 0, 0, 50);        
      
        
        new Chart(ctx4, {
          type: "line",
          data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
               label: "Other Gifts",
                borderColor: 'rgb(8, 194, 141)',
                tension: 0.1,
                borderWidth: 0,
                pointRadius: 0,
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: [ {{$JAN01}},{{ $FEB02}}, {{$MAR03}},{{ $APR04}}, {{$MAY05}},{{ $JUN06}},{{ $JUL07}}, {{$AUG08}},{{ $SEP09}}, {{$OCT010}}, {{$NOV011}}, {{$DEC012}}  ],
                maxBarThickness: 6
          
            }],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: true,
              }
            },
            interaction: {
              intersect: false,
              mode: 'index',
            },
            scales: {
              y: {
                grid: {
                  drawBorder: false,
                  display: true,
                  drawOnChartArea: true,
                  drawTicks: false,
                  color: "gray",
                  borderDash: [5, 5]
                },
                ticks: {
                  display: true,
                  padding: 10,
                  color: "gray",
                  font: {
                    size: 10,
                    family: "Gothic Sans",
                    style: 'normal',
                    lineHeight: 2
                  },
                }  
              },
              x: {
                grid: {
                  drawBorder: false,
                  display: false,
                  drawOnChartArea: false,
                  drawTicks: false,
                  borderDash: [5, 7]
                },
                ticks: {
                  display: true,
                  color: "gray",
                  padding: 10,
                  font: {
                    size: 9,
                    family: "Open Sans",
                    style: 'normal',
                    lineHeight: 2
                  },
                }
              },
            },
          },
        });
        
</script>


<!-- Sabbath -->


<script>
     
        var ctx4 = document.getElementById("sabbath-line").getContext("2d");
        var gradientStroke1 = ctx3.createLinearGradient(0, 0, 0, 50);        
      
        
        new Chart(ctx4, {
          type: "line",
          data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
               label: "Sabbath Offerings",
                borderColor: 'rgb(8, 194, 11)',
                tension: 0.1,
                borderWidth: 0,
                pointRadius: 0,
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: [ {{$Sabbath_JAN1}},{{ $Sabbath_FEB2}}, {{$Sabbath_MAR3}},{{ $Sabbath_APR4}}, {{$Sabbath_MAY5}},{{ $Sabbath_JUN6}},{{ $Sabbath_JUL7}}, {{$Sabbath_AUG8}},{{ $Sabbath_SEP9}}, {{$Sabbath_OCT10}}, {{$Sabbath_NOV11}}, {{$Sabbath_DEC12}}  ],
                maxBarThickness: 6
          
            }],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: true,
              }
            },
            interaction: {
              intersect: false,
              mode: 'index',
            },
            scales: {
              y: {
                grid: {
                  drawBorder: false,
                  display: true,
                  drawOnChartArea: true,
                  drawTicks: false,
                  color: "gray",
                  borderDash: [5, 5]
                },
                ticks: {
                  display: true,
                  padding: 10,
                  color: "gray",
                  font: {
                    size: 10,
                    family: "Gothic Sans",
                    style: 'normal',
                    lineHeight: 2
                  },
                }  
              },
              x: {
                grid: {
                  drawBorder: false,
                  display: false,
                  drawOnChartArea: false,
                  drawTicks: false,
                  borderDash: [5, 7]
                },
                ticks: {
                  display: true,
                  color: "gray",
                  padding: 10,
                  font: {
                    size: 9,
                    family: "Open Sans",
                    style: 'normal',
                    lineHeight: 2
                  },
                }
              },
            },
          },
        });
        
</script>


<!-- Disbursement-overview -->

<!-- <script src="https://fastly.jsdelivr.net/npm/echarts@5.4.2/dist/echarts.min.js"></script> -->
<script>
       
       var ctx3 = document.getElementById("chart-bars").getContext("2d");
   
        new Chart(ctx3, {
          type: "doughnut",
          
          data: {
          labels: [
           
          "Children's department",
          "Women's department",
          "Personal ministry department",
          "Stewardship department",
          "Prayer department",

          "Youth department",
          "ACS department",
          "Communication department",
          "Sabbath school department",
          "Education department",

          "Health department ",
          "Dorcas department",
          "Others",
            
          ],
          datasets: [{
          data: [{{$Children}}, {{$Women}}, {{$Personal}}, {{$Stewardship}}, {{$Prayer}}, {{$Youth}}, {{$ACS}}, {{$Communication}}, {{$Sabbath}}, {{$Education}}, {{$Health}}, {{$Dorcas}}, {{$Others}}],
            radius: '99%',
            backgroundColor: [

              'rgb(13, 180, 185)',
              'rgb(201, 242, 155)',
              'rgb(183, 193, 172)',
              'rgb(104, 195, 163)',
              'rgb(63, 195, 128)',
              'rgb(178, 222, 39)',
              'rgb(51, 110, 123)',
              'rgb(22, 160, 133)',
              'rgb(3, 201, 169)',
              'rgb(30, 130, 76)',
              'rgb(145, 180, 150)',
              'rgb(65, 147, 169)',
              'rgb(52, 73, 94)',
             

            ],
            hoverOffset: 4
          }]
        },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: true,
                position: 'right',
                
               
                labels: {
                    color: 'gray',
                    font: {weight: 'normal', size: '11pt'},
                },  
              },
             
              
              
            },
            interaction: {
              intersect: false,
              mode: 'index',
            },
         
           
          },
        });
        
</script>

@endsection