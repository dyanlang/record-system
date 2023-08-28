@extends('layouts.member')
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
    <div class="row" style="justify-content: center">
        <div class="col-lg-12 mt-4">
            <div class="mb-0">
                <h4 class="font-weight-bolder text-white">Pending Requests</h4> 
            </div>
            <div class="no-gutters row mb-5">
                <div class="d-flex justify-content-between">
                    <span class="text-left text-white"> 
                        @php  
                            $dtae = date_default_timezone_set('Asia/Manila') 
                        @endphp

                        {{  date('F j, Y g:i a') }} 
                    </span>
                </div>
            </div>
        
            <div id="ALL" class="tab-pane fade show active"> 

                <div class="overflow-hidden">
                    <div class="row">
                        <div class="col-lg">
                            <div class="card pb-3" id="reload">
                                <div class="container bg-white mt-4" style="margin: 0">
                                    <a href="#" onclick="history.back()">
                                        <span id="goback_pending_request" class="text-gray">
                                            <i class="las la-arrow-left" style="font-size: 22px"></i>
                                            <span>
                                                GO BACK
                                            </span>
                                        </span>                   
                                    </a>
                                </div>
                                <div class="p-4">
                                    <h5>TITHES AND OFFERINGS REQUESTS</h5>
                                </div>

                                <div class="keep-scrollin">

                                    @if($pending->count() > 0)
                                        @foreach ($pending as $tithes)

                                                <div class="list-group mx-4">
                                                    <div class=" list-group-item-custom cursor-pointer list-group-item">
                                                        <div class="media">
                                                            <div class="media-body" id="list_pending_request">
                                                                <div class="row my-2">

                                                                    <div class="col-md-2">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                            Tithes Amount
                                                                        </p>
                                                                        <h6 class="text-gray">
                                                                            <span>
                                                                                <h6 class="text-sm">
                                                                                    ₱ {{ number_format($tithes->tithes_offer_tithe_amount, 2) }}
                                                                                </h6>
                                                                            </span>
                                                                        </h6>
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                            Offering Plan Amount
                                                                        </p>

                                                                        <h6 class="text-sm text-gray">
                                                                            ₱ {{ number_format($tithes->tithes_offer_offering_plan_amount, 2) }}
                                                                        </h6>
                                                                         
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                            Other Gifts Amount
                                                                        </p>


                                                                        <h6 class="text-sm text-gray">
                                                                            ₱ {{ number_format($tithes->tithes_offer_other_gifts_amount, 2) }}
                                                                        </h6>
                                                                         
                                                                    </div>

                                                                    <div class="col-sm-2">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                            Description
                                                                        </p>

                                                                        <h6 class="text-sm text-gray">
                                                                            {{ $tithes->tithes_offer_other_gifts_desciption }}
                                                                        </h6>
                                                                         
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                            Type
                                                                        </p>
                                                                        @if ($tithes->tithes_offer_type == 'Cash')
                                                                            <span  class="badge badge-sm bg-gradient-warning">
                                                                                Cash
                                                                            </span>
                                                                        @elseif ($tithes->tithes_offer_type == 'GCash')
                                                                            <span  class="badge badge-sm bg-gradient-success">
                                                                                GCash
                                                                            </span>

                                                                        @elseif ($tithes->tithes_offer_type == 'Bank')
                                                                            <span  class="badge badge-sm bg-gradient-info">
                                                                                Bank
                                                                            </span>
                                                                        @else
                                                                            <span  class="badge badge-sm bg-gradient-secondary">
                                                                                {{ $tithes->tithes_offer_type }}
                                                                            </span>
                                                                        @endif   
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> 
                                                                            Status
                                                                        </p>
                                                                        @if ($tithes->tithes_offer_church_member_request == 'Pending')
                                                                            <span  class="badge badge-sm bg-gradient-primary">
                                                                                Pending
                                                                            </span>

                                                                        @elseif ($tithes->tithes_offer_church_member_request == 'For Approval')
                                                                            <span  class="badge badge-sm bg-gradient-info">
                                                                                For Approval
                                                                            </span>

                                                                        @elseif ($tithes->tithes_offer_church_member_request == 'Declined')
                                                                            <span  class="badge badge-sm bg-gradient-danger">
                                                                                Declined
                                                                            </span>
                                                                        @endif  
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                            Date Requested
                                                                        </p>

                                                                        <h6 class="text-sm text-gray">
                                                                            {{ $tithes->tithes_offer_date }}
                                                                        </h6>
                                                                         
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                     
                                        @endforeach 

                                    @else
                                        
                                        <center>
                                        <div class="text-gray my-10 mx-auto"> 
                                            <h4 class="opacity-2 p-4"> There's no recent activities here. </h4>
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
</div>

@endsection

