@extends('layouts.DashB')
@section('content') 

@php
$date =    date_default_timezone_set('Asia/Manila');



@endphp

</div>
<div class="container-fluid " id="reload">
    <div class="row ">

        <div class="col-lg-12 mt-4">

            <div class=" mb-0">
                <h4 class="font-weight-bolder text-white "> Tithes & Offerings / Report  </h4> 
            </div>

            <div class="no-gutters row">
                <div class="d-flex justify-content-between ">
                    <span class="text-left text-white"> @php  $dtae = date_default_timezone_set('Asia/Manila') @endphp {{  date('F j, Y g:i:a') }}</span>
                </div>
            </div>
        
            <div class="container-fluid bg-white mt-5">
                <div class="row">
                    <div class="d-flex  justify-content-between ">
                        <div class="p-2"> 
                            <h3 class="pt-2" > View  Details </h3>
                            <a href="/tithes&offerings/reports"> <br>
                                <span id="goback_view_details" class="text-gray text-sm" > <i class="las la-arrow-left" 
                                style="font-size: 20px">   </i> <span > GO BACK </span> </span>                   
                            </a>
                        </div>
                
                        <div class="ml-auto m-3">
                            <form>
                                @csrf

                                <!-- <input type="hidden" name="dsSTAT" value="2">                                  
                                <input type="hidden" name="dsAMNT" value="{{ $tithe_view->dsAMNT }}">
                                <input type="hidden" name="dsTYPE" value="{{ $tithe_view->dsTYPE }}"> -->

                                <input type="hidden" name="updated_at" value= ' {{ date("d-m-Y H:i:s") }} '>

                                    <a href="/tithe_edit/{{ $tithe_view->toID }}">
                                        <span id="edit_view_details" class="text-sm btn btn-sm btn-info "  data-bs-toggle="tooltip"  
                                        title="Edit"> <i class="las la-edit" style="font-size: 20px"></i>   </span>                   
                                    </a>

                                    <a  href="#" onclick="tithe_remove({{$tithe_view->toID }})"  class=" $tithe_view->toID">
                                        <span id="remove_view_details" class="text-sm btn btn-sm btn-danger " data-bs-toggle="tooltip"  
                                        title="Remove" ><i class="las la-trash"  style="font-size: 20px"></i> </span>                   
                                    </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>         

            <div class="container-fluid rounded bg-white">
                <div class="row">

                    <div class="col-md-1 border-right">
                    </div>

                    <div class="col-md-6 border-right">
                        <div class="p-3 pt-4 pb-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right"><strong class=" text-uppercase"> Tithe INFORMATION</strong></h4>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-12" id="name_contributor_view_details">
                                    <label class="labels  text-uppercase"> Name of the Contributor </label> 
                                    <input type="text" class="form-control"  name="member_ID" 
                                    value="{{ $tithe_view->firstname  }} {{ $tithe_view->lastname  }}" readonly>
                                </div>

                                <div class="col-md-12" id="tithes_amount_view_details">
                                    <label class="labels  text-uppercase"> Tithes Amount </label> 
                                    <input type="text" class="form-control"  name="tithes_offer_tithe_amount" 
                                    value="{{ $tithe_view->tithes_offer_tithe_amount }}" readonly>
                                </div>
                                <div class="col-md-12" id="offerings_view_details">
                                    <label class="labels  text-uppercase"> Offering Plan Amount </label> 
                                    <input type="text" class="form-control"  name="tithes_offer_offering_plan_amount" 
                                    value="{{ $tithe_view->tithes_offer_offering_plan_amount }}" readonly>
                                </div>
                                <div class="col-md-12" id="others_gift_view_details">
                                    <label class="labels  text-uppercase"> Other Gifts Amount </label> 
                                    <input type="text" class="form-control"  name="tithes_offer_other_gifts_amount" 
                                    value="{{ $tithe_view->tithes_offer_other_gifts_amount }}" readonly>
                                </div>

                                <div class="col-md-12" id="requested_date_view_details">
                                    <label class="labels  text-uppercase"> Request Date </label> 
                                    <input type="text" class="form-control"  name="created_at" value="{{ $tithe_view->created_at }}" readonly>
                                </div>                      
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mt-3 mb-5">
                        <div class="p-3 py-5">
                            <div class="mt-5"> 
                                <div class="row">
                                    <div class="col-md-6 text-uppercase text-xs d-flex justify-content-start" id="status_view_details">
                                        <b> Status:</b>
                                    </div>
                                    @if($tithe_view->tithes_offer_approval == '1') 
                                    <div class="col-md-6 text-uppercase text-xs d-flex justify-content-end" id="status_view_details">
                                        <span class="badge badge-xs bg-gradient-warning text-sm">  Pending </span> 
                                    </div>
                                    @else
                                    <div class="col-md-6 text-uppercase text-xs d-flex justify-content-end" id="status_view_details">
                                        <span  class="badge badge-xs bg-gradient-success  text-sm">  Approved </span>
                                    </div>
                                    @endif  
                                </div> 
                            </div>
                            <div class="">
                                <div class="col-md-12 mt-2" id="added_by_view_details">
                                    <label class="labels  text-uppercase"> Added By: </label>         
                                    <input type="text" class="form-control" value="  {{ $officer_incharge->lastname }}  {{ $officer_incharge->firstname }}   {{ $officer_incharge->middlename }}   " readonly>
                                </div> <br>

                                    @if($tithe_view->tithes_offer_approval == '2' ) 
                                        <div class="col-md-12" id="request_approved_view_details">
                                            <label class="labels  text-uppercase"> Request APPROVED </label> 
                                            <input type="text" class="form-control"  value="{{ $tithe_view->updated_at  }}" readonly>
                                        </div>

                                    @else
                                        <div class="col-md-12 text-uppercase text-xs d-flex justify-content-between" id="request_approved_view_details">
                                            <span class="labels"> <b>  Date Approve </b> </span>  
                                        </div>
                                    @endif


                                <div class="col-md-12">
                                    <div class="col-md-12" id="description_view_details">
                                        <label class="labels text-uppercase"> Description </label> 
                                        <textarea  class="form-control" name="tithes_offer_other_gifts_desciption"  value="" readonly> {{ $tithe_view->tithes_offer_other_gifts_desciption  }}  </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<script>
    
function tithe_remove(toID) {
        swal.fire({
            title: "Move to trash?",
            icon: 'question',
            text: "You can still retrive the record in the Trash!",
            showCancelButton: !0,
            confirmButtonText: "Yes, Move it!",
            confirmButtonColor: '#2dce89',
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then((result) => {

            if (result.isConfirmed) {

                $("#overlay").fadeIn(300);　

                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "/delete_tithe/" + toID,
                    data: {_token: CSRF_TOKEN},
                    // dataType: 'JSON',
                    // processData: true,
                    // contentType: false,
                    success: function (results) {
                      
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                                toastr.success("You have successfully move the record to trash!");

                        // refresh page after 2 seconds
                        setTimeout(function(){
                            $("#overlay").fadeOut(300);
                            $("#notifDiv").fadeOut();
                            $("#pending").load(window.location.href + " #pending" );
                            $("#reload1").load(window.location.href + " #reload1" );
                            $("#Notifs_list").load(window.location.href + " #Notifs_list" );
                            window.location = "/ad_reports";
                        },2000);
                    }
                });

            }
        
        }, function (dismiss) {
            return false;
    })
}
</script>

@endsection