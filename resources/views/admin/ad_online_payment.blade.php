@extends('layouts.DashB')
@section('content')

<section>
<div class="container-fluid">


<div class="row" id="Tithes">
    <div class="col-lg-12 mt-4">
        <div class="mb-1 row">
        @include('layouts.reports-layout.ad_report_includes')
        </div>
     <br> 
    

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card mb-4 p-3">
                        <a  href="{{ url('/tithes&offerings/reports') }}" >
                            <span class="text-gray" id="gcash_bank_goback_online_payments">
                                <i class="las la-arrow-left" style="font-size: 22px"></i>
                                <span> 
                                    GO BACK
                                </span> 
                            </span>                   
                        </a>
                        <div class="card-header text-center">
                                    
                            <!--<div class="d-flex justify-content-between mb-3 ">            
                                <div>
                                    <a href="/ad_reports">
                                        <span class="text-gray" id="gcash_bank_goback_online_payments">
                                            <i class="las la-arrow-left" style="font-size: 22px"></i>
                                            <span> 
                                                GO BACK
                                            </span> 
                                        </span>                   
                                    </a>
                                </div>
                                
                            </div>-->
                        </div>

                        <div class="bs-example mb-3">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="nav-item" id="gcash_bank_list_online_payments">
                                    <a href="#gcash_record" class="nav-link bg-success active" data-toggle="tab" style="color: white">
                                        GCASH
                                    </a>
                                </li>
                                <li class="nav-item" id="gcash_bank_list_online_payments">
                                    <a href="#bank_record" class="nav-link bg-success" data-toggle="tab" style="color: white">
                                        BANK
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content" id="gcash_bank_list__record_online_payments">
                            <div id="gcash_record" class="tab-pane fade show active">

                                <div class="card-body overflow-auto" id="reload_after_1">
                                
                                    <h4 >GCash Records</h4>

                                    @if($gcash_records->count() > 0)
                                        @foreach ($gcash_records as $gcash_pay)
                                            <div class="list-group overflow-hidden">
                                                <div class=" list-group-item-custom cursor-pointer list-group-item">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <div class="container">
                                                                <div class="row my-3">
                                                                    <div class="col-md-4">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> 
                                                                            Type
                                                                        </p>
                                                                        <h6 class="text-gray text-sm">
                                                                            <span>
                                                                                <a href="#" data-bs-toggle="tooltip" title="View Details" data-toggle="modal" data-target="#gcash_pay{{ $gcash_pay->oID }}"> 
                                                                                    {{ $gcash_pay->on_type }}
                                                                                </a>
                                                                            </span>
                                                                        </h6>
                                                                        
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> 
                                                                            Date Created
                                                                        </p>
                                                                        <h6 class="text-gray text-sm">
                                                                            {{ $gcash_pay->created_at->toDateString() }}
                                                                        </h6>
                                                                    </div>

                                                                    <div class="justify-content-end align-items-center col-md-4 ">
                                                                        <div class="d-flex justify-content-end align-items-start ">
                                                                            
                                                                                <div class="justify-content-space-between mx-1">
                                                                                    @if ($gcash_pay->on_status == "Visible")

                                                                                        <form method="POST" action="/online_payment_hidden/{{ $gcash_pay->oID }}" enctype="multipart/form-data">
                                                                                            @csrf
                                                                                            @method('PUT')

                                                                                            <input type="hidden" name="on_status" id="on_status" value="Hidden">

                                                                                            <button id="gcash_bank_list_view_button_record_online_payments" type="submit" class="btn btn-success btn-sm  mb-0" data-bs-toggle="tooltip" title="Visible">
                                                                                                <i class="las la-eye" style="font-size: 20px"></i>
                                                                                            </button>
                                                                                        </form>
                                                                                    

                                                                                    @elseif ($gcash_pay->on_status == "Hidden")

                                                                                        <form method="POST" action="/online_payment_visible/{{ $gcash_pay->oID }}" enctype="multipart/form-data">
                                                                                            @csrf
                                                                                            @method('PUT')

                                                                                            <input id="gcash_bank_list_view_button_record_online_payments" type="hidden" name="on_status" id="on_status" value="Visible">
                                                                                            
                                                                                            <button type="submit" class="btn btn-danger btn-sm  mb-0" data-bs-toggle="tooltip" title="Hidden">
                                                                                                <i class="las la-eye-slash" style="font-size: 20px"></i>
                                                                                            </button>
                                                                                        </form>
                                                                                    @endif
                                                                                </div>
                                                                           

                                                                            <div class="col-md-2 mx-1">
                                                                                
                                                                                <form method="POST" action="/delete_online_payment/{{ $gcash_pay->oID }}" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    @method('PUT')

                                                                                    <input type="hidden" name="on_delete_status" id="on_delete_status" value="Deleted">
                                                                                    
                                                                                    <button id="gcash_bank_list_view_remove_record_online_payments" type="submit" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Delete">
                                                                                        <i class="las la-trash" style="font-size: 20px"></i>
                                                                                    </button>
                                                                                </form>
                                                                        
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="gcash_pay{{ $gcash_pay->oID }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary">
                                                            <h5 class="modal-title text-white" id="staticBackdropLabel">
                                                                Payment Details
                                                            </h5>
                                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <center>
                                                                            <img src="/payments/{{ $gcash_pay->on_gcash_image }}" alt="avatar" class="img-fluid" style="max-width: 100%;">
                                                                        </center>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                            <label style="font-size: 14px">Account Name:</label>
                                                                            <p style="background-color: #e3e3e3; border: 1px solid gray; border-radius: 6px; font-size: 14px; padding: 5px">
                                                                                {{ $gcash_pay->on_account_name }}
                                                                            </p>

                                                                            <label style="font-size: 14px">Contact Number:</label>
                                                                            <p style="background-color: #e3e3e3; border: 1px solid gray; border-radius: 6px; font-size: 14px; padding: 5px">
                                                                                {{ $gcash_pay->on_contact_number }}
                                                                            </p>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach

                                    @else
                                        
                                        <div class="text-gray p-4"> 
                                            <h5 class="opacity-2"> There's no recent records here. </h5>
                                        </div>
                                
                                    @endif
                                </div>
                            </div>

                            <div id="bank_record" class="tab-pane fade">

                                <div class="card-body overflow-auto" id="reload_after_2">

                                    <h4 >Bank Records</h4>

                                    @if($bank_records->count() > 0)
                                        @foreach ($bank_records as $bank_pay)
                                            <div class="list-group overflow-hidden">
                                                <div class=" list-group-item-custom cursor-pointer list-group-item">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <div class="container">
                                                                <div class="row my-2">
                                                                    <div class="col-md-4">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> 
                                                                            Type
                                                                        </p>
                                                                        <h6 class="text-gray text-sm">
                                                                            <span>
                                                                                <a href="#" data-bs-toggle="tooltip" title="View Details" data-toggle="modal" data-target="#bank_pay{{ $bank_pay->oID }}"> 
                                                                                    {{ $bank_pay->on_type }}
                                                                                </a>
                                                                            </span>
                                                                        </h6>
                                                                        
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> 
                                                                            Date Created
                                                                        </p>
                                                                        <h6 class="text-gray text-sm">
                                                                            {{ $bank_pay->created_at->toDateString() }}
                                                                        </h6>
                                                                    </div>


                                                                    <div class="justify-content-end align-items-center col-md-4 ">
                                                                        <div class="d-flex justify-content-end align-items-start ">
                                                                            <div class="justify-content-space-between" id="gcash_bank_list_view_button_record_online_payments">
                                                                                
                                                                                @if ($bank_pay->on_status == "Visible")

                                                                                    <form method="POST" action="/online_payment_hidden/{{ $bank_pay->oID }}" enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        @method('PUT')

                                                                                        <input type="hidden" name="on_status" id="on_status" value="Hidden">

                                                                                        <button id="gcash_bank_list_view_button_record_online_payments" type="submit" class="btn btn-success btn-sm  mb-0 mx-1" 
                                                                                        data-bs-toggle="tooltip" title="Visible">
                                                                                            <i class="las la-eye" style="font-size: 20px"></i>
                                                                                        </button>
                                                                                    </form>

                                                                                @elseif ($bank_pay->on_status == "Hidden")

                                                                                    <form method="POST" action="/online_payment_visible/{{ $bank_pay->oID }}" enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        @method('PUT')

                                                                                        <input type="hidden" name="on_status" id="on_status" value="Visible">
                                                                                        
                                                                                        <button id="gcash_bank_list_view_button_record_online_payments" type="submit" class="btn btn-danger btn-sm  mb-0 mx-1" 
                                                                                        data-bs-toggle="tooltip" title="Hidden">
                                                                                            <i class="las la-eye-slash" style="font-size: 20px"></i>
                                                                                        </button>
                                                                                    </form>
                                                                                @endif
                                                                                
                                                                            </div>

                                                                            <div class="col-md-2 mx-1" id="gcash_bank_list_view_remove_record_online_payments">
                                                                                <form method="POST" action="/delete_online_payment/{{ $bank_pay->oID }}" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    @method('PUT')

                                                                                    <input type= "hidden" name="on_delete_status" id="on_delete_status" value="Deleted">
                                                                                    
                                                                                    <button id="gcash_bank_list_view_remove_record_online_payments" type="submit" class="btn btn-warning btn-sm mb-0 mx-1" 
                                                                                    data-bs-toggle="tooltip" title="Delete">
                                                                                        <i class="las la-trash" style="font-size: 20px"></i>
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="bank_pay{{ $bank_pay->oID }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary">
                                                            <h5 class="modal-title text-white" id="staticBackdropLabel">
                                                                Payment Details
                                                            </h5>
                                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label style="font-size: 14px">Bank Name:</label>
                                                                        <p style="background-color: #e3e3e3; border: 1px solid gray; border-radius: 6px; font-size: 14px; padding: 5px">
                                                                            {{ $bank_pay->on_bank_name }}
                                                                        </p>

                                                                        <label style="font-size: 14px">Account Name:</label>
                                                                        <p style="background-color: #e3e3e3; border: 1px solid gray; border-radius: 6px; font-size: 14px; padding: 5px">
                                                                            {{ $bank_pay->on_account_name }}
                                                                        </p>

                                                                        <label style="font-size: 14px">Account Number:</label>
                                                                        <p style="background-color: #e3e3e3; border: 1px solid gray; border-radius: 6px; font-size: 14px; padding: 5px">
                                                                            {{ $bank_pay->on_bank_account_number }}
                                                                        </p>

                                                                        <label style="font-size: 14px">Contact Number:</label>
                                                                        <p style="background-color: #e3e3e3; border: 1px solid gray; border-radius: 6px; font-size: 14px; padding: 5px">
                                                                            {{ $bank_pay->on_contact_number }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    @else
                                        
                                        <div class="text-gray p-4"> 
                                            <h5 class="opacity-2"> There's no recent records here. </h5>
                                        </div>
                                
                                    @endif

                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card mb-4 p-3">
                        <div class="card-header">
                            <h3>Add Payment Method</h3>
                        </div>

                        <div class="bs-example ml-5 mb-2" >
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="nav-item" id="gcash__bank_add_payment_online_payments">
                                    <a href="#gcash" class="nav-link bg-success active" data-toggle="tab" style="color: white">
                                        GCASH
                                    </a>
                                </li>
                                <li class="nav-item" id="gcash__bank_add_payment_online_payments">
                                    <a href="#bank" class="nav-link bg-success" data-toggle="tab" style="color: white">
                                        BANK
                                    </a>
                                </li>
                            </ul>
                        </div>


                        <div class="tab-content" >
                            <div id="gcash" class="tab-pane fade show active">
                                <div class="card-body" id="gcash__bank_credentials_online_payments">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <h4>GCash Details</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form id="main_form_1">
                                                <div class="container p-0">
                                                    <div class="row mb-2">
                                                        <div class="col-md-3">
                                                            <label for="on_account_name"><i style="color: red">*</i> Account Name</label>
                                                        </div>
                                                
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" name="on_account_name" id="on_account_name" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-3">
                                                            <label for="on_contact_number"><i style="color: red">*</i> Contact Number</label>
                                                        </div>
                                                
                                                        <div class="col-md-9">
                                                            <input type="number" class="form-control" name="on_contact_number" id="on_contact_number" min="0" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-3">
                                                            <label for="on_image">Image <i>(Optional)</i></label>
                                                        </div>
                                                
                                                        <div class="col-md-9">
                                                            <input type="file" class="form-control" name="on_gcash_image" id="on_gcash_image">
                                                            <span>
                                                                <i style="font-size: 12px">(ex. QR code of your GCash)</i>
                                                            </span>
                                                        </div>

                                                    </div>
                                                    
                                                    <input type="hidden" name="on_type" id="on_type" value="GCash" />

                                                    <div class="row mt-4 d-flex justify-content-end">
                                                        <div class="col-md-11">
                                                            <button id="gcash_bank_button_submit_online_payments" class="btn btn-success btn-save-gcash" style="float: right">
                                                            <i class="las la-save" style="font-size: 20px"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="bank" class="tab-pane fade">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <h4>Bank Details</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form id="main_form_2">
                                                <div class="container p-0">

                                                    <div class="row mb-2">
                                                        <div class="col-md-3">
                                                            <label for="on_bank_name"><i style="color: red">*</i> Bank Name</label>
                                                        </div>
                                                
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" name="on_bank_name" id="on_bank_name" required>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-md-3">
                                                            <label for="on_account_name"><i style="color: red">*</i> Account Name</label>
                                                        </div>
                                                
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" name="on_account_name" id="on_account_name" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-3">
                                                            <label for="on_bank_account_number"><i style="color: red">*</i> Account Number</label>
                                                        </div>
                                                
                                                        <div class="col-md-9">
                                                            <input type="number" class="form-control" name="on_bank_account_number" id="on_bank_account_number" min="0" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-3">
                                                            <label for="on_contact_number"><i style="color: red">*</i> Contact Number</label>
                                                        </div>
                                                
                                                        <div class="col-md-9">
                                                            <input type="number" class="form-control" name="on_contact_number" id="on_contact_number" min="0" required>
                                                        </div>
                                                    </div>
                                                    
                                                    <input type="hidden" name="on_type" id="on_type" value="Bank" />

                                                    <div class="d-flex justify-content-end row mt-4">
                                                        <div class="col-md-11">
                                                            <button class="btn btn-success btn-save-bank d-flex justify-content-end" style="float: right"> <i class="las la-save" style="font-size: 20px"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
</section>

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
                let pending = parseInt($('#' + data.fromUser).find('.pending').html());
                if(pending) {
                    $('#' + data.uID).find('.pending').html(pending + 1);
                } else {
                    $('#' + data.uID).html('<a href="#" class="nav-link" data-toggle="dropdown"><i  class="fa fa-bell text-white"><span class="badge badge-danger pending">1</span></i></a>');
                }
            }
        });

        $('.btn-hide').on('click', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let status = $('#on_status').val();

            let oID = $(".btn-hide").attr('data-id');

            const form = $(this).parents('form');

            $(form).validate({
             
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'PUT',
                        url: '/online_payment_hidden/' + oID,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success:function(data) {
                            // console.log(data);
                            if(data.status) {
                               

                                $("#notifDiv").removeClass('alert alert-success');
                                $("#notifDiv").addClass('btn btn-outline-white  ');
                                $("#notifDiv").text(data.message);
                                $("#notifDiv").fadeIn();
                                setTimeout(function(){
                                    $("#notifDiv").fadeOut();
                                }, 3000, );


                                // $('[id="dsSTAT"]').val('');
                                // $('[id="dsAMNT"]').val('');
                                // $('[id="dsTYPE"]').val('');
                                // $('[id="updated_at"]').val('');
                                // $('[id="notif_type"]').val('');

                                //disable the submit button
                                // $(".btn-approve").hide();
                                $(".labels-status").hide();
                                
                                $("#pending").load(window.location.href + " #pending" );
                                $("#reload_1").load(window.location.href + " #reload_1" );
                                $("#Notifs_list").load(window.location.href + " #Notifs_list" );
                                // $('#button').click(function() {
                                //     $(this).val('clicked');
                                // });


                            } else {
                                $("#notifDiv").removeClass('alert alert-success');
                                $("#notifDiv").addClass('alert alert-success');
                                $("#notifDiv").text('Opps! Something went wrong!');
                                $("#notifDiv").fadeIn();
                                setTimeout(function(){
                                    $("#notifDiv").fadeOut();
                                }, 3000, );
                            }
                        },
                        error:function(err) {
                            console.log(err);
                        }
                    });
                }
            });
            
        });

        $('.btn-visible').on('click', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let status = $('#on_status').val();

            let oID = $(".btn-visible").attr('data-id');

            const form = $(this).parents('form');

            $(form).validate({
             
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'PUT',
                        url: '/online_payment_visible/' + oID,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success:function(data) {
                            // console.log(data);
                            if(data.status) {
                               

                                $("#notifDiv").removeClass('alert alert-success');
                                $("#notifDiv").addClass('btn btn-outline-white  ');
                                $("#notifDiv").text(data.message);
                                $("#notifDiv").fadeIn();
                                setTimeout(function(){
                                    $("#notifDiv").fadeOut();
                                }, 3000, );


                                // $('[id="dsSTAT"]').val('');
                                // $('[id="dsAMNT"]').val('');
                                // $('[id="dsTYPE"]').val('');
                                // $('[id="updated_at"]').val('');
                                // $('[id="notif_type"]').val('');

                                //disable the submit button
                                // $(".btn-approve").hide();
                                $(".labels-status").hide();
                                
                                $("#pending").load(window.location.href + " #pending" );
                                $("#reload_1").load(window.location.href + " #reload_1" );
                                $("#Notifs_list").load(window.location.href + " #Notifs_list" );
                                // $('#button').click(function() {
                                //     $(this).val('clicked');
                                // });


                            } else {
                                $("#notifDiv").removeClass('alert alert-success');
                                $("#notifDiv").addClass('alert alert-success');
                                $("#notifDiv").text('Opps! Something went wrong!');
                                $("#notifDiv").fadeIn();
                                setTimeout(function(){
                                    $("#notifDiv").fadeOut();
                                }, 3000, );
                            }
                        },
                        error:function(err) {
                            console.log(err);
                        }
                    });
                }
            });
            
        });
        
        $('.btn-save-gcash').on('click', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let gcash_account_name = $('#on_account_name').val();
            let gcash_contact_number = $('#on_contact_number').val();
            let gcash_image = $('#on_gcash_image').val();
            let gcash_type = $('#on_type').val();
            

            const form = $(this).parents('form');

            $(form).validate({
             
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/online_payment_details',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success:function(data) {
                            // console.log(data);
                            if(data.status) {
                               
                                $("#main_form_1")[0].reset();

                                $("#notifDiv").removeClass('alert alert-success');
                                $("#notifDiv").addClass('btn btn-outline-white  ');
                                $("#notifDiv").text(data.message);
                                $("#notifDiv").fadeIn();
                                setTimeout(function(){
                                    $("#notifDiv").fadeOut();
                                }, 3000, );


                                // $('[id="dsSTAT"]').val('');
                                // $('[id="dsAMNT"]').val('');
                                // $('[id="dsTYPE"]').val('');
                                // $('[id="updated_at"]').val('');
                                // $('[id="notif_type"]').val('');

                                //disable the submit button
                                // $(".btn-approve").hide();
                                $(".labels-status").hide();
                                
                                $("#pending").load(window.location.href + " #pending" );
                                $("#reload_1").load(window.location.href + " #reload_1" );
                                $("#reload_2").load(window.location.href + " #reload_2" );
                                $("#reload_after_1").load(window.location.href + " #reload_after_1" );
                                $("#Notifs_list").load(window.location.href + " #Notifs_list" );
                                // $('#button').click(function() {
                                //     $(this).val('clicked');
                                // });


                            } else {
                                $("#notifDiv").removeClass('alert alert-success');
                                $("#notifDiv").addClass('alert alert-success');
                                $("#notifDiv").text('Opps! Something went wrong!');
                                $("#notifDiv").fadeIn();
                                setTimeout(function(){
                                    $("#notifDiv").fadeOut();
                                }, 3000, );
                            }
                        },
                        error:function(err) {
                            console.log(err);
                        }
                    });
                }
            });
            
        });

        $('.btn-save-bank').on('click', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let bank_name = $('#on_bank_name').val();
            let bank_account_name = $('#on_account_name').val();
            let bank_account_number = $('#on_bank_account_number').val();
            let bank_contact_number = $('#on_contact_number').val();
            let bank_type = $('#on_type').val();
            

            const form = $(this).parents('form');

            $(form).validate({
             
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/online_payment_details',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success:function(data) {
                            // console.log(data);
                            if(data.status) {
                               
                                $("#main_form_2")[0].reset();

                                $("#notifDiv").removeClass('alert alert-success');
                                $("#notifDiv").addClass('btn btn-outline-white  ');
                                $("#notifDiv").text(data.message);
                                $("#notifDiv").fadeIn();
                                setTimeout(function(){
                                    $("#notifDiv").fadeOut();
                                }, 3000, );


                                // $('[id="dsSTAT"]').val('');
                                // $('[id="dsAMNT"]').val('');
                                // $('[id="dsTYPE"]').val('');
                                // $('[id="updated_at"]').val('');
                                // $('[id="notif_type"]').val('');

                                //disable the submit button
                                // $(".btn-approve").hide();
                                $(".labels-status").hide();
                                
                                $("#pending").load(window.location.href + " #pending" );
                                $("#reload_1").load(window.location.href + " #reload_1" );
                                $("#reload_2").load(window.location.href + " #reload_2" );
                                $("#reload_after_2").load(window.location.href + " #reload_after_2" );
                                $("#Notifs_list").load(window.location.href + " #Notifs_list" );
                                // $('#button').click(function() {
                                //     $(this).val('clicked');
                                // });


                            } else {
                                $("#notifDiv").removeClass('alert alert-success');
                                $("#notifDiv").addClass('alert alert-success');
                                $("#notifDiv").text('Opps! Something went wrong!');
                                $("#notifDiv").fadeIn();
                                setTimeout(function(){
                                    $("#notifDiv").fadeOut();
                                }, 3000, );
                            }
                        },
                        error:function(err) {
                            console.log(err);
                        }
                    });
                }
            });
            
        });

        
    });
</script>

@endpush