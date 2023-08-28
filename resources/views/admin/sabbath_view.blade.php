@extends('layouts.DashB')
@section('content') 

@php
$date =    date_default_timezone_set('Asia/Manila');



@endphp


<div class="container-fluid " id="reload">
    <div class="row">
        <div class="col-lg-12 mt-4">
            <div class=" mb-0">
                <h4 class="font-weight-bolder text-white "> Sabbath Offerings / Report  </h4> 
            </div>
            <div class="no-gutters row">
                <div class="d-flex justify-content-between ">
                    <span class="text-left text-white"> @php  $dtae = date_default_timezone_set('Asia/Manila') @endphp {{  date('F j, Y g:i:a') }}</span>
                </div>
            </div>
        
            <div class="container-fluid bg-white mt-5 ">
                <div class="row">
                    <div class="d-flex  justify-content-between ">
                        <div class="p-2"> 
                            <h3 class="pt-4 " ></h3>
                                <a href="/sabbath-offerings/records">
                                    <span id="goback_sabbath_offerings_view" class="text-gray text-sm" > <i class="las la-arrow-left" 
                                    style="font-size: 20px">   </i> <span > Go back </span> </span>                   
                                </a>
                            </div>

                            <div class="ml-auto  m-4">
                                    <form>
                                        @csrf


                                        <input type="hidden" name="updated_at" value= ' {{ date("d-m-Y H:i:s") }} '>

                                            <a href="/sabbath_edit/{{ $sabbath_view->toID }}">
                                                <span id="edit_button_sabbath_offerings_view" class="text-sm btn btn-sm btn-info "  data-bs-toggle="tooltip"  
                                                title="Edit"> <i class="las la-edit" style="font-size: 20px"></i>   </span>                   
                                            </a>

                                            <a  href="#" onclick="tithe_remove({{$sabbath_view->toID }})"  class=" $sabbath_view->toID">
                                                <span id="remove_button_sabbath_offerings_view" class="text-sm btn btn-sm btn-danger " data-bs-toggle="tooltip"  
                                                title="Remove" ><i class="las la-trash"  style="font-size: 20px"></i> </span>                   
                                            </a>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="container-fluid rounded bg-white">
                                <div class="row">
                                    <div class="col-md-1 border-right">
                                    </div>
                                    <div class="col-md-6 border-right">
                                        <div class="p-3 pt-4 pb-5">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h4 class="text-right"><strong class=" text-uppercase"> SAbbath offering INFORMATION</strong></h4>
                                            </div>
                                            
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <div class="col-md-12" id="description_sabbath_offerings_view">
                                                        <label class="labels text-uppercase"> Description </label> 
                                                        <textarea  class="form-control" name="tithes_offer_other_gifts_desciption"  value="" readonly> {{ $sabbath_view->tithes_offer_other_gifts_desciption  }}  </textarea>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-md-12" id="offering_sabbath_offerings_view">
                                                    <label class="labels  text-uppercase"> Offering Plan Amount </label> 
                                                    <input type="text" class="form-control"  name="tithes_offer_offering_plan_amount" value="{{ $sabbath_view->tithes_offer_offering_plan_amount }}" readonly>
                                                </div>
                                                

                                                <div class="col-md-12" id="requestdate_sabbath_offerings_view">
                                                    <label class="labels  text-uppercase"> Request Date </label> 
                                                    <input type="text" class="form-control"  name="created_at" value="{{ $sabbath_view->created_at }}" readonly>
                                                </div>                      
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mt-3">
                                        <div class="p-3 py-5">
                                            <div class="mt-5"> 
                                                <div class="row">
                                                    <div class="col-md-6 text-uppercase text-xs d-flex justify-content-start" id="status_view_details">
                                                        <b> Status:</b>
                                                    </div>
                                                    @if($sabbath_view->tithes_offer_approval == '1') 
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
                                            
                                            <div class="col-md-12 mt-2" id="addedby_sabbath_offerings_view">
                                                <label class="labels  text-uppercase"> Added By: </label>         
                                                <input type="text" class="form-control" value="  {{ $officer_incharge->lastname }}  {{ $officer_incharge->firstname }}   {{ $officer_incharge->middlename }}   " readonly>
                                            </div> <br>

                                                @if($sabbath_view->tithes_offer_approval == '2' ) 
                                                    <div class="col-md-12" id="requestapproved_sabbath_offerings_view">
                                                        <label class="labels  text-uppercase"> Request APPROVED </label> 
                                                        <input type="text" class="form-control"  value="{{ $sabbath_view->updated_at  }}" readonly>
                                                    </div>

                                                @else
                                                    <div class="col-md-12 text-uppercase text-xs d-flex justify-content-between" id="requestapproved_sabbath_offerings_view">
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
                    url: "/delete_sabbath/" + toID,
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
                            window.location = "/sabbath_offering";
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