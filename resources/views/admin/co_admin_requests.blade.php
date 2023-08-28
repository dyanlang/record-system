@extends('layouts.DashB')
@section('content')

<div class="container-fluid">


<div class="row" id="Tithes">
    <div class="col-lg-12 mt-4">
        <div class="mb-1 row">
        @include('layouts.reports-layout.ad_report_includes')
        </div>
     <br> 

            <div class="container-fluid bg-white p-3">
            <a href="/tithes&offerings/reports">
                    <span id="approval_list_goback_payments" class="text-gray"> <i class="las la-arrow-left" style="font-size: 22px"></i>
                        <span>
                            GO BACK
                        </span>
                    </span>                   
                </a>

                    <br><br>

                <span>
                    <i style="font-size: 12px">
                        These are Church Member requests that have been checked by the Co-Admin and need to be approved by a higher admin.
                    </i>
                </span>
            </div>

            <div class="overflow-hidden">
                <div class="row">
                    <div class="col-lg p-0">
                        <div class="card pb-3" id="reload">

                            @if($co_admin_req->count() > 0)
                                @foreach ($co_admin_req as $index => $values)
                                
                                    <form method="POST" action="/approve_co_admin_request/{{ $values['toID'] }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="co_admin_uID" id="co_admin_uID" value="{{ $values['tithes_offer_approved_by'] }}"/>

                                        <input type="hidden" name="member_ID" id="member_ID" value="{{ $values['member_ID'] }}"/>

                                        <div class="list-group mx-4 ">
                                            <div class=" list-group-item-custom cursor-pointer list-group-item">
                                                <div class="media">
                                                    <div class="media-body" id="approval_list_approval_payments">
                                                        <div class="row my-2">
                                                            <div class="col-md-3">
                                                                <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                    Checked by Co-Admin
                                                                </p>
                                                                <h6 class="text-gray">
                                                                    <span>
                                                                        <h6 class="text-sm">
                                                                            <a href="" data-toggle="modal" data-target="#co_admin_req_{{ $values['toID'] }}">{{ $values['firstname'] }} {{ $values['lastname'] }}</a>
                                                                        </h6>
                                                                    </span>
                                                                </h6>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                    Status
                                                                </p>
                                                                @if ($values['tithes_offer_church_member_request'] == 'For Approval')
                                                                    <span  class="badge badge-xs bg-gradient-info">
                                                                        For Approval
                                                                    </span>
                                                                @endif  
                                                            </div>

                                                            <div class="col-md-3">
                                                                <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                    Date Requested
                                                                </p>
                                                                <h6 class="text-gray">
                                                                    <span>
                                                                        <h6 class="text-sm">
                                                                            {{ $values['updated_at']->toDateString() }}
                                                                        </h6>
                                                                    </span>
                                                                </h6> 
                                                            </div>

                                                            <div class="modal fade" id="co_admin_req_{{ $values['toID'] }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-primary">
                                                                            <h5 class="modal-title text-white" id="staticBackdropLabel">{{ $values['firstname'] }} {{ $values['lastname'] }}'s Request</h5>
                                                                            <button type="button" class="btn-sm btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                        </div>

                                                                        <div class="container">
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col">

                                                                                        <div class="row mb-2">
                                                                                            <label for="tithes_offer_tithe_amount" class="col-md-3">Processed By</label>

                                                                                            <div class="col-md-8">
                                                                                                <span  class="badge badge-xs bg-gradient-secondary">
                                                                                                    CHURCH MEMBER
                                                                                                </span>
                                                                                            </div>

                                                                                        </div>

                                                                                        <div class="row mb-2">
                                                                                            <label for="tithes_offer_tithe_amount" class="col-md-3">Tithes Amount</label>

                                                                                            <div class="col-md-8">
                                                                                                <input id="tithes_offer_tithe_amount" type="text" class="form-control" name="tithes_offer_tithe_amount" value="₱ {{ number_format($values['tithes_offer_tithe_amount'], 2) }}" readonly>
                                                                                            </div>

                                                                                        </div>

                                                                                        <div class="row mb-2">
                                                                                            <label for="tithes_offer_offering_plan_amount" class="col-md-3">Offering Plan Amount</label>

                                                                                            <div class="col-md-8">
                                                                                                <input id="tithes_offer_offering_plan_amount" type="text" class="form-control" name="tithes_offer_offering_plan_amount" value="₱ {{ number_format($values['tithes_offer_offering_plan_amount'], 2) }}" readonly>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row mb-2">
                                                                                            <label for="tithes_offer_other_gifts_amount" class="col-md-3">Other Gifts Amount</label>
                                                                                            <div class="col-md-8">
                                                                                                <input id="tithes_offer_other_gifts_amount" type="text" class="form-control" name="tithes_offer_other_gifts_amount" value="₱ {{ number_format($values['tithes_offer_other_gifts_amount'], 2) }}" readonly>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row mb-2">
                                                                                            <label for="tithes_offer_other_gifts_desciption" class="col-md-3">Description</label>
                                                                                            <div class="col-md-8">
                                                                                                <input id="tithes_offer_other_gifts_desciption" type="text" class="form-control" name="tithes_offer_other_gifts_desciption" value="{{ $values['tithes_offer_other_gifts_desciption'] }}" readonly>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row mb-2">
                                                                                            <label for="tithes_offer_type" class="col-md-3">Type</label>
                                                                                            <div class="col-md-8">

                                                                                                @if ($values['tithes_offer_type'] == 'Cash')
                                                                                                    <span  class="badge badge-xs bg-gradient-warning">
                                                                                                        Cash
                                                                                                    </span>
                                                                                                @elseif ($values['tithes_offer_type'] == 'GCash')
                                                                                                    <span  class="badge badge-xs bg-gradient-success">
                                                                                                        GCash
                                                                                                    </span>

                                                                                                @elseif ($values['tithes_offer_type'] == 'Bank')
                                                                                                    <span  class="badge badge-xs bg-gradient-info">
                                                                                                        Bank
                                                                                                    </span>
                                                                                                @else
                                                                                                    <span  class="badge badge-xs bg-gradient-secondary">
                                                                                                        None
                                                                                                    </span>
                                                                                                @endif

                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row mb-2">
                                                                                            <label for="tithes_offer_type" class="col-md-3">Receipt</label>
                                                                                            <div class="col-md-8">

                                                                                                <img src="/tithes_offer/{{ $values['tithes_reciept'] }}" alt="avatar" class="img-fluid" style="max-width: 100%;">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex justify-content-end col-md-3">
                                                                <div class="d-flex justify-content-end align-items-start ">
                                                                    
                                                                    <button id="approval_mark_as_review_approval_payments" type="submit" class="btn btn-primary btn-sm">
                                                                        <span data-bs-toggle="tooltip">
                                                                            <i class="fa fa-check mx-2"></i> Mark as Reviewed
                                                                        </span>
                                                                    </button>                                                                    
                                                                
                                                                </div>
                                                            </div> 
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

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
        
        $('.btn-approve').on('click', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let co_adminID = $('#co_admin_uID').val();
            let memberID = $('#member_ID').val();
            let tithe_amount = $('#tithes_offer_tithe_amount').val();
            let offer_plan_amount = $('#tithes_offer_offering_plan_amount').val();
            let gifts_amount = $('#tithes_offer_other_gifts_amount').val();
            let desc = $('#tithes_offer_other_gifts_desciption').val();
            let tTYPE = $('#tithes_offer_type').val();

            let toID = $(".btn-approve").attr('data-id');

            const form = $(this).parents('form');

            $(form).validate({
             
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/approve_co_admin_request/' + toID ,
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
                                $("#reload").load(window.location.href + " #reload" );
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

        $('.btn-decline').on('click', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            let tithe_amount = $('#tithes_offer_tithe_amount').val();
            let offer_plan_amount = $('#tithes_offer_offering_plan_amount').val();
            let gifts_amount = $('#tithes_offer_other_gifts_amount').val();
            let desc = $('#tithes_offer_other_gifts_desciption').val();
            let tTYPE = $('#tithes_offer_type').val();

            let toID = $(".btn-decline").attr('data-id');

            const form = $(this).parents('form');

            $(form).validate({
             
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/decline_co_admin_request/' + toID ,
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
                                $("#reload").load(window.location.href + " #reload" );
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