@extends('layouts.DashB')
@section('content') 

@php
$date =    date_default_timezone_set('Asia/Manila');



@endphp


<div class="container">
    <div class="row">
        
        <div class="col-md-11 mt-4">
            <div class=" mb-0">
                <h4 class="font-weight-bolder text-white "> Offering / Report  </h4> 
            </div>
         
            <div class="no-gutters row">
                <div class="d-flex justify-content-between ">
                    <span class="text-left text-white"> @php  $dtae = date_default_timezone_set('Asia/Manila') @endphp {{  date('F j, Y g:i:a') }}</span>
            <!-- button ADD -->
                  
                </div>
            </div>
          

            <div class="container bg-white mt-2">
                <div class="container rounded bg-white">
                    <div class="row">
                        <div  class="d-flex justify-content-between  mt-5">
                                
                            <div>
                                <a href="/ad_reports">
                                        <span class="text-gray " > <i class="las la-arrow-left" style="font-size: 22px">   </i> <span"> GO BACK </span> </span>                   
                                </a>
                            </div>
                            <div>
                                <form action="/updates/{{ $offering_view->toID }}" method="POST">
                                    @csrf
                                    @method('PUT')


                                    <!-- <input type="hidden" name="disbursement_status" value="2">                                  
                                    <input type="hidden" name="disbursement_amount" value="{{ $offering_view->disbursement_amount }}">
                                    <input type="hidden" name="disbursement_type" value="{{ $offering_view->disbursement_type }}"> -->

                                    <input type="hidden" name="updated_at" value= ' {{ date("d-m-Y H:i:s") }} '>

                                    @if(  $offering_view->tithes_offer_approval == '1')

                                        <button  type="btn" class="btn btn-sm text-success btn-outline-success mx-1" data-bs-toggle="tooltip"  title="Approve">
                                            <span class="text-sm" > <i class="las la-check"  style="font-size: 20px"></i> </span>                   
                                        </button>

                                        <a href="/offering_edit/{{ $offering_view->toID }}">
                                            <span class="text-sm btn btn-sm text-primary btn-outline-primary " data-bs-toggle="tooltip"  title="Edit"> <i class="las la-edit" style="font-size: 20px"></i>   </span>                   
                                        </a>

                                        <a  onclick="delete_tithe{{$tithes1->toID }}('normalAlert')" class=" $offering_view->toID">
                                            <span class="text-sm btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="Remove" ><i class="las la-trash"  style="font-size: 20px"></i> </span>                   
                                        </a>
                                <!-- sweet alert -->
                                        <script>
                                            function delete_tithe{{ $offering_view->toID }}() {
                                                Swal.fire({
                                                    title: 'Are you sure?',
                                                    icon: 'warning',
                                                    confirmButtonColor: '#2dce89',
                                                    showCancelButton: true,
                                                    confirmButtonText: '<a href="/delete_tithe/{{ $offering_view->toID }}" style="color:white; ">  Yes, Move it to trash  </a>' 
                                                })
                                            };
                                        </script>
                                <!-- sweet alert -->
                                    

                                    @else

                                        <a href="/offering_edit/{{ $offering_view->toID }}">
                                            <span class="text-sm btn text-primary btn-sm btn-outline-primary "  data-bs-toggle="tooltip"  title="Edit"> <i class="las la-edit" style="font-size: 20px"></i>   </span>                   
                                        </a>

                                        <a  onclick="delete_tithe{{$offering_view->toID }}('normalAlert')" class=" $offering_view->toID">
                                            <span class="text-sm btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="Remove" ><i class="las la-trash"  style="font-size: 20px"></i> </span>                   
                                        </a>
                                <!-- sweet alert -->
                                        <script>
                                            function delete_tithe{{ $offering_view->toID }}() {
                                                Swal.fire({
                                                    title: 'Are you sure?',
                                                    icon: 'warning',
                                                    confirmButtonColor: '#2dce89',
                                                    showCancelButton: true,
                                                    confirmButtonText: '<a href="/delete_tithe/{{ $offering_view->toID }}" style="color:white; ">  Yes, Move it to trash  </a>' 
                                                })
                                            };
                                        </script>
                                <!-- sweet alert -->
                                    
                                    

                                    @endif

                                </form>
                            </div>
                        </div>
                        <div class="container rounded bg-white">
                            <div class="row">
                                <div class="col-md-3 border-right">
                                <div class="d-flex flex-column p-3 py-5">
                                            <input type="hidden" name="toID" value="{{$offering_view->toID}}">                  
                                            <img src="/tithes-offer/{{ $offering_view->tithes_offer_file }}" class="img logo mb-5"  width="200" data-toggle="modal" data-target="#imgReceipt_{{ $offering_view->toID }}" title="View Image">
                                            <div class="col-md-12">
                                                    <div class="col-md-12">
                                                        <label class="labels text-uppercase"> Purpose </label> 
                                                        <textarea  class="form-control" name="tithes_offer_purpose"  value="" readonly> {{ $offering_view->tithes_offer_purpose  }}  </textarea>
                                                    </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-5 border-right">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="text-right"><strong class=" text-uppercase"> Offering INFORMATION</strong></h4>
                                        </div>
                                        
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label class="labels  text-uppercase"> Event </label> 
                                                <input type="text" class="form-control"  name="offering_name" value="{{ $offering_view->offering_name  }}" readonly>
                                            </div>

                                            <div class="col-md-12">
                                                <label class="labels  text-uppercase"> Amount </label> 
                                                <input type="text" class="form-control"  name="tithes_offer_amount" value="{{ $offering_view->tithes_offer_amount     }}" readonly>
                                            </div>

                                            <div class="col-md-12">
                                                <label class="labels  text-uppercase"> Request Date </label> 
                                                <input type="text" class="form-control"  name="created_at" value="{{ $offering_view->created_at  }}" readonly>
                                            </div>

                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <div class="p-3 py-5">
                                        <div  class="d-flex justify-content-start"> 
                                            @if($offering_view->tithes_offer_approval == '1') 
                                            <div class="col-md-12 text-uppercase text-xs d-flex justify-content-between">
                                                <label class="labels"> <b> status</b> </label>
                                                <span class="badge badge-sm bg-gradient-warning text-sm">  Pending </span> 
                                            </div>
                                            @else
                                            <div class="col-md-12 text-uppercase text-xs d-flex justify-content-between">
                                                <span class="labels"> <b> status</b> </span>
                                                <span  class="badge badge-sm bg-gradient-success  text-sm">  Approved </span>
                                            </div>
                                            @endif   
                                        
                                        </div>

                                    
                                        <div class="col-md-12 mt-2">
                                            <label class="labels  text-uppercase"> Added By: </label>         
                                            <input type="text" class="form-control" value="  {{ $officer_incharge->lastname }}  {{ $officer_incharge->firstname }}   {{ $officer_incharge->middlename }}   " readonly>
                                        </div> <br>

                                            @if($offering_view->tithes_offer_approval == '2' ) 
                                                <div class="col-md-12">
                                                    <label class="labels  text-uppercase"> Request APPROVED </label> 
                                                    <input type="text" class="form-control"  value="{{ $offering_view->updated_at  }}" readonly>
                                                </div>

                                            @else
                                                <div class="col-md-12 text-uppercase text-xs d-flex justify-content-between">
                                                    <span class="labels"> <b>  Date Approve </b> </span>
                                                    
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection