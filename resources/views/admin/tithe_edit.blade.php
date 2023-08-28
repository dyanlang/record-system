@extends('layouts.DashB')
@section('content') 

@php
$date =    date_default_timezone_set('Asia/Manila');
@endphp


@if(Session::has('message'))
  toastr.options =
  {
   "closeButton" : true,
   "progressBar" : true
  }
    toastr.success("{{ session('message') }}");
@endif

@if(Session::has('error'))
  toastr.options =
  {
   "closeButton" : true,
   "progressBar" : true
  }
    toastr.error("{{ session('error') }}");
@endif




<div class="container-fluid">
    <div class="row">
        
        <div class="col-lg-12 mt-4">
            <div class=" mb-0">
                <h4 class="font-weight-bolder text-white "> Tithes & Offerings / Report  </h4> 
            </div>
            <div class="no-gutters row">
                <div class="d-flex justify-content-between ">
                    <span class="text-left text-white"> @php  $dtae = date_default_timezone_set('Asia/Manila') @endphp {{  date('F j, Y g:i:a') }}</span>
            <!-- button ADD -->
                  
                </div>
            </div>
        
            <div class="container-fluid bg-white  mt-5 ">
                <div class="row">
                    <div class="d-flex  justify-content-between ">
                        <div class="p-2"> 
                            <h3 class="pt-4 " > View  Details </h3>
                            <a href="/tithes&offerings/reports"> <br>

                                    <span id="go_back_edit_details" class="text-gray text-sm" > <i class="las la-arrow-left" style="font-size: 20px">   </i> <span > GO BACK </span> </span>                   
                                </a>
                            </div>

                            <div class="ml-auto  m-4">
                                    <form id="reload">
                                        @csrf
                                        <button  type="btn" class="btn text-white btn-sm btn-success mx-1 btn-save">
                                            <span id="save_edit_details" class="text-sm" > <i class="las la-save"  style="font-size: 20px"></i> </span>                   
                                        </button>
                                </div>
                            </div>
                                 

                            <div class="container-fluid rounded bg-white">
                                <div class="row pb-2">
                                    <div class="col-md-1 border-right">
                                    </div>
                                    <div class="col-md-6 border-right">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="text-right"><strong class=" text-uppercase"> Edit Tithe Details</strong></h4>
                                        </div>
                                        <div class="p-3">
                                            <div class="row mt-3">
                                                <div class="col-md-12" id="contributor_name_edit_details">
                                                    <div class="form-group">
                                                        <label for="lastname">Contributor's Name</label>

                                                        <input type="text" class="form-control" name="name" id="name" value="{{ $tithe_edit->firstname  }} {{ $tithe_edit->lastname  }}" readonly>
                                                        <input type="hidden" class="form-control" name="uID" id="uID" value="{{ $tithe_edit->uID  }}">
                                                        
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group" id="tithes_amount_edit_details">
                                                        <label for="tithes_offer_tithe_amount">Tithes Amount</label>

                                                        <input type="text" class="form-control" name="tithes_offer_tithe_amount" id="tithes_offer_tithe_amount" 
                                                            value="{{ $tithe_edit->tithes_offer_tithe_amount }}">
                                                        
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group" id="offerings_edit_details">
                                                        <label for="tithes_offer_offering_plan_amount">Offering Plan Amount</label>

                                                        <input type="text" class="form-control" name="tithes_offer_offering_plan_amount" id="tithes_offer_offering_plan_amount" 
                                                            value="{{ $tithe_edit->tithes_offer_offering_plan_amount }}">
                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mt-4">
                                        <div class="p-3 py-5">
                                            <div class="col-md-12">
                                                <div class="form-group" id="others_gift_edit_details">
                                                    <label for="tithes_offer_other_gifts_amount">Other Gifts Amount</label>

                                                    <input type="text" class="form-control" name="tithes_offer_other_gifts_amount" id="tithes_offer_other_gifts_amount" 
                                                        value="{{ $tithe_edit->tithes_offer_other_gifts_amount }}">
                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group" id="description_edit_details">
                                                    <label for="tithes_offer_other_gifts_desciption">Description</label>

                                                    <input type="text" class="form-control" name="tithes_offer_other_gifts_desciption" id="tithes_offer_other_gifts_desciption" 
                                                        value="{{ $tithe_edit->tithes_offer_other_gifts_desciption }}">
                                                    
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="form-group" id="type_edit_details">
                                                    <label for="tithes_offer_type">Type:</label>
                                                        <select type="text" class="form-control"name="tithes_offer_type" id="tithes_offer_type"
                                                        value='
                                                          '
                                                                                        
                                                            required autocomplete="tithes_offer_type" autofocus>

                                                            <option value="Cash">Cash</option>
                                                            <option value="Online Payment">Online Payment</option>
                                                            <option value="Check">Check</option>
                                                            <option value="">None</option>
                                                        </select> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </form>     
@endsection


@push('javascript')
<script>
    $(document).ready(function() {
        var pusher = new Pusher('c6e7dc5a924cf5698b26', {
        cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            if(data.uID) {
                let pending = parseInt($('#' + data.uID).find('.pending').html());
                if(pending) {
                    $('#' + data.uID).find('.pending').html(pending + 1);
                } else {
                    $('#' + data.uID).html('<a href="#" class="nav-link" data-toggle="dropdown"><i  class="fa fa-bell text-white"><span class="badge badge-danger pending">1</span></i></a>');
                }
            }
        });

        
        $('.btn-save').on('click', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            let uID = $('#uID').val();
            let Tithe = $('#tithes_offer_tithe_amount').val();
            let Offer = $('#tithes_offer_offering_plan_amount').val();
            let Other = $('#tithes_offer_other_gifts_amount').val();
            let Description = $('#tithes_offer_other_gifts_desciption').val();
            let Type = $('#tithes_offer_type').val();
    
            $("#overlay").fadeIn(300);　
            const form = $(this).parents('form');

            $(form).validate({
             
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/update_tithes/{{$tithe_edit->toID }}',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success:function(data) {
                            console.log(data);
                            if(data.status) {
                               
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
                                    "timeOut": "3000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                                toastr.success("You have modified the record successfully!");

                                setTimeout(function(){
                                    $("#overlay").fadeOut(300);
                                    $("#notifDiv").fadeOut();
                                    $("#pending").load(window.location.href + " #pending" );
                                    $("#reload").load(window.location.href + " #reload" );
                                    $("#Notifs_list").load(window.location.href + " #Notifs_list" );
                                  
                                }, 3000, );



                                //disable the submit button
                                $(".btn-approve").hide();
                                $(".labels-status").hide();
                                
                                $("#pending").load(window.location.href + " #pending" );
                                $("#reload").load(window.location.href + " #reload" );
                                $("#Notifs_list").load(window.location.href + " #Notifs_list" );
                                // $('#button').click(function() {
                                //     $(this).val('clicked');
                                // });


                            } else {
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
                                toastr.error("Opps! Something went wrong, please try again!");
                                setTimeout(function(){
                                    $("#overlay").fadeOut(300);
                                }, 3000, )
                            }
                        },
                        error:function(err) {
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
                                toastr.error(err);
                                setTimeout(function(){
                                    $("#overlay").fadeOut(300);;
                                }, 3000, );
                        }
                    });
                }
            });
            
        });
    });
</script>
@endpush