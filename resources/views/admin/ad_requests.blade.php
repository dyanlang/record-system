@extends('layouts.DashB')
@section('content')


<div class="container-fluid">


<div class="row" id="Tithes">
    <div class="col-lg-12 mt-4">
        <div class="mb-1 row">
        @include('layouts.reports-layout.ad_report_includes')
        </div>
     <br> 

            <div id="ALL" class="tab-pane fade show active mt-4"> 
                <div class="overflow-hidden">
                    <div class="row">
                        <div class="col-lg">
                            <div class="card pb-3" id="reload">

                                <div class="container bg-white mt-4" style="margin: 0">
                                    <a  href="{{ url('/tithes&offerings/reports') }}" >
                                        <span id="list_goback_view_co_admin" class="text-gray"> <i class="las la-arrow-left" style="font-size: 22px"></i>
                                            <span>
                                                GO BACK
                                            </span>
                                        </span>                   
                                    </a>

                                        <br><br>

                                    <span>
                                        <i style="font-size: 12px">
                                            These are the Tithes and Offerings added by the Co-Admin themselves that are pending and need approval from a higher admin.
                                        </i>
                                    </span>
                                </div>

                                <div class="mt-4">
                                    @if($reqTithes->count() > 0)
                                        @foreach ($reqTithes as $tithes)
                                            
                                            <form method="POST" action="/approve_requests/{{ $tithes->toID }}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="list-group mx-4 ">
                                                    <div class=" list-group-item-custom cursor-pointer list-group-item">
                                                        <div class="media">
                                                            <div class="media-body" id="list_pending_co_admin">
                                                                <div class="row my-2">

                                                                    <div class="col-md-3">
                                                                        <p class="mb-1   text-xs text-color-gray-lighter gotham-book">
                                                                            Processed By
                                                                        </p>
                                                                        <h6 class="text-gray">
                                                                            <span>
                                                                                <h6 class="text-sm">
                                                                                    {{ $tithes->firstname }} {{ $tithes->lastname }}
                                                                                    <input type="hidden" name="uID" id="uID" value="{{ $tithes->uID }}" />
                                                                                </h6>
                                                                            </span>
                                                                        </h6>
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                            Status
                                                                        </p>
                                                                        @if ($tithes->tithes_offer_approval == '1')
                                                                            <span  class="badge badge-xs bg-gradient-warning">
                                                                                Pending
                                                                            </span>
                                                                        @endif  
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> 
                                                                            Date Created
                                                                        </p>
                                                                        <h6 class="text-sm text-gray">
                                                                            {{ $tithes->tithes_offer_date }}
                                                                        </h6>
                                                                    </div>

                                                                    <div class="justify-content-end align-items-center col-md-3">
                                                                        <div class="d-flex justify-content-end align-items-start">

                                                                            <button id="list_pending_view_co_admin" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#view{{ $tithes->toID }}">
                                                                                <span data-bs-toggle="tooltip" title="View">
                                                                                    <i class="fa fa-eye mx-2"></i>
                                                                                </span>
                                                                            </button>
                                                                            
                                                                            &nbsp;&nbsp;

                                                                            <button id="list_approved_view_co_admin" type="submit" class="btn btn-primary btn-sm">
                                                                                <span data-bs-toggle="tooltip" title="Mark as Approved">
                                                                                    <i class="fa fa-check mx-2"></i>
                                                                                </span>
                                                                            </button>
                                                                            
                                                                        
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal fade" id="view{{ $tithes->toID }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                                                                    <label for="tithes_offer_tithe_amount" class="col-md-3">Giver</label>

                                                                                                    <div class="col-md-8">
                                                                                                        <span  class="badge badge-xs bg-gradient-success">
                                                                                                            CHURCH MEMBER
                                                                                                        </span>
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

                                                                                                <div class="row mb-2">
                                                                                                    <label for="tithes_offer_type" class="col-md-3">Type</label>
                                                                                                    <div class="col-md-8">
                                                                                                        @if ($tithes->tithes_offer_type == 'Cash')
                                                                                                            <span  class="badge badge-xs bg-gradient-warning">
                                                                                                                Cash
                                                                                                            </span>
                                                                                                        @elseif ($tithes->tithes_offer_type == 'GCash')
                                                                                                            <span  class="badge badge-xs bg-gradient-success">
                                                                                                                GCash
                                                                                                            </span>

                                                                                                        @elseif ($tithes->tithes_offer_type == 'Bank')
                                                                                                            <span  class="badge badge-xs bg-gradient-info">
                                                                                                                Bank
                                                                                                            </span>
                                                                                                        @else
                                                                                                            <span  class="badge badge-xs bg-gradient-secondary">
                                                                                                                {{ $tithes->tithes_offer_type }}
                                                                                                            </span>
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
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
        
                                        @endforeach 

                                    @else
                                        
                                        <div class="text-gray my-10 mx-auto vh-100"> 
                                            <h4 class="opacity-2 p-4"> There's no recent activities here. </h4>
                                        </div>
                                
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
            let userID = $('#uID').val();

            let toID = $(".btn-approve").attr('data-id');

            const form = $(this).parents('form');

            $(form).validate({
             
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/approve_requests/' + toID ,
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