@extends('layouts.DashB')

@section('content')



<section>
    <div class="container-fluid">
        <div class="row" id="reload">
            <div class="col-lg-12 mt-4">
                <div class=" mb-0">
                    <h4 class="font-weight-bolder text-white "> EDIT MEMBER DETAILS  </h4> 
                </div>
                <div class="no-gutters row">
                    <div class="d-flex justify-content-between ">
                        <span class="text-left text-white"> @php  $dtae = date_default_timezone_set('Asia/Manila') @endphp {{ date('F j, Y g:i a') }} </span>
                    </div>
                </div>
            </div>
    

            <div class="row mt-4">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body" id="profile_picture_church_member_edit">
                            <div class="card-header text-center">

                                <div class="d-flex justify-content-between mb-4">            
                                    <div>
                                        <a href="#" onclick="history.back()">
                                            <span class="text-gray" id="goback_church_member_edit">
                                                <i class="las la-arrow-left" style="font-size: 22px"></i>
                                                <span> 
                                                    GO BACK
                                                </span> 
                                            </span>                   
                                        </a>
                                    </div>
                                </div>

                                <img src="/users/{{ $officer->user_image }}" alt="profile_image" class="rounded-circle img-fluid" style="width: 100px;">

                                <h5 class="my-3"> 
                                    {{ $officer->firstname }} {{ $officer->lastname }} 
                                </h5>

                                <p class="text-muted mb-3"> 
                                    @if ($officer->user_type == 2)
                                        Admin
                                    @elseif ($officer->user_type == 1)
                                        Co-Admin
                                    @else
                                        Church Member
                                    @endif
                                </p>

                                @if ($officer->user_type != Auth()->user()->user_type)

                                    @if ($officer->user_status == '0')

                                        <button type="button" id="deactive_activate_button_church_member_edit" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deact">Deactivate</button>

                                    @else

                                        <button type="button" id="deactive_activate_button_church_member_edit" class="btn btn-sm btn-success" data-toggle="modal" data-target="#activate">Activate</button>

                                    @endif

                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card mb-4">

                        <div class="card-body" id="members_information_church_member_edit">
                            <div class="card-header">
                                    <h3>Member's Information</h3>
                            </div>
                            <div class="row">
                                <form>
                                    @csrf

                                            <div class="col">
                                                <table class="table">
                                                    <div class="form-group" id="firstname">
                                                        <tr>
                                                            <th scope="col">
                                                                <label for="firstname">Firstname</label>
                                                            </th>
                                                            <td><input type="text" class="form-control" name="firstname" id="firstname"
                                                                value="{{ $officer->firstname }}" required>
                                                            </td>
                                                            
                                                        </tr>
                                                    </div>
                                                    <div class="form-group" id="middlename">
                                                        <tr>
                                                            <th scope="col">
                                                                <label for="middlename">Middlename</label>
                                                            </th>
                                                            <td><input type="text" class="form-control" name="middlename" id="middlename"
                                                                value="{{ $officer->middlename }}">
                                                            </td>
                                                        </tr>
                                                    </div>
                                                    <div class="form-group" id="lastname">
                                                        <tr>
                                                            <th scope="col">
                                                                <label for="lastname">Lastname</label>
                                                            </th>
                                                            <td><input type="text" class="form-control" name="lastname" id="lastname"
                                                                value="{{ $officer->lastname }}" required>
                                                            </td>
                                                        </tr>
                                                    </div>
                                                    
                                                    <div class="form-group" id="birthday">
                                                        <tr>
                                                            <th scope="col">
                                                                <label for="uBday">Birthday</label>
                                                            </th>
                                                            <td>
                                                                <input type="date" class="form-control" name="birthday" id="birthday" placeholder="YYYY-MM-DD" value="{{ $officer->birthday }}" required/>
                                                        </tr>
                                                    </div>

                                                    <div class="form-group" id="email">
                                                        <tr>
                                                            <th scope="col">
                                                                <label for="email">Email Address</label>
                                                            </th>
                                                            <td>
                                                                <input type="email" class="form-control" name="email" id="email" value="{{ $officer->email }}" required/>
                                                        </tr>
                                                    </div>
                                                    
                                                    <div class="form-group" id="user_mobile_number">
                                                        <tr>
                                                            <th scope="col">
                                                                <label for="uMob">Mobile Number</label>
                                                            </th>
                                                            <td><input type="number" class="form-control" name="user_mobile_number" id="user_mobile_number"
                                                                value="{{ $officer->user_mobile_number }}" required>
                                                            </td>
                                                        </tr>
                                                    </div>
                                                    
                                                    <div class="form-group" id="user_street">
                                                        <tr>
                                                            <th scope="col">
                                                                <label for="uStrt">Street</label>
                                                            </th>
                                                            <td><input type="text" class="form-control" name="user_street" id="user_street"
                                                                value="{{ $officer->user_street }}" required>
                                                            </td>
                                                        </tr>
                                                    </div>
                                                    <div class="form-group" id="user_barangay">
                                                        <tr>
                                                            <th scope="col">
                                                                <label for="uBrgy">Barangay</label>
                                                            </th>
                                                            <td><input type="text" class="form-control" name="user_barangay" id="user_barangay"
                                                                value="{{ $officer->user_barangay }}" required>
                                                            </td>
                                                        </tr>
                                                    </div>
                                                    
                                                    <div class="form-group" id="user_city">
                                                        <tr>
                                                            <th scope="col">
                                                                <label for="uCity">City</label>
                                                            </th>
                                                            <td><input type="text" class="form-control" name="user_city" id="user_city"
                                                                value="{{ $officer->user_city }}" required>
                                                            </td>
                                                        </tr>
                                                    </div>
                                                    <div class="form-group" id="user_zip">
                                                        <tr>
                                                            <th scope="col">
                                                                <label for="uZip">Zip Code</label>
                                                            </th>
                                                            <td><input type="number" class="form-control" name="user_zip" id="user_zip"
                                                                value="{{ $officer->user_zip }}" required>
                                                            </td>
                                                        </tr>
                                                    </div>
                                                </table>

                                                <div class="row mt-5">
                                                    <button id="save_button_church_member_edit" class="btn btn-sm btn-success btn-update" data-id="{{ $officer->uID }}">
                                                        Save
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

        
                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- DEACTIVATION MODAL -->

                    <div class="modal fade" id="deact" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Notice!</h5>
                                </div>

                                <div class="container">
                                    <form method="POST" action="/deactivate/{{ $officer->uID }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col">
                                                    
                                                <p>
                                                    Are you sure you want to deactivate this account?
                                                </p>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">No</button>
                                            <button type="submit" class="btn btn-sm btn-primary">Yes</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- END OF DEACTIVATION MODAL -->

                    <!-- ACTIVATION MODAL -->

                    <div class="modal fade" id="activate" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Notice!</h5>
                                </div>

                                <div class="container">
                                    <form method="POST" action="/activate/{{ $officer->uID }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col">
                                                    
                                                <p>
                                                    Are you sure you want to activate this account?
                                                </p>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">No</button>
                                            <button type="submit" class="btn btn-sm btn-primary">Yes</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- END OF ACTIVATION MODAL -->
                
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
        
        $('.btn-update').on('click', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            let fname = $('#firstname').val();
            let mname = $('#middlename').val();
            let lname  = $('#lastname ').val();
            let bday  = $('#birthday ').val();
            let ema = $('#email').val();
            let mobile_number = $('#user_mobile_number').val();
            let street = $('#user_street').val();
            let barangay = $('#user_barangay').val();
            let city = $('#user_city').val();
            let zip = $('#user_zip').val();

            let uID = $(".btn-update").attr('data-id');

            const form = $(this).parents('form');

            $(form).validate({
             
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/update_member_info/' + uID ,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success:function(data) {
                            // console.log(data);
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
                                toastr.success("You have modified the member's info successfully!");

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