@extends('layouts.DashB')
@section('content') 

@php
$date =    date_default_timezone_set('Asia/Manila');



@endphp


<div class="container">
    <div class="row">
        
        <div class="col-md-11 mt-4">
            <div class=" mb-0">
                <h4 class="font-weight-bolder text-white "> Offering / Edit  </h4> 
            </div>
         
            <div class="no-gutters row">
                <div class="d-flex justify-content-between ">
                    <span class="text-left text-white"> @php  $dtae = date_default_timezone_set('Asia/Manila') @endphp {{  date('F j, Y g:i:a') }}</span>
            <!-- button ADD -->
                  
                </div>
            </div>
          

            <div class="container bg-white mt-2">
                <div class="container rounded bg-white">
                    <div class="row">
                        <div  class="d-flex justify-content-between  mt-5">            
                            <div>
                                <a href="/ad_reports">
                                    <span class="text-gray " > <i class="las la-arrow-left" style="font-size: 22px">   </i> <span"> GO BACK </span> </span>                   
                                </a>
                            </div>
                        <div>
                        <form id="reload">
                            @csrf
                            <button  type="btn" class="btn text-white btn-success mx-1 btn-save">
                                <span class="text-sm" > <i class="las la-save"  style="font-size: 20px"></i> </span>                   
                            </button>
 
                                    @if(  $offering_edit->tithes_offer_approval == 1)

                                        <button  type="btn" class="btn text-success btn-sm btn-outline-success mx-1" data-bs-toggle="tooltip"  title="Approve">
                                            <span class="text-sm" > <i class="las la-check"  style="font-size: 20px"></i> </span>                   
                                        </button>

                                        

                                        <a  onclick="delete_tithe{{$tithes1->toID }}('normalAlert')" class=" $offering_edit->toID">
                                            <span class="text-sm btn btn-danger " data-bs-toggle="tooltip"  title="Remove" ><i class="las la-trash"  style="font-size: 20px"></i> </span>                   
                                        </a>
                                <!-- sweet alert -->
                                        <script>
                                            function delete_tithe{{ $offering_edit->toID }}() {
                                                Swal.fire({
                                                    title: 'Are you sure?',
                                                    icon: 'warning',
                                                    confirmButtonColor: 'red',
                                                    showCancelButton: true,
                                                    confirmButtonText: '<a href="/delete_tithe/{{ $offering_edit->toID }}" style="color:white; ">  Yes, Move it to trash  </a>' 
                                                })
                                            };
                                        </script>
                                <!-- sweet alert -->
                                    

                                    @else

                                        <!-- <a href="/offering_edit_edit/{{ $offering_edit->toID }}">
                                            <span class="text-sm btn text-primary btn-outline-primary "  data-bs-toggle="tooltip"  title="Edit"> <i class="las la-edit" style="font-size: 20px"></i>   </span>                   
                                        </a> -->

                                        <a  onclick="delete_tithe{{$offering_edit->toID }}('normalAlert')" class=" $offering_edit->toID">
                                            <span class="text-sm btn btn-danger " data-bs-toggle="tooltip"  title="Remove" ><i class="las la-trash"  style="font-size: 20px"></i> </span>                   
                                        </a>
                                <!-- sweet alert -->
                                        <script>
                                            function delete_tithe{{ $offering_edit->toID }}() {
                                                Swal.fire({
                                                    title: 'Are you sure?',
                                                    icon: 'warning',
                                                    confirmButtonColor: 'red',
                                                    showCancelButton: true,
                                                    confirmButtonText: '<a href="/delete_tithe/{{ $offering_edit->toID }}" style="color:white; ">  Yes, Move it to trash  </a>' 
                                                })
                                            };
                                        </script>
                                <!-- sweet alert -->
                                    
                                    

                                    @endif
                                    </div>
                                    </div>  

                            
                            </div>
                        </div>
                            

                        <div class="container rounded bg-white">
                            <div class="row">
                                <div class="col-md-5 border-right">
                                <div class="d-flex flex-column p-3 mt-6 py-5">
                                <label class="labels  text-uppercase">   Proof/Receipt  </label> 
                                            <input type="hidden" name="toID" value="{{$offering_edit->toID}}">                  
                                            <input class="form-control"  type="file" name="tithes_offer_file" id="tithes_offer_file" required>
                                            
                                        </div>
                                </div>
                                <div class="col-md-5 border-right">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="text-right"><strong class=" text-uppercase"> Offering INFORMATION</strong></h4>
                                            <input type="hidden" name="tithes_offer_group_type" id="tithes_offer_group_type" value="2" required>
                                        </div>
                                        
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label class="labels  text-uppercase"> Event </label> 
                                                <input type="text" class="form-control" name="offering_name" id="offering_name"  value="{{ $offering_edit->offering_name}}" required> 
                                            </div>

                                            <div class="col-md-12">
                                                <label class="labels  text-uppercase"> Amount </label> 
                                                <input type="number" class="form-control" name="tithes_offer_amount" id="tithes_offer_amount" min="1" value="{{ $offering_edit->tithes_offer_amount}}" required>
                                            </div>

                                            <div class="col-md-12">
                                                <label class="labels  text-uppercase"> Type </label> 
                                                <select type="text" class="form-control" style="cursor: pointer" name="tithes_offer_type" id="tithes_offer_type" required autocomplete="tithes_offer_type" autofocus>
                                                    <option disabled selected value>-  -</option>
                                                    <option value="0">Cash</option>
                                                    <option value="1">Online Payment</option>
                                                    <option value="2">Check</option>
                                                </select>                                                    
                                            </div>

                                        
                                        </div>
                                    </div>
                                </div>
                                </form>
                                
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

            let toGRP = $('#tithes_offer_group_type').val(); 
            let oENAM = $('#offering_name').val();
            let toAMNT = $('#tithes_offer_amount').val();
            let tTYPE = $('#tithes_offer_type').val();
            let tFILE = $('#tithes_offer_file').val();

            const form = $(this).parents('form');

            $(form).validate({
             
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/update_tithes/{{$offering_edit->toID }}',
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
                                $("#notifDiv").removeClass('alert alert-danger');
                                $("#notifDiv").addClass('alert alert-danger');
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