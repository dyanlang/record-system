@extends('layouts.DashB')
@section('content') 

@php
$date =    date_default_timezone_set('Asia/Manila');

@endphp


<div class="container-fluid" id="reload ">
    <div class="row">
        
        <div class="col-lg-12 mt-4">
            <div class=" mb-0">
                <h4 class="font-weight-bolder text-white "> Disbursement / Report  </h4> 
            </div>
            <div class="no-gutters row">
                <div class="d-flex justify-content-between ">
                    <span class="text-left text-white"> @php  $dtae = date_default_timezone_set('Asia/Manila') @endphp {{ date('F j, Y g:i a') }}</span>
            <!-- button ADD -->
                  
                </div>
            </div>
        
            <div class="container-fluid bg-white keep-scrollin  mt-5">
                    <div class="row">
                        <div class="d-flex  justify-content-between ">
                            <div class="p-4"> 
                                
                                <a href="/disbursement_report">
                                    <span id="goback_disbursement_edit" class="text-gray text-sm">
                                        <i class="las la-arrow-left" style="font-size: 20px"></i>
                                        <span> 
                                            GO BACK 
                                        </span>
                                    </span>                   
                                </a>
                            </div>

                            <div class="ml-auto  m-4">
                            <form>
                                @csrf
                               
                                <input type="hidden" name="created_at" value='{{ date("d-m-Y H:i:s") }}'>                   
                                
                                <button  type="btn" class="btn btn-sm text-white btn-success mx-1 btn-save">
                                    <span id="save_button_disbursement_edit" class="text-sm" > <i class="las la-save"  style="font-size: 20px"></i> </span>                   
                                </button>

                        </div>
                    </div>
                </div>
                                                    
                <div class="container-fluid rounded mb-5 pb-5">
                    <div class="row">
                        <div class="col-md-2 border-right">
                      
                        
                        </div>
                        <div class="col-md-6 border-right">
                            <div class="p-3 pb-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right text-uppercase"> Edit Disbursement</h4>
                                </div>
                                <div class="row mt-3">
                                
                                <div class="col-md-8 text-truncate" id="type4">
                                    <label class="text-uppercase "> Department </label>
                                        <select type="text" class="form-select" style="cursor: pointer" name="disbursement_purpose" id="disbursement_purpose">
                                            <option class="text-disabled" value="{{ $disbursement->disbursement_purpose }}">-- {{ $disbursement->disbursement_purpose }}  --</option>

                                            <option value="Childrens department">  Children's department </option>
                                            <option value="Womens department"> Women's department </option>
                                            <option value="Personal ministry department"> Personal ministry department </option>
                                            <option value="Stewardship department"> Stewardship department </option>
                                            <option value="Prayer department"> Prayer department </option>
                                            <option value="Youth department"> Youth department </option>

                                            <option value="ACS department"> ACS department </option>
                                            <option value="Communication department"> Communication department </option>
                                            <option value="Sabbath school department"> Sabbath school department </option>

                                            <option value="Education department"> Education department </option>
                                            <option value="Health department"> Health department </option>
                                            <option value="Dorcas department"> Dorcas department </option>
                                            <option value="type"> Specify: </option>
                                        </select>
                                        
                                        <input class="form-control" type="hidden" name="disbursement_hide" id="purpose-field">
                                </div>

                                <div class="col-md-4 text-truncate"  id="others">
                                        <label class="text-uppercase "> Status </label>
                                            <select type="text" class="form-select" style="cursor: pointer" name="disbursement_type_status" id="disbursement_type_status">
                                                <option class="text-disabled" value="{{ $disbursement->disbursement_type_status }}">- {{$disbursement->disbursement_type_status}}  -</option>
                                                <option value="Approved"> Approved </option>
                                                <option value="Pending"> Pending </option>
                                                <option value="Needs Review"> Needs Review </option>
                                            </select>


                                    </div>

                                    <script>
                                        $(document).ready(function() {

                                        // Show/hide input field based on selected option

                                        $('#disbursement_purpose').on('change', function() {
                                            var selectedItem = $(this).val();
                                            if (selectedItem === 'Childrens department' || selectedItem === 'Womens department' || selectedItem === 'Personal ministry department'
                                            || selectedItem === 'Stewardship department' || selectedItem === 'Prayer department' || selectedItem === 'Youth department' 
                                            || selectedItem === 'ACS department' || selectedItem === 'Communication department' || selectedItem === 'Sabbath school department' ) 
                                            {
                                                $('#purpose-field').hide();
                                            } else if (selectedItem === 'type') {
                                                $('#purpose-field').attr('type', selectedItem).show();
                                                
                                                
                                            }
                                            });
                                        });
                                            

                                    </script> 
                                    
                                  

                                    <div class="col-md-12 mt-2" id="amount_disbursement_edit">
                                        <label class="text-uppercase"> Amount </label> 
                                        <input type="number" class="form-control" placeholder="Enter Amount"  name="disbursement_amount" value="{{ $disbursement->disbursement_amount }}">
                                    </div>
                                    <div class="col-md-12 mt-2" id="description_disbursement_edit">
                                        <label class="text-uppercase">Description</label>
                                        <textarea type="text" class="form-control" name="disbursement_description" value="disbursement_description">{{ $disbursement->disbursement_description  }}</textarea>
                                    </div>
                                </div>
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
            
            let uID = $('#uID').val();
            let Purpose = $('#disbursement_purpose').val();
            let Purpose_Hide = $('#disbursement_hide').val();
            let Amount = $('#disbursement_amount').val();
          
            let STATUS = $('#disbursement_type_status').val();   
            let Other = $('#disbursement_description').val();

            $("#overlay").fadeIn(300);　


            const form = $(this).parents('form');

            $(form).validate({
             
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/editing/{{$disbursement->dsID }}',
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
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                                toastr.success("You have successfully modify the record!");
                               
                                setTimeout(function(){
                                    $("#notifDiv").fadeOut();
                                    $("#pending").load(window.location.href + " #pending" );
                                    $("#reload").load(window.location.href + " #reload" );
                                    $("#Notifs_list").load(window.location.href + " #Notifs_list" );
                                }, 3000, );

                                $("#overlay").fadeOut(300);

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
                                toastr.error("Opps! Something went wrong!");
                                setTimeout(function(){
                                    $("#overlay").fadeOut(300);
                                }, 3000, );
                            }
                        },
                        error: function( data, xhr, ajaxOptions, thrownError) {
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
                                    "timeOut": "2000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                                toastr.error( data, xhr, ajaxOptions, thrownError);

                                $('[id="uID"]').val('');
                                $('[id="tithes_offer_tithe_amount"]').val('');
                                $('[id="tithes_offer_offering_plan_amount"]').val('');
                                $('[id="tithes_offer_other_gifts_amount"]').val('');
                                $('[id="tithes_offer_other_gifts_desciption"]').val('');
                                $('[id="other-field"]').val('');
                                $('[id="tithes_offer_type"]').val
                        }
                    });
                }
            });
            
        });
    });
</script>
@endpush