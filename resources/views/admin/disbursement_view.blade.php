@extends('layouts.DashB')
@section('content') 

@php
$date =    date_default_timezone_set('Asia/Manila');

@endphp

 
<div class="container-fluid" id="reload">
    <div class="row">
        
        <div class="col-lg-12 mt-4">
            <div class=" mb-0">
                <h4 class="font-weight-bolder text-white "> Disbursement / Report  </h4> 
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
                        <div class="p-4"> 
                            
                                <a href="#" onclick="history.back()">
                                    <span id="goback_disbursement_view" class="text-gray text-sm" > <i class="las la-arrow-left" style="font-size: 20px">   </i> <span > Go back </span> </span>                   
                                </a>
                            </div>

                            <div class="ml-auto  m-4">
                            <form>
                                @csrf
                                <input type="hidden" name="disbursement_type_status" id="disbursement_type_status" value="Approved">                                  
                                <input type="hidden" name="disbursement_amount" id="disbursement_amount" value="{{ $disbursement->disbursement_amount }}">
                                <input type="hidden" name="disbursement_purpose" id="disbursement_purpose"value="{{ $disbursement->disbursement_purpose }}">
                                <input type="hidden" name="notif_type" id="notif_type" value="Approved">

                                <input type="hidden" name="updated_at"  id="updated_at" value= ' {{ date("d-m-Y H:i:s") }} '>
                                    <a href="/disbursement_edit/{{ $disbursement->dsID }}">
                                        <span id="edit_disbursement_view" class="text-sm btn btn-sm btn-info "  data-bs-toggle="tooltip"  title="Edit"> <i class="las la-edit" style="font-size: 20px"></i>   </span>                   
                                    </a>
                                    <a href="#" onclick="remove({{$disbursement->dsID }})"  class="{{ $disbursement->dsID }}">
                                        <span id="remove_disbursement_view" class="text-sm btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="Remove" ><i class="las la-trash"  style="font-size: 20px"></i> </span>                   
                                    </a> 
                            </form>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-end">
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="text-right"><b class=" text-uppercase"> Disbursement Details </b></h4>
                            </div>
                            
                            <div class="row mt-2">

                                <div class="col-md-12" id="department_disbursement_view">
                                    <label class="labels  text-uppercase"> Department </label> 
                                    <input type="text" class="form-control"  name="disbursement_amount" value="{{ $disbursement->disbursement_purpose  }}" readonly>
                                </div>

                                <div class="col-md-12" id="amount_disbursement_view">
                                    <label class="labels  text-uppercase"> Amount </label> 
                                    <input type="text" class="form-control"  name="disbursement_amount" value=" ₱ {{ number_format($disbursement->disbursement_amount, 2) }}" readonly>
                                </div>

                                

                                <div class="col-md-12 py-3 text-uppercase text-xs" id="description_disbursement_view">
                                <label class="labels  text-uppercase"> Description </label> 
                                    <textarea type="text" class="form-control" readonly> {{ $disbursement->disbursement_description }}  </textarea>
                                </div>

                                <div class="col-md-12" id="requested_date_disbursement_view">
                                    <label class="labels  text-uppercase"> Request Date </label> 
                                    <input type="text" class="form-control"  name="created_at" value="{{ $disbursement->created_at  }}" readonly>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="d-flex flex-column mx-5 p-3 pt-5">

                        <div class=" rounded-md">
                            <div class="flex items-center text-uppercase text-xs my-2">
                                <div class="font-medium"> <h6>  Disbursement Status: </b> </div>
                            
                            </div>
                            <div class="flex items-center text-uppercase text-xs  my-2" id="requested_by_disbursement_view">
                                Requested by: <a href="" class="underline decoration-dotted ml-1">  {{ $disbursement->firstname  }} {{ $disbursement->lastname  }} </a>
                            </div>
                            <div class="flex items-center text-uppercase text-xs my-2" id="approval_date_disbursement_view">
                                 Approval date:    <span class="mx-2"> {{ $disbursement->updated_at->format('d/m/Y')}}  </span>
                            </div>
                            <!-- <div class="flex items-center text-uppercase text-xs my-2">
                                Approved by: {{ $disbursement->firstname  }} {{ $disbursement->lastname  }} 
                            </div> -->
                            <div class="flex items-center text-uppercase text-xs my-2" id="status_disbursement_view">
                                Status: 
                                
                                @if($disbursement->disbursement_type_status == 'Pending') 
                                    <span class=" text-warning text-xs mx-5">  Pending </span> 
                                @elseif($disbursement->disbursement_type_status == 'Needs Review') 
                                <span class="text-info text-xs mx-5">  Needs Review </span> 
                                
                                @else
                                    <span  class="text-success  text-xs mx-5">  Approved </span>
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

 <script type="text/javascript">
    function remove(dsID) {
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
                    url: "/remove_disbursement/" + dsID,
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

                            window.location = "/disbursement_report";

                            $("#pending").load(window.location.href + " #pending" );
                            $("#reload1").load(window.location.href + " #reload1" );
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
                let pending = parseInt($('#' + data.uID).find('.pending').html());
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
            
            let dsSTAT = $('#disbursement_type_status').val();
            let updated_at = $('#updated_at').val();
            let notif_type = $('#notif_type').val();

            const form = $(this).parents('form');

            $(form).validate({
             
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/updates/{{$disbursement->dsID }}',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success:function(data) {
                            console.log(data);
                            if(data.status) {
                               

                                $("#notifDiv").removeClass('alert alert-success');
                                $("#notifDiv").addClass('btn btn-outline-white  ');
                                $("#notifDiv").text(data.message);
                                $("#notifDiv").fadeIn();
                                setTimeout(function(){
                                    $("#notifDiv").fadeOut();
                                }, 3000, );


                                $('[id="disbursement_status"]').val('');
                                $('[id="disbursement_amount"]').val('');
                                $('[id="disbursement_type"]').val('');
                                $('[id="updated_at"]').val('');
                                $('[id="notif_type"]').val('');

                                //disable the submit button
                                $(".btn-approve").hide();
                                $(".labels-status").hide();
                                
                                $("#pending").load(window.location.href + " #pending" );
                                $("#reload").load(window.location.href + " #reload" );
                                $("#Notifs_list").load(window.location.href + " #Notifs_list" );

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