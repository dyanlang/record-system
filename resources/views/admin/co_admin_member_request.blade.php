@extends('layouts.DashB')
@section('content')
  

<div class="row" id="Tithes">
    <div class="col-lg-12 mt-4">
        <div class="mb-1 row">
        @include('layouts.reports-layout.ad_report_includes')
        </div>
     <br> 


            <div class="container-fluid bg-white p-3">
                <a href="/tithes&offerings/reports">
                    <span class="text-gray" id="goback_church_member_list">
                        <i class="las la-arrow-left" style="font-size: 22px"></i> 
                        <span>
                            GO BACK
                        </span>
                    </span>                   
                </a>

                    <br><br>

                <span>
                    <i style="font-size: 12px">
                        These are Church Member requests that are still pending and have not been checked yet.
                    </i>
                </span>
            </div>

            <div class="overflow-hidden">
                <div class="row">
                    <div class="col-lg p-0">
                        <div class="card pb-3 keep-scrolling" id="reload">

                            @if($member_request->count() > 0)
                                @foreach ($member_request as $tithes)

                                        <div class="list-group mx-4 ">
                                            <div class=" list-group-item-custom cursor-pointer list-group-item">
                                                <div class="media">
                                                    <div class="media-body" id="request_church_member_list">
                                                        <div class="row my-2">
                                                            <div class="col-md-3">
                                                                <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                    Name of Giver
                                                                </p>
                                                                <h6 class="text-gray">
                                                                    <span>
                                                                        <h6 class="text-sm">
                                                                            <a href="" data-toggle="modal" data-target="#member_req_{{ $tithes->toID }}">{{ $tithes->firstname }} {{ $tithes->lastname }}</a>
                                                                            
                                                                        </h6>
                                                                    </span>
                                                                </h6>
                                                            </div>


                                                            <div class="col-md-3">
                                                                <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                    Status
                                                                </p>
                                                                @if ($tithes->tithes_offer_church_member_request == 'Pending')
                                                                    <span  class="badge badge-xs bg-gradient-warning">
                                                                        Pending
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
                                                                            {{ $tithes->created_at->toDateString() }}
                                                                        </h6>
                                                                    </span>
                                                                </h6> 
                                                            </div>

                                                            <div class="modal fade" id="member_req_{{ $tithes->toID }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-primary">
                                                                            <h5 class="modal-title text-white" id="staticBackdropLabel">{{ $tithes->firstname }} {{ $tithes->lastname }}'s Request</h5>
                                                                            <button type="button" class="btn-sm btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                        </div>

                                                                        <div class="container">
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col">

                                                                                        <div class="row mb-2">
                                                                                            <label for="tithes_offer_type" class="col-md-3">Type</label>
                                                                                            <div class="col-md-8">
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
                                                                                        </div>

                                                                                        <div class="row mb-2">
                                                                                            <label for="tithes_offer_tithe_amount" class="col-md-3">Date</label>

                                                                                            <div class="col-md-8">
                                                                                                <input id="	tithes_offer_date" type="date" class="form-control" name="	tithes_offer_date" value="{{ $tithes->tithes_offer_date }}" readonly>
                                                                                            </div>

                                                                                        </div>

                                                                                         <div class="row mb-2">
                                                                                            <label for="tithes_offer_tithe_amount" class="col-md-3">Account No</label>

                                                                                            <div class="col-md-8">
                                                                                                <input id="tithes_account_number" type="text" class="form-control" name="tithes_account_number" value="{{ $tithes->tithes_account_number }}" readonly>
                                                                                            </div>

                                                                                        </div>

                                                                                        <div class="row mb-2">
                                                                                            <label for="tithes_offer_tithe_amount" class="col-md-3">Account Name</label>

                                                                                            <div class="col-md-8">
                                                                                                <input id="tithes_account_name" type="text" class="form-control" name="tithes_account_name" value="{{ $tithes->tithes_account_name }}" readonly>
                                                                                            </div>

                                                                                        </div>

                                                                                        <div class="row mb-2">
                                                                                            <label for="tithes_offer_tithe_amount" class="col-md-3">Reference</label>

                                                                                            <div class="col-md-8">
                                                                                                <input id="tithes_reference_number" type="text" class="form-control" name="tithes_reference_number" value="{{ $tithes->tithes_reference_number }}" readonly>
                                                                                            </div>

                                                                                        </div>

                                                                                        <div class="row mb-2">
                                                                                            <label for="tithes_offer_tithe_amount" class="col-md-3">Tithes Amount</label>

                                                                                            <div class="col-md-8">
                                                                                                <input id="tithes_offer_tithe_amount" type="text" class="form-control" name="tithes_offer_tithe_amount" value="₱ {{ number_format($tithes->tithes_offer_tithe_amount, 2) }}" readonly>
                                                                                            </div>

                                                                                        </div>

                                                                                        <div class="row mb-2">
                                                                                            <label for="tithes_offer_offering_plan_amount" class="col-md-3">Offering Plan Amount</label>

                                                                                            <div class="col-md-8">
                                                                                                <input id="tithes_offer_offering_plan_amount" type="text" class="form-control" name="tithes_offer_offering_plan_amount" value="₱ {{ number_format($tithes->tithes_offer_offering_plan_amount, 2) }}" readonly>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row mb-2">
                                                                                            <label for="tithes_offer_other_gifts_amount" class="col-md-3">Other Gifts Amount</label>
                                                                                            <div class="col-md-8">
                                                                                                <input id="tithes_offer_other_gifts_amount" type="text" class="form-control" name="tithes_offer_other_gifts_amount" value="₱ {{ number_format($tithes->tithes_offer_other_gifts_amount, 2) }}" readonly>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row mb-2">
                                                                                            <label for="tithes_offer_other_gifts_desciption" class="col-md-3">Description</label>
                                                                                            <div class="col-md-8">
                                                                                                <input id="tithes_offer_other_gifts_desciption" type="text" class="form-control" name="tithes_offer_other_gifts_desciption" value="{{ $tithes->tithes_offer_other_gifts_desciption }}" readonly>
                                                                                            </div>
                                                                                        </div>


                                                                                        @if ($tithes->tithes_offer_type != 'Cash')
                                                                                            <div class="row mb-2">
                                                                                                <label for="tithes_reciept" class="col-md-3">Receipt</label>
                                                                                                <div class="col-md-8">
                                                                                                    <img src="/tithes_offer/{{ $tithes->tithes_reciept }}" alt="avatar" class="img-fluid" style="max-width: 100%;">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                 
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    

                                                            <!-- DROPDOWN -->
                                                            <div class="d-flex justify-content-end col-md-3">
                                                                <div class="d-flex justify-content-end align-items-start">

                                                                    <form method="POST" action="/approve_member_request/{{ $tithes->toID }}" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <input type="hidden" name="memberID" id="memberID" value="{{ $tithes->member_ID }}">
                                                                        
                                                                        <button type="submit" class="btn btn-primary btn-sm mx-1">
                                                                            <span data-bs-toggle="tooltip" title="Approve" id="approved_church_member_list">
                                                                                    <i class="fa fa-check mx-2"></i>
                                                                            </span>
                                                                        </button>
                                                                    </form>
                                                                   
                                                                    <form method="POST" action="/decline_member_request/{{ $tithes->toID }}" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <input type="hidden" name="memberID" id="memberID" value="{{ $tithes->member_ID }}">

                                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                                            <span data-bs-toggle="tooltip" title="Decline" id="decline_church_member_list">
                                                                                <i class="fa fa-times mx-2"></i>
                                                                            </span>
                                                                        </button>
                                                                    
                                                                    </form>
                                                                </div>
                                                            </div> 
                                                            <!-- DROPDOWN -->
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
            let memID = $('#memberID').val();
            let tithe_amount = $('#tithes_offer_tithe_amount').val();
            let offer_plan_amount = $('#tithes_offer_offering_plan_amount').val();
            let gifts_amount = $('#tithes_offer_other_gifts_amount').val();
            let desc = $('#tithes_offer_other_gifts_desciption').val();
            let tTYPE = $('#tithes_offer_type').val();

            let toID = $('#toID').val();

            const form = $(this).parents('form');

            $(form).validate({
             
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/approve_member_request/' + toID ,
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
            let memID = $('#memberID').val();
            let tithe_amount = $('#tithes_offer_tithe_amount').val();
            let offer_plan_amount = $('#tithes_offer_offering_plan_amount').val();
            let gifts_amount = $('#tithes_offer_other_gifts_amount').val();
            let desc = $('#tithes_offer_other_gifts_desciption').val();
            let tTYPE = $('#tithes_offer_type').val();

            let toID = $('#toID').val();

            const form = $(this).parents('form');

            $(form).validate({
             
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/decline_member_request/' + toID ,
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