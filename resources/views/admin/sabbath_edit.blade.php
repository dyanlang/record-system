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
                <h4 class="font-weight-bolder text-white "> Sabbath Offerings / Report  </h4> 
            </div>
            <div class="no-gutters row">
                <div class="d-flex justify-content-between ">
                    <span class="text-left text-white"> @php  $dtae = date_default_timezone_set('Asia/Manila') @endphp {{  date('F j, Y g:i:a') }}</span>
            <!-- button ADD -->
                  
                </div>
            </div>
        
            <div class="container-fluid bg-white mt-5 ">
                <div class="row">
                    <div class="d-flex  justify-content-between ">
                        <div class="p-2 mt-4  "> 
                            
                                <a href="/sabbath-offerings/records">
                                    <span id="goback_sabbath_offerings_edit" class="text-gray text-sm" > <i class="las la-arrow-left" style="font-size: 20px">   </i> <span > Go back </span> </span>                   
                                </a>
                            </div>

                            <div class="ml-auto  m-4">
                                    <form id="reload">
                                        @csrf
                                        <button  type="btn" class="btn text-white btn-sm btn-success mx-1 btn-save">
                                            <span id="save_button_sabbath_offerings_edit" class="text-sm" > <i class="las la-save"  style="font-size: 20px"></i> </span>                   
                                        </button>
                                </div>
                            </div>
                                 

                            <div class="container-fluid rounded bg-white mt-2">
                                <div class="row pb-2">
                                    <div class="col-md-1 border-right">
                                    </div>
                                    <div class="col-md-6 border-right">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="text-right"><strong class=" text-uppercase"> Edit Sabbath Offering Details</strong></h4>
                                        </div>
                                        <div class="p-3">
                                            <div class="row mt-3">

                                                <div class="col-md-12" id="offering_amount_sabbath_offerings_edit">
                                                    <div class="form-group">
                                                        <label for="tithes_offer_offering_plan_amount">Offering Plan Amount</label>

                                                        <input type="text" class="form-control" name="tithes_offer_offering_plan_amount" id="tithes_offer_offering_plan_amount" 
                                                            value="{{ $sabbath_edit->tithes_offer_offering_plan_amount }}">
                                            
                                                    </div>
                                                </div>
                                            </div>

                                   

                                    

                                            <div class="col-md-12" id="description_sabbath_offerings_edit">
                                                <div class="form-group">
                                                    <label for="tithes_offer_other_gifts_desciption">Description</label>

                                                    <input type="text" class="form-control" name="tithes_offer_other_gifts_desciption" id="tithes_offer_other_gifts_desciption" 
                                                        value="{{ $sabbath_edit->tithes_offer_other_gifts_desciption }}">
                                                    
                                                </div>
                                            </div>

                                            <input type="hidden" name="tithes_offer_type" id="tithes_offer_type" value="{{$sabbath_edit->tithes_offer_type}}">


                                            <div class="col-md-12" id="type_sabbath_offerings_edit">
                                                <div class="form-group">
                                                    <label for="tithes_offer_type">Type:</label>
                                                        <select class="form-control" name="tithes_offer_type" id="tithes_offer_type" value="{{ $sabbath_edit->tithes_offer_type }}">
                                                            <option disabled selected value="{{ $sabbath_edit->tithes_offer_type }}">- {{ $sabbath_edit->tithes_offer_type }} -</option>
                                                            <option value="Cash">Cash</option>
                                                                                                                
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
            
            let Offer = $('#tithes_offer_offering_plan_amount').val();
            let Description = $('#tithes_offer_other_gifts_desciption').val();
            let Type = $('#tithes_offer_type').val();

            
     
            $("#overlay").fadeIn(300);　
            const form = $(this).parents('form');

            $(form).validate({
             
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/sabbath_update/{{ $sabbath_edit->toID }}',
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
                              
                                toastr.success("You have successfully modify sabbath offering record!");
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