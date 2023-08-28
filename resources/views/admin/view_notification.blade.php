@extends('layouts.DashB')
@section('content')
  
<script>
$(document).ready(function(){
	$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
	});
	var activeTab = localStorage.getItem('activeTab');
	if(activeTab){
		$('#myTab a[href="' + activeTab + '"]').tab('show');
	}
});
</script>



<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mt-4">
            <div class=" mb-0">
                <h4 class="font-weight-bolder text-white "> Notification  </h4> 
            </div>
            <div class="no-gutters row">
                <div class="d-flex justify-content-between ">
                    <span class="text-left text-white ml-3"> 
                        @php  
                            $dtae = date_default_timezone_set('Asia/Manila') 
                        @endphp

                        {{ date('F j, Y g:i a') }} 
                    </span>
                </div>
            </div>
        </div>

        <!-- ALL -->
        <div id="ALL" class="tab-pane fade show active mt-4 "> 
            <div class=" overflow-hidden">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="card"  id="reload">
                            <h3 class="px-4 pt-4 "> View Notification Details </h3>

                            <div class="mx-4">
                                <a  href="/home" >
                                        <span class="text-gray " > <i class="las la-arrow-left" style="font-size: 22px"></i> <span"> GO BACK </span> </span>                   
                                </a>
                            </div>

                            <div class="card-body mb-9 mt-3">  
                            <div class="col">
                            
                        
                                
                                @if( $tithe_view->type == 'Tithes_Offering')

                                    @if( $tithe_view->notif_type == "Added")
                                        added new record to tithes and offerings.  See full details at <a href="../tithes&offerings/reports"> Tithes & Offering </a> !
                                
                                    @elseif( $tithe_view->notif_type == "Approved")
                                        approved your request.  See full details at <a href="/tithes&offerings/reports"> Tithes Offering </a> !

                                    @elseif( $tithe_view->notif_type == "For Approval")
                                        checked your request but needs an approval.  See full details at  <a href="/tithes&offerings/reports"> Tithes & Offering </a> !
                                    
                                    @elseif( $tithe_view->notif_type == "Declined")
                                        declined a request.  See full details at <a href="deleted_tithes_offerings"> Trash </a> !

                                    @elseif($tithe_view->notif_type == "Modified")                          
                                        modified a record from tithes and offerings. See full details at  <a href="/tithes&offerings/reports"> Tithes & Offering </a> !
                                    
                                    @elseif($tithe_view->notif_type == "Retrieved") 
                                        retrieved a record from trash to tithes and offerings. See full details at  <a href="/tithes&offerings/reports"> Tithes & Offering </a> !

                                    @elseif($tithe_view->notif_type == "Move To Trash") 
                                        move a record from  tithes and offerings to trash. See full details at <a href="../deleted_tithes_offerings"> Trash </a> !
                                        
                                    @endif

                                  
                                @elseif($tithe_view -> type == 'Disbursement Record' || $tithe_view -> type == 'Disbursement')
                                    @if( $tithe_view->notif_type == "Added")
                                            added new record to disbursement. See full details at <a href="../disbursement_report"> Disbursement </a> !

                                      @elseif($tithe_view->notif_type == "Modified")                          
                                          modified a record from disbursement. See full details at <a href="../disbursement_report"> Disbursement </a> !
                                      
                                      @elseif($tithe_view->notif_type == "Retrieved") 
                                          retrieved a record from trash to disbursement. See full details at <a href="../disbursement_report"> Disbursement </a> !
                                    
                                      @elseif($tithe_view->notif_type == "For Approval") 
                                           a record from disbursement to needs an approval. See full details at <a href="../disbursement_report"> Disbursement </a> !
                                     
                                      @elseif($tithe_view->notif_type == "Approved") 
                                           a record from disbursement to needs an approval. See full details at <a href="../disbursement_report"> Disbursement </a> !
                                    
                                      @elseif($tithe_view->notif_type == "Declined") 
                                          declined a record from disbursement. See full details at <a href="../deleted_tithes_offerings"> Trash </a> !

                                      @elseif($tithe_view->notif_type == "Move To Trash") 
                                          move a record from disbursement to trash. See full details at <a href="../deleted_tithes_offerings"> Trash </a> !
                                      @endif

                                @elseif($tithe_view ->type == "Sabbath Offering")
                                    @if( $tithe_view->notif_type == "Added")
                                            added new record to sabbath offering. See full details at <a href="/sabbath-offerings/summary"> Sabbath Offering </a> !

                                      @elseif($tithe_view->notif_type == "Modified")                          
                                          modified a record from sabbath offering. See full details at <a href="/sabbath-offerings/summary"> Sabbath Offering </a> !
                                      
                                      @elseif($tithe_view->notif_type == "Retrieve") 
                                          retrieved a record from trash to sabbath offering. See full details at <a href="/sabbath-offerings/summary"> Sabbath Offering </a> !
                                          
                                      @elseif($tithe_view->notif_type == "Declined") 
                                          declined a record from sabbath offering. See full details at <a href="../deleted_tithes_offerings"> Trash </a> !

                                      @elseif($tithe_view->notif_type == "Move To Trash") 
                                          move a record from sabbath offering to trash. See full details at <a href="deleted_tithes_offerings"> Trash </a> !
                                      @endif

                                @else
                                     {{ $tithe_view->notif_type }} {{ $tithe_view -> type}}
                                  
                                      
                                @endif
                                
                                </p>
                                <p class="text-end mx-4 text-xs">   {{ $tithe_view->created_at->diffForHumans()}} </p>  
                           </div>

                           @if($tithe_view->type == 'Tithes_Offering')
                            <div class="list-group mx-4">
                                        <div class=" list-group-item-custom cursor-pointer list-group-item">
                                            <div class="media">
                                                <div class="media-body">
                                                    <div class="row my-2">
                                                        <div class="col-md-3">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Name of Contributor </p>
                                                                <h6 class="text-gray  text-sm">
                                                                    <span>
                                                                       <h6 class="text-sm">
                                                                            <a href="/member_tithes/{{ $tithe_info->member_ID }}"
                                                                             data-bs-toggle="tooltip" title="View Profile">
                                                                              {{ $tithe_info->firstname }} {{ $tithe_info->lastname }}
                                                                            </a>
                                                                        </h6>
                                                                    </span>
                                                                </h6>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate"> Tithe Amount </p>
                                                                <h6 class="text-gray  text-sm">
                                                                    <span> ₱ {{ number_format($tithe_info->tithes_offer_tithe_amount, 2) }} </span>
                                                                </h6>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate"> Offering Plan Amount </p>
                                                                <h6 class="text-gray  text-sm">
                                                                    <span> ₱ {{ number_format($tithe_info->tithes_offer_offering_plan_amount, 2) }} </span>
                                                                </h6>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate"> Other Gifts Amount </p>
                                                                <h6 class="text-gray text-sm">
                                                                    <span> ₱ {{ number_format($tithe_info->tithes_offer_other_gifts_amount, 2) }} </span>
                                                                </h6>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate"> Other Gifts Description </p>
                                                                <h6 class="text-gray  text-sm">
                                                                    <span class="text-truncate"> {{ $tithe_info->tithes_offer_other_gifts_desciption }} </span>
                                                                </h6>
                                                        </div>


                                                        <div class="col"><p class="mb-1  text-xs text-color-gray-lighter gotham-book"> Type </p>
                                                            <h6 class="text-xs text-gray">
                                                                @if ($tithe_info->tithes_offer_type == 'Cash')
                                                                <span  class="badge badge-sm bg-gradient-warning">   {{ $tithe_info->tithes_offer_type }} </span> </h6>
                                                                @elseif ($tithe_info->tithes_offer_type == 'Online Payment')
                                                                <span  class="badge badge-sm bg-gradient-success">   {{ $tithe_info->tithes_offer_type }}  </span> </h6>
                                                                @elseif ($tithe_info->tithes_offer_type == '2')
                                                                <span  class="badge badge-sm bg-gradient-primary">   {{ $tithe_info->tithes_offer_type }}  </span> </h6>
                                                                @elseif($tithe_info->tithes_offer_type == '')
                                                                     <span  class="badge badge-sm bg-gradient-secondary">   None  </span> </h6>
                                                                @else
                                                                <span  class="badge badge-sm bg-gradient-secondary">   {{ $tithe_info->tithes_offer_type }}   </span> </h6>
                                                                @endif
                                                        </div>
                                                        
                                                        <div class="col">
                                                            <p class="mb-1  text-xs text-color-gray-lighter gotham-book">Date</p>
                                                            <h6 class="text-xs ">  {{ $tithe_info->created_at->format('d/m/Y')}} </h6>
                                                        </div>
                                                       
                                                      
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @elseif($tithe_view->type == 'Disbursement Record' || $tithe_view->type == 'Disbursement')
                        <div class="list-group mx-4" >
                            <div class=" list-group-item-custom cursor-pointer list-group-item">
                                <div class="media">
                                    <div class="media-body">
                                        <div class="row my-2">
                                            <div class="col-md-3">
                                                <p class="mb-1   text-xs text-color-gray-lighter gotham-book">  Department </p>
                                                    <h6 class="text-gray  text-sm">
                                                    {{ $disbursement_info->disbursement_purpose }}
                                                    </h6>
                                            </div>

                                            <div class="col-md-2">
                                                <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate">  Amount </p>
                                                    <h6 class="text-gray  text-sm">
                                                        <span> ₱ {{ $disbursement_info->disbursement_amount }} </span>
                                                    </h6>
                                            </div>

                                                        <div class="col-md-3">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate">  Description </p>
                                                                <h6 class="text-gray  text-sm">
                                                                    <span> 
                                                                    {{ $disbursement_info->disbursement_description }}
                                                                
                                                                    </span>
                                                                </h6>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate">  Status </p>
                                                                <h6 class="text-gray  text-sm">
                                                                    <span> 

                                                                    @if ($disbursement_info->disbursement_type_status == 'Pending')
                                                                    <span  class="badge badge-sm bg-gradient-warning">   {{ $disbursement_info->disbursement_type_status }} </span> </h6>
                                                                    @elseif ($disbursement_info->disbursement_type_status == 'Approved')
                                                                    <span  class="badge badge-sm bg-gradient-success">   {{ $disbursement_info->disbursement_type_status }}  </span> </h6>
                                                                    @elseif($disbursement_info->disbursement_type_status == '')
                                                                        <span  class="badge badge-sm bg-gradient-secondary">   None  </span> </h6>
                                                                    @else
                                                                    <span  class="badge badge-sm bg-gradient-info">  {{ $disbursement_info->disbursement_type_status }}   </span> </h6>
                                                                    @endif
                                                                    
                                                                
                                                                    </span>
                                                                </h6>
                                                        </div>

                                                        <div class="col">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate">  Date  </p>
                                                                <h6 class="text-gray  text-sm">
                                                                    <span> 
                                                                    {{ $disbursement_info->created_at->format('d/m/Y')}}
                                                                
                                                                    </span>
                                                                </h6>
                                                        </div>
                                                       
                                                      
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @elseif($tithe_view->type == 'Sabbath Offering')
                        <div class="list-group mx-4" >
                                <div class=" list-group-item-custom cursor-pointer list-group-item">
                                    <div class="media">
                                        <div class="media-body">
                                            <div class="row my-2">
                                                <div class="col-md-3">
                                                    <p class="mb-1   text-xs text-color-gray-lighter gotham-book">  Department </p>
                                                        <h6 class="text-gray  text-sm">
                                                        {{ $tithe_info->tithes_offer_other_gifts_desciption }}
                                                        </h6>
                                                </div>

                                                <div class="col-md-2">
                                                    <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate">  Amount </p>
                                                        <h6 class="text-gray  text-sm">
                                                            <span> ₱ {{ number_format($tithe_info->tithes_offer_other_gifts_amount, 2) }}</span>
                                                        </h6>
                                                </div>

                                                

                                                <div class="col-md-2">
                                                    <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate">  Status </p>
                                                        <h6 class="text-gray  text-sm">
                                                            <span>
                                                                @if ($tithe_info->tithes_offer_type == 'Cash')
                                                            <span  class="badge badge-sm bg-gradient-warning">   {{ $tithe_info->tithes_offer_type }} </span> </h6>
                                                            @elseif ($tithe_info->tithes_offer_type == 'Online Payment')
                                                            <span  class="badge badge-sm bg-gradient-success">   {{ $tithe_info->tithes_offer_type }}  </span> </h6>
                                                            @elseif ($tithe_info->tithes_offer_type == '2')
                                                            <span  class="badge badge-sm bg-gradient-primary">   {{ $tithe_info->tithes_offer_type }}  </span> </h6>
                                                            @elseif($tithe_info->tithes_offer_type == '')
                                                                <span  class="badge badge-sm bg-gradient-secondary">   None  </span> </h6>
                                                            @else
                                                            <span  class="badge badge-sm bg-gradient-secondary">   {{ $tithe_info->tithes_offer_type }}   </span> </h6>
                                                            @endif 

                                                        
                                                            </span>
                                                    </h6>
                                                </div>

                                                <div class="col">
                                                    <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate">  Date  </p>
                                                        <h6 class="text-gray  text-sm">
                                                            <span> 
                                                            {{ $tithe_info->created_at->format('d/m/Y')}}
                                                        
                                                            </span>
                                                        </h6>
                                                </div>
                                                       
                                                      
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- <div class="col mx-5">                      
                            <h6 class="text-end">  
                            <a href=""> 
                                        <i class="las la-times-circle  mx-1"  style="font-size: 20px"></i> 
                                        <span class="text-xs "> Remove this Notification  </span> 
                                      </a>
                                
                            </p>
                        </div> -->
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
