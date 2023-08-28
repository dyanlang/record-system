@extends('layouts.DashB')
@section('content')

<!-- @php

use App\Models\User;
use App\Models\Log;
use App\Models\TithesOffer;
use App\Models\Delete;
use App\Models\Disbursement;
use App\Models\RevisionHistory;
use App\Models\Notif;
use App\Models\OnlinePayment;


    $giver = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
        ->where('tithes_offer_tb.tithes_offer_approval', '1')
        ->get(['users_tb.firstname', 'tithes_offer_tb.member_ID']);

       

@endphp -->

  
<script>
$(document).ready(function(){
	$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
	});
	var activeTab = localStorage.getItem('activeTab');
	if(activeTab){
		$('#myTab a[href="' + activeTab + '"]').tab('show');
	}
});
</script>



<div class="container-fluid">
    <div class="row" style="justify-content: center">
        <div class="col-lg-12 mt-4">
            <div class="mb-0">
                <h4 class="font-weight-bolder text-white "> Sabbath Offerings / Pending List  </h4> 
            </div>
            <div class="no-gutters row mb-5">
                <div class="d-flex justify-content-between">
                    <span class="text-left text-white"> 
                        @php  
                            $dtae = date_default_timezone_set('Asia/Manila') 
                        @endphp

                        {{  date('F j, Y g:i a') }} 
                    </span>
                </div>
            </div>
        
         


            <div id="ALL" class="tab-pane fade show active"> 

                

                <div class="overflow-hidden">
                    <div class="row">
                        <div class="col-lg">
                            <div class="card pb-3" id="reload">

                                
                                <div class="container bg-white mt-4" style="margin: 0">
                                    <a href="/sabbath_offering">
                                        <span class="text-gray"> <i class="las la-arrow-left" style="font-size: 22px"></i>
                                            <span>
                                                GO BACK
                                            </span>
                                        </span>                   
                                    </a>

                                        <br><br>

                                    <span>
                                        <i style="font-size: 12px">
                                            These are the Sabbath Offerings added by the Co-Admin themselves that are pending and need approval from a higher admin.
                                        </i>
                                    </span>
                                </div>

                                <div class="mt-4 keep-scrollin vh-100">
                                    @if($co_admin_req->count() > 0)
                                        @foreach ($co_admin_req as $offer)


                                                <div class="list-group mx-4">
                                                    <div class=" list-group-item-custom cursor-pointer list-group-item">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <div class="row my-2">

                                                                    <div class="col-md-3">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                            Sabbath Offering
                                                                        </p>

                                                                        <h6 class="text-sm text-gray">
                                                                            {{ $offer->tithes_offer_offering_plan_amount }}
                                                                        </h6>
                                                                         
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                            Description
                                                                        </p>


                                                                        <h6 class="text-sm text-gray">
                                                                            {{ $offer->tithes_offer_other_gifts_desciption }}
                                                                        </h6>
                                                                         
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                            Type
                                                                        </p>

                                                                        <h6 class="text-sm text-gray">
                                                                            @if ($offer->tithes_offer_type == 'Cash')
                                                                                <span  class="badge badge-sm bg-gradient-warning">
                                                                                    Cash
                                                                                </span>
                                                                            @elseif ($offer->tithes_offer_type == 'GCash')
                                                                                <span  class="badge badge-sm bg-gradient-success">
                                                                                    GCash
                                                                                </span>

                                                                            @elseif ($offer->tithes_offer_type == 'Bank')
                                                                                <span  class="badge badge-sm bg-gradient-info">
                                                                                    Bank
                                                                                </span>
                                                                            @else
                                                                                <span  class="badge badge-sm bg-gradient-secondary">
                                                                                    {{ $offer->tithes_offer_type }}
                                                                                </span>
                                                                            @endif   
                                                                        </h6>
                                                                         
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                            Status
                                                                        </p>
                                                                        @if ($offer->tithes_offer_approval == '1')
                                                                            <span  class="badge badge-xs bg-gradient-success">
                                                                                Pending
                                                                            </span>
                                                                        @endif  
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> 
                                                                            Date Requested
                                                                        </p>
                                                                        <h6 class="text-sm text-gray">
                                                                            {{ $offer->tithes_offer_date }}
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



<script type="text/javascript">
    function deleteRecord(toID) {
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

                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                if (result.isConfirmed) {
                

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
                            $("#notifDiv").fadeOut();
                            $("#pending").load(window.location.href + " #pending" );
                            $("#user_table").load(window.location.href + " #user_table" );
                            $("#Notifs_list").load(window.location.href + " #Notifs_list" );
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
