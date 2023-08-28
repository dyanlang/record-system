@extends('layouts.DashB')
@section('content')



        <div class="container-fluid">
            <div class="mb-1 row">
                <div class="col-md-5">
                        <div class="greetings">
                            <h4 class="text-white font-weight-bolder">
                                Disbursement / Report
                            </h4>
                            <p class="text-white  mb-0"> @php $dtae = date_default_timezone_set('Asia/Manila') @endphp {{  date('F j, Y g:i a') }} </p>
                        </div>
                    </div>
                    @include('layouts.reports-layout.disbursement_includes')
                </div>
            </div>
            
            <br>
            
            <div id="ALL" class="tab-pane fade show active"> 
                <div class="overflow-hidden">
                    <div class="row">
                        <div class="col-lg">
                            <div class="card pb-3">

                                
                                <div class="container bg-white mt-4" style="margin: 0">
                                    <a href="/disbursement_report">
                                        <span id="list_disbursement_report_pending_goback" class="text-gray"> <i class="las la-arrow-left" style="font-size: 22px"></i>
                                            <span>
                                                GO BACK
                                            </span>
                                        </span>                   
                                    </a>

                                        <br><br>

                                    <span>
                                        <i style="font-size: 12px">
                                            These are the disbursement added that are still pending and needs to review by the board/main office.
                                        </i>
                                    </span>
                                </div>

                                <div class="mt-4 keep-scrollin vh-100">
                                    @if ($penDisburse->count() > 0)
                                        @foreach ($penDisburse as $disbursement)
                                                <div class="list-group mx-4">
                                                    <div class=" list-group-item-custom cursor-pointer list-group-item">
                                                        <div class="media">
                                                            <div class="media-body" id="list_disbursement_report_pending_list_record">
                                                                <div class="row my-2">

                                                                    <div class="col-md">
                                                                        <p class="mb-1   text-xs text-color-gray-lighter gotham-book">
                                                                            Added By
                                                                        </p>
                                                                        <h6 class="text-gray">
                                                                            <span>
                                                                                <h6 class="text-sm">
                                                                                    {{ $disbursement->firstname }} {{ $disbursement->lastname }}
                                                                                    <input type="hidden" name="uID" id="uID" value="{{ $disbursement->uID }}" />
                                                                                </h6>
                                                                            </span>
                                                                        </h6>
                                                                    </div>

                                                                    <div class="col-md">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                            Department
                                                                        </p>

                                                                        <h6 class="text-sm text-gray">
                                                                            {{ $disbursement->disbursement_purpose }}
                                                                        </h6>
                                                                    </div>

                                                                    <div class="col-md">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                            Amount
                                                                        </p>

                                                                        <h6 class="text-sm text-gray">
                                                                            ₱ {{ number_format($disbursement->disbursement_amount, 2) }}
                                                                        </h6>
                                                                         
                                                                    </div>

                                                                    <div class="col-md">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                            Description
                                                                        </p>

                                                                        <h6 class="text-sm text-gray">
                                                                            {{ $disbursement->disbursement_description }}  
                                                                        </h6>
                                                                         
                                                                    </div>

                                                                    <div class="col-md">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Status </p>
                                                                       
                                                                        <h6 class="text-gray  text-sm">
                                                                            @if ($disbursement->disbursement_type_status == 'Pending')
                                                                                <span  class="badge badge-xs bg-gradient-warning"> Pending </span>

                                                                            @elseif ($disbursement->disbursement_type_status == 'Needs Review')
                                                                                <span  class="badge badge-xs bg-gradient-info">  Needs Review </span>
                                                                            @endif  
                                                                        </h6>
                                                                    </div>

                                                                    <div class="col-md">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> 
                                                                            Date Requested
                                                                        </p>
                                                                        <h6 class="text-sm text-gray">
                                                                            {{ $disbursement->disbursement_date }}
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


@endsection

