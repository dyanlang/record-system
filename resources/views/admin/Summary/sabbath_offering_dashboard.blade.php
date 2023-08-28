@extends('layouts.DashB')
@section('content')


                                             
<div class="container-fluid">
    <div class="row" id="Tithes">
        <div class="col-lg-12 mt-4">
            <div class="mb-1 row">
                @include('layouts.reports-layout.sabbath_report_includes')
            </div>
         <br>  
         
         
    <div class="row mt-4">

        <div class="col-lg-3 bg-white">

        <div class="row mt-4" id="Contributors">
            <div class="col-span-12 col-md">
                <div class="list-group mt-2 col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box py-3">
                            <div class="row">
                                <div class="col"> 
                                    <div class="text-3xl font-medium text-center leading-8"> 
                                    {{ $current_tithers }} 
                                    </div>
                                    <div class="text-base  text-center text-xs text-slate-500 mt-1 text-truncate"> 
                                        Current no. of Sabbath Contributor  
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div> 
        </div> 

        <div class="row" id="Contributors">
            <div class="col-span-12 col-md ">
                <div class="list-group mt-2 col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box py-3">
                            <div class="row">
                                <div class="col"> 
                                    <div class="text-3xl font-medium text-center leading-8"> 
                                    {{ $current_offerings }} 
                                    </div>
                                    <div class="text-base  text-center text-xs text-slate-500 mt-1 text-truncate"> 
                                        Current Sabbath Offerings  
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </div>

    <div class="col-lg-9 pt-4 bg-white">
        <div id="user_table"  class="keep-scrollin">
            @foreach($sort_by_year as $annual)
            <div class="list-group mx-4" data-toggle="collapse" data-target="#{{ \Carbon\Carbon::parse($annual->year) }}">
           
                <div class=" list-group-item-custom cursor-pointer list-group-item">
                    <div class="media">
                        <div class="media-body" 
                             id="add_records_tithes_offerings">
                            <div class="row my-2">
                                <div class="col-md-4">
                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Year </p>
                                            <h6 class="text-gray  text-sm">
                                                <span>
                                                    <h6 class="text-sm"> {{ \Carbon\Carbon::parse($annual->year)->format('Y');   }} </h6>
                                                </span>
                                            </h6>
                                    </div>

                                   

                                    <div class="col-md-3 text-truncate">
                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book text-truncate"> Total Sabbath Offerings </p>
                                            <h6 class="text-gray  text-sm">
                                            <span> ₱ {{ number_format($annual->annually_offering_amount) }} </span>
                                            </h6>
                                    </div>

                                                        
                                    <div class="d-flex justify-content-end align-items-center px-1 col" >
                                        <div class="d-flex justify-content-end align-items-start">
                                            <div class="dropdown" id="dropdown_tithes_offerings"> 
                                                <a class="text-black    " type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" >
                                                    <i class="las la-angle-down" 
                                                       style="font-size: 14px"></i>  
                                                </a>                                           
                                            </div>    
                                        </div>
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>

               
               


                    <div class="collapse "  id="{{ \Carbon\Carbon::parse($annual->year) }}"> 
                    <!--  -->
                    @foreach($sort_by_month as $month)
                    @if(  \Carbon\Carbon::parse($month->months)->format('Y') ==  \Carbon\Carbon::parse($annual->year)->format('Y') )
                    <div class="list-group">
                        <div class="list-group-item-custom cursor-pointer list-group-item"
                        style="background-color:#f3f6f3">
                            <div class="media">
                                <div class="media-body" id="add_records_tithes_offerings">
                                    <div class="row my-2">
                                        <div class="col-md-4">
                                            <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Month </p>
                                                <h6 class="text-gray  text-sm">
                                                    <span>
                                                        {{ \Carbon\Carbon::parse($month->months)->format('F');  }}                    
                                                    </span>
                                                </h6>
                                        </div>

                                       

                                        <div class="col-md-3 text-truncate">
                                            <p class="mb-1 text-xs text-color-gray-lighter gotham-book text-truncate"> Total Sabbath Offerings </p>
                                                <h6 class="text-gray  text-sm">
                                                    <span> ₱ {{ number_format($month->offering_amount) }} </span>
                                                </h6>
                                        </div>

                                         
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                    <!--  -->
                    @endif
                @endforeach
            </div>
        
        </div>
        @endforeach
    </div>
</div>

      
           
 
    
  
    </div>
</div>


@endsection

