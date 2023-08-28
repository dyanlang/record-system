@extends('layouts.DashB')
@section('content')


                                             

    <div class="container-fluid">
        <div class="mb-1 row">
            <div class="col-md-5">
                    <div class="greetings">
                        <h4 class="text-white font-weight-bolder">
                            Disbursement / Summary
                        </h4>
                        <p class="text-white  mb-0"> @php $dtae = date_default_timezone_set('Asia/Manila') @endphp {{  date('F j, Y g:i a') }} </p>
                    </div>
                </div>
            @include('layouts.reports-layout.disbursement_includes')
        </div>
    </div>

    <br>
                
    <div class="row" id="Contributors">
                <div class="col-span-12 col-sm-2 ">
                    <div class="list-group mt-2 col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box py-3">
                                <div class="row">
                                    <div class="col"> 
                                        <div class="text-3xl font-medium text-center leading-8"> 
                                            {{ $current_tithers }}
                                        </div>
                                        <div class="text-base  text-center text-xs text-slate-500 mt-1 text-truncate"> 
                                            Current no. of 
                                            <br> Disbursement Request  
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="col-span-12 col-sm-2 ">
                    <div class="list-group mt-2 col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box py-3">
                                <div class="row">
                                    <div class="col"> 
                                        <div class="text-3xl font-medium text-center leading-8"> 
                                            {{ $current_lapsed_tithers }}
                                        </div>
                                        <div class="text-base  text-center text-xs text-slate-500 mt-1 text-truncate"> 
                                            Current no. of 
                                            <br> Disbursement Approved
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>   

                <div class="col-span-12 col-sm-2 ">
                    <div class="list-group mt-2 col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box  py-3">
                                <div class="row">
                                    <div class="col"> 
                                        <div class="text-3xl font-medium text-center leading-8  text-truncate">   
                                            ₱ {{ number_format($current_disbursement_total) }}  
                                        </div>
                                        <div class="text-base  text-center text-xs text-slate-500 mt-1 text-truncate">
                                            Current Disbursement 
                                            <br> Total
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>    

                <div class="col-span-12 col-sm-2 ">
                    <div class="list-group mt-2 col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box  py-3">
                                <div class="row">
                                    <div class="col"> 
                                        <div class="text-3xl font-medium text-center leading-8  text-truncate">  
                                            
                                        @if($total_excess <= 0 )
                                           ₱  0
                                        @else
                                            ₱ {{ number_format($total_excess) }}  
                                        @endif
                                           
                                        </div>
                                        <div class="text-base  text-center text-xs text-slate-500 mt-1 text-truncate">
                                                Previous Month 
                                                <br> Excess Fund
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>    

                <div class="col-span-12 col-sm-2 ">
                    <div class="list-group mt-2 col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box  py-3">
                                <div class="row">
                                    <div class="col"> 
                                        <div class="text-3xl font-medium text-center leading-8  text-truncate">   
                                            ₱ {{ number_format($current_fund) }}  
                                        </div>
                                        <div class="text-base  text-center text-xs text-slate-500 mt-1 text-truncate">
                                             Current  Total funds  <br> Amount
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>   

                <div class="col-span-12 col-sm-2 ">
                    <div class="list-group mt-2 col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box py-3">
                                <div class="row">
                                    <div class="col"> 
                                        <div class="text-3xl font-medium text-center leading-8 text-truncate"> 
                                             
                                        @if($total_excess <= 0 )
                                            ₱ {{ number_format($current_fund  + 0 - $current_disbursement_total) }}  
                                        @else
                                        ₱ {{ number_format($current_fund  + $total_excess - $current_disbursement_total ) }}   
                                        @endif

                                          
                                        </div>
                                        <div class="text-base  text-center text-xs text-slate-500 mt-1 text-truncate"> 
                                           New Total Funds <br> Amount
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>  
            </div>

            <div class="row mt-3">
                <div class="col-lg-12 pt-4 bg-white">
                    <div id="user_table" class="keep-scrollin">
                    @foreach($sort_by_year as $annual)
                        <div class="list-group mx-4">
                            <a href="#{{ \Carbon\Carbon::parse($annual->year) }}"   data-toggle="collapse" data-parent="#MainMenu" data-target="#{{ \Carbon\Carbon::parse($annual->year) }}">
                                <div class="list-group-item-custom cursor-pointer list-group-item">
                                    <div class="media">
                                        <div class="media-body" id="add_records_tithes_offerings">
                                            <div class="row my-2">
                                                <div class="col-md">
                                                    <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Year </p>
                                                        <h6 class="text-gray  text-sm">
                                                            <span>
                                                                <h6 class="text-sm"> {{ \Carbon\Carbon::parse($annual->year)->format('Y');   }} </h6>
                                                            </span>
                                                        </h6>
                                                </div>

                                                <div class="col-md text-truncate">
                                                    <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Total Disbursement Amount </p>
                                                        <h6 class="text-gray  text-sm">
                                                            <span> ₱ {{ number_format($annual->annually_disbursement_amount) }} </span>
                                                        </h6>
                                                </div>

                                                
                                                   
                                                <div class="d-flex justify-content-end align-items-end col-md" >
                                                    <div class="d-flex justify-content-end align-items-start">
                                                        <div class="dropdown" id="dropdown_tithes_offerings"> 
                                                            <div class="text-black    " type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" >
                                                                <i class="las la-angle-down" 
                                                                style="font-size: 14px"></i>  
                                                            </div>                                           
                                                        </div>    
                                                    </div>
                                                </div>  
                                                   

                                            </div>
                                        </div>
                                    </div>     
                                </div>
                                
                                
                                <!-- MONTH -->
                                <div class="collapse"   id="{{ \Carbon\Carbon::parse($annual->year) }}"> 
                                    @foreach($sort_by_month as $month)
                                        @if(  \Carbon\Carbon::parse($month->months)->format('Y') ==  \Carbon\Carbon::parse($annual->year)->format('Y') )
                                        <a href="#{{ \Carbon\Carbon::parse($month->months)->format('m Y') }}" data-toggle="collapse" data-target="#{{ \Carbon\Carbon::parse($month->months)->format('m Y') }}">
                                            <div class="list-group-item-custom cursor-pointer list-group-item" style="background-color:#f3f6f3">
                                                <div class="media">
                                                    <div class="media-body"  id="add_records_tithes_offerings">
                                                        <div class="row my-2">
                                                            <div class="col-md">
                                                                <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Month </p>
                                                                    <h6 class="text-gray  text-sm">
                                                                        <span>
                                                                            {{ \Carbon\Carbon::parse($month->months)->format('F');  }}                    
                                                                        </span>
                                                                    </h6>
                                                            </div>

                                                            <div class="col-md text-truncate">
                                                                <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Total Tithes </p>
                                                                    <h6 class="text-gray  text-sm">
                                                                        <span> ₱ {{ number_format($month->annually_disbursement_amount) }} </span>
                                                                    </h6>
                                                            </div>

                                                            <div class="col-md text-truncate">
                                                                <p class="mb-1 text-xs text-color-gray-lighter gotham-book text-truncate"> Total Offerings </p>
                                                                    <h6 class="text-gray  text-sm">
                                                                        <span> ₱ {{ number_format($month->offering_amount) }} </span>
                                                                    </h6> 
                                                            </div>

                                                            <div class="col-md text-truncate">
                                                                <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate"> Total Other Gifts  </p>
                                                                    <h6 class="text-gray  text-sm">
                                                                    <span> ₱ {{ number_format($month->other_gifts_amount) }} </span>
                                                                    </h6>
                                                            </div>
                                                            
                                                            <div class="d-flex justify-content-end align-items-end col-md" >
                                                                <div class="d-flex justify-content-end align-items-start">
                                                                    <div class="dropdown" id="dropdown_tithes_offerings"> 
                                                                        <div class="text-black" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" >
                                                                            <i class="las la-angle-down" 
                                                                            style="font-size: 14px"></i>  
                                                                        </div>                                           
                                                                    </div>    
                                                                </div>
                                                            </div> 

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- SUB  -->
                                        <div class="collapse list-group-submenu " id="{{ \Carbon\Carbon::parse($month->months)->format('m Y') }}">
                                            @foreach($sort_by_submonth as $sort_by_subdate)
                                            @if(  \Carbon\Carbon::parse($sort_by_subdate->disbursement_date)->format('m Y') ==  \Carbon\Carbon::parse($month->months)->format('m Y') )
                                                <a href="#{{ \Carbon\Carbon::parse($month->months)->format('m Y') }}"  data-toggle="collapse" data-parent="#{{\Carbon\Carbon::parse($month->months)->format('m Y') }}">
                                                    <div class="list-group-item-custom cursor-pointer list-group-item"  style="background-color:#c3c7c3">
                                                        <div class="media">
                                                            <div class="media-body"  id="add_records_tithes_offerings">
                                                                <div class="row my-2">
                                                                    <div class="col-md">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Month </p>
                                                                            <h6 class="text-gray  text-sm">
                                                                                <span>
                                                                                    {{ \Carbon\Carbon::parse($sort_by_subdate->disbursement_date)->format('F d Y')   }}    
                                                                                </span>
                                                                            </h6>
                                                                    </div>

                                                                    <div class="col-md text-truncate">
                                                                        <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Created by </p>
                                                                            <h6 class="text-gray  text-sm">
                                                                                <span> {{$sort_by_subdate->firstname }} {{$sort_by_subdate->lastname }} </span>
                                                                            </h6>
                                                                    </div>


                                                                    <div class="col-md text-truncate">
                                                                        <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Total Amount </p>
                                                                            <h6 class="text-gray  text-sm">
                                                                                <span> ₱ {{ number_format($sort_by_subdate->disbursement_amount) }} </span>
                                                                            </h6>
                                                                    </div>

                                                                    <div class="col-md text-truncate">
                                                                        <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Disbursement Department </p>
                                                                            <h6 class="text-gray  text-sm">
                                                                                <span>{{  $sort_by_subdate->disbursement_purpose}} </span>
                                                                            </h6>
                                                                    </div>

                                                                    <div class="col-md text-truncate">
                                                                        <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Disbursement Description </p>
                                                                            <h6 class="text-gray  text-sm">
                                                                                <span>{{  $sort_by_subdate->disbursement_description}} </span>
                                                                            </h6>
                                                                    </div>

                                                                   

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                @endif
                                            @endforeach
                   
                                        </div>
                                        <!-- SUB -->

                                        @endif
                                    @endforeach
                                </div>
                                <!-- MONTH -->
                            </a> 
                        </div>
                    @endforeach

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection