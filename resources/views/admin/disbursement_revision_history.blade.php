@extends('layouts.DashB')
@section('content')

                                             
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="ml-1 mb-0">
                <h4 class="font-weight-bolder text-white "> Revision History  </h4> 
            </div>
            <div class="no-gutters row">
                <div class="d-flex justify-content-between ">
                    <span class="text-left text-white"> 
                        @php  
                            $dtae = date_default_timezone_set('Asia/Manila') 
                        @endphp

                        {{  date('F j, Y g:i a  ') }} 
                    </span>
                </div>
            </div>
        </div>

        <!-- start of tabs 
        <div class="bs-example mt-4">
            <ul class="nav nav-tabs" id="myTab">

                <li class="nav-item">
                    <a href="#ALL" class="nav-link bg-success active" data-toggle="tab">   Revision Records  </a>
                </li>
                <li class="nav-item">
                    <a href="#sectionB" class="nav-link  bg-success" data-toggle="tab">Sabbath Offering </a>
                </li>
            </ul>  -->
</div>

<!-- ALL -->
        <div id="ALL" class="mt-5 tab-pane fade show active"> 
            <div class=" overflow-hidden">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="card"  id="reload">
                            <h3 class="px-4 pt-4 " > Revision Records </h3>

                            <div class="mx-4">
                                <a href="/disbursement_report">
                                        <span id="goback_disbursement_revison_history" class="text-gray " > <i class="las la-arrow-left" style="font-size: 22px">   </i> <span"> GO BACK </span> </span>                   
                                </a>
                            </div>
                    
                             <div class="card-body keep-scrollin" id="list_disbursement_revison_history">              
                              @if($revHistory->count() > 0)
                                @foreach ($revHistory as $revision)
                                 
                                    <div class="list-group">
                                        <div class=" list-group-item-custom cursor-pointer list-group-item">
                                            <div class="media">
                                                <div class="media-body ">
                                                    <div class="row my-2">

                                                    <div class="col-md-3">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Name  </p>
                                                        <h6 class="text-gray">
                                                        <span><h6 class="text-sm ">  {{ $revision->firstname }} {{ $revision->lastname }} </h6></span>
                                                        </h6>
                                                    </div>

                                                    <div class="col-md-3">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Disbursement Department  </p>
                                                        <h6 class="text-gray">
                                                        <span><h6 class="text-sm ">  {{ $revision->disbursement_department }} </h6></span>
                                                        </h6>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Disbursement Amount   </p>
                                                            <h6 class="text-gray">
                                                            <span>
                                                            <h6 class="text-sm text-truncate">  
                                                        @if ($revision->disbursement_amount != null)
                                                            <u> {{ number_format($revision->disbursement_amount, 2) }} </u> <br>
                                                        @endif
                                                            </h6>
                                                            </span>
                                                        </h6>
                                                    </div>


                                                    <div class="col-md-2">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Disbursement Description  </p>
                                                        <h6 class="text-gray">
                                                        <span><h6 class="text-sm ">  {{ $revision->disbursement_description }} </h6></span>
                                                        </h6>
                                                    </div>

                                                    <div class="col-md-2"><p class="mb-1  text-xs text-color-gray-lighter gotham-book"> Disbursement Status  </p>
                                                        <h6 class="text-gray  text-sm">
                                                            <span> 
                                                                @if ($revision->disbursement_type_status == 'Pending')
                                                                <span  class="badge badge-xs bg-gradient-warning">   {{ $revision->disbursement_type_status }} </span> </h6>
                                                                @elseif ($revision->disbursement_type_status == 'Approved')
                                                                <span  class="badge badge-xs bg-gradient-success">   {{ $revision->disbursement_type_status }}  </span> </h6>
                                                                @elseif($revision->disbursement_type_status == '')
                                                                <span  class="badge badge-xs bg-gradient-secondary">   None  </span> </h6>
                                                                @else
                                                                <span  class="badge badge-xs bg-gradient-info">  {{ $revision->disbursement_type_status }}   </span> </h6>
                                                                @endif
                                                                                
                                                            </span>
                                                        </h6>
                                                    </div>
                                                    <div class="col">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Revision Date  </p>
                                                        <h6 class="text-gray">
                                                        <span><h6 class="text-sm ">  {{ $revision->created_at->diffForHumans() }} </h6></span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                
                              @endforeach 
                              
                            @else
                       
                            
                            <center>
                              <div class="text-gray my-10 mx-auto vh-100"> 
                                <h4 class="opacity-2"> There's no recent activities here. </h4>
                              </div>
                            </center>
                        @endif

                          </div>                   
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END ALL -->
                                
<!-- end of tabs  -->

@endsection
