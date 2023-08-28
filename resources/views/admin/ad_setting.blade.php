@extends('layouts.DashB')
@section('content')


<style>

    .form-switch .form-check-input:checked {
    border-color: rgba(45, 206, 137, 1);
    background-color: rgba(45, 206, 137, 1);
    }

</style>

<section>
<div class="container-fluid" id="Settings">
<div class="row" id="reload">
        <div class="col-lg-12 mt-4">
            <div class=" mb-0">
                <h4 class="font-weight-bolder text-white "> Settings  </h4> 
            </div>
            <div class="no-gutters row">
                <div class="d-flex justify-content-between ">
                    <span class="text-left text-white"> @php  $dtae = date_default_timezone_set('Asia/Manila') @endphp {{  date('F j, Y g:i a  ') }} </span>
                </div>
            </div>
        </div>
  

    <div class="row mt-4">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body" id="profile_picture_settings">
                    <div class="card-header text-center">

                        <div class="row">
                            <div class="col-md-12">

                                <div class="d-flex justify-content-between mb-4">            
                                    <div>
                                        <a href="/home">
                                            <span id="goback_settings" class="text-gray">
                                                <i class="las la-arrow-left" style="font-size: 22px"></i>
                                                <span> 
                                                    GO BACK
                                                </span> 
                                            </span>                   
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">

                                <img src="/users/{{Auth::user()->user_image}}" alt="profile_image" class="rounded-circle img-fluid" style="width: 100px;">

                                <h5 class="my-3"> 
                                    {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} 
                                </h5>

                                <p class="text-muted mb-3"> 
                                    @if (Auth::user()->user_type == 2)
                                        Admin
                                    @elseif (Auth::user()->user_type == 1)
                                        Co-Admin
                                    @else
                                        Church Member
                                    @endif
                                </p>
                                <button 
                                    id="upload_button_settings"
                                    type="button" 
                                    class="btn btn-sm btn-primary" 
                                    href="javascript:;" 
                                    role="tab" 
                                    aria-selected="false"  
                                    data-toggle="modal" 
                                    data-target="#editA"> 
                                        Change Profile Picture 
                                </button>

                                <button 
                                    id="change_password_settings"
                                    type="button" 
                                    class="btn btn-sm btn-link">
                                    
                                    <a href="{{ url('/ad_change_pass') }}">
                                        Change Password 
                                    </a>
                                </button>

                            </div>
                        </div>
                       
                        <div class="row" style="border-top: 1px solid gray" id="retrieve_email_settings">
                            <div class="col-md-7 mt-2" >

                                <p style="font-size: 13px">Receive Email Notification </p>

                            </div>

                            <div class="col-md-5 form-check form-switch" style="justify-content: center">

                                <input 
                                    data-id="{{ Auth::user()->uID }}" 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    role="switch" 
                                    id="flexSwitchCheckDefault" 
                                    value="{{ Auth::user()->user_email_status }}"
                                    {{ Auth::user()->user_email_status == 'On' ? 'checked' : '' }}
                                >

                            </div>
                        </div>

                        <script>
                            $(function() {
                                $('.form-check-input').change(function() {
                                    var email_status = $(this).prop('checked') == true ? "On" : "Off"; 
                                    var user_id = $(this).data('id'); 
                                    
                                    $.ajax({
                                        type: "GET",
                                        dataType: "json",
                                        url: '/email_status/' + user_id,
                                        data: {'user_email_status': email_status, 'uID': user_id},
                                        success: function(data){
                                        console.log(data.success)
                                        }
                                    });
                                })
                            })
                        </script>

                    </div>
                </div>
            </div>
        </div>

           <!-- modal for profile picture -->

            <div class="modal fade" id="editA" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="staticBackdropLabel">Edit Profile Picture</h5>
                            <button type="button" class="btn-sm btn-close" data-dismiss="modal" aria-label="Close"></button>

                        </div>

                        <div class="container">
                            <center><img src="/users/{{Auth::user()->user_image}}" class="rounded-circle img-fluid logo mb-5 mt-5" style="height: 160px; width: 160px; border-radius: 10%;"></center>
                            
                            <div style="">
                                <form enctype="multipart/form-data" action="{{ route('update_image') }}" method="POST">
                    
                                    <input type="file"   class="form-control" name="user_image">
                                    <br><br>
                                    <input type="hidden" class="form-control" name="_token" value="{{ csrf_token() }}">
                            
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        <div class="col-lg-8">
            <div class="card mb-4" id="personal_information_settings">


                <div class="card-body">
                    <div class="card-header">
                            <h3>Personal Info</h3>
                    </div>
                    <div class="row">
                        <form>
                            @csrf

                                    <div class="col">
                                        <table class="table">
                                            <div class="form-group">
                                                <tr>
                                                    <th scope="col">
                                                        <label for="firstname">Firstname</label>
                                                    </th>
                                                    <td><input type="text" class="form-control" name="firstname" id="firstname"
                                                        value="{{ Auth::user()->firstname }}" required>
                                                    </td>
                                                    
                                                </tr>
                                            </div>
                                            <div class="form-group">
                                                <tr>
                                                    <th scope="col">
                                                        <label for="middlename">Middlename</label>
                                                    </th>
                                                    <td><input type="text" class="form-control" name="middlename" id="middlename"
                                                        value="{{ Auth::user()->middlename }}">
                                                    </td>
                                                </tr>
                                            </div>
                                            <div class="form-group">
                                                <tr>
                                                    <th scope="col">
                                                        <label for="lastname">Lastname</label>
                                                    </th>
                                                    <td><input type="text" class="form-control" name="lastname" id="lastname"
                                                        value="{{ Auth::user()->lastname }}" required>
                                                    </td>
                                                </tr>
                                            </div>
                                            
                                            <div class="form-group">
                                                <tr>
                                                    <th scope="col">
                                                        <label for="uBday">Birthday</label>
                                                    </th>
                                                    <td>
                                                        <input type="date" class="form-control" name="birthday" placeholder="YYYY-MM-DD" value="{{ Auth::user()->birthday }}" required/>
                                                </tr>
                                            </div>

                                            <div class="form-group">
                                                <tr>
                                                    <th scope="col">
                                                        <label for="email">Email Address</label>
                                                    </th>
                                                    <td>
                                                        <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required/>
                                                </tr>
                                            </div>
                                            
                                            <div class="form-group">
                                                <tr>
                                                    <th scope="col">
                                                        <label for="uMob">Mobile Number</label>
                                                    </th>
                                                    <td><input type="number" class="form-control" name="user_mobile_number" id="user_mobile_number"
                                                        value="{{ Auth::user()->user_mobile_number }}" required>
                                                    </td>
                                                </tr>
                                            </div>
                                            
                                            <div class="form-group">
                                                <tr>
                                                    <th scope="col">
                                                        <label for="uStrt">Street</label>
                                                    </th>
                                                    <td><input type="text" class="form-control" name="user_street" id="user_street"
                                                        value="{{ Auth::user()->user_street }}" required>
                                                    </td>
                                                </tr>
                                            </div>
                                            <div class="form-group">
                                                <tr>
                                                    <th scope="col">
                                                        <label for="uBrgy">Barangay</label>
                                                    </th>
                                                    <td><input type="text" class="form-control" name="user_barangay" id="user_barangay"
                                                        value="{{ Auth::user()->user_barangay }}" required>
                                                    </td>
                                                </tr>
                                            </div>
                                            
                                            <div class="form-group">
                                                <tr>
                                                    <th scope="col">
                                                        <label for="uCity">City</label>
                                                    </th>
                                                    <td><input type="text" class="form-control" name="user_city" id="user_city"
                                                        value="{{ Auth::user()->user_city }}" required>
                                                    </td>
                                                </tr>
                                            </div>
                                            <div class="form-group">
                                                <tr>
                                                    <th scope="col">
                                                        <label for="uZip">Zip Code</label>
                                                    </th>
                                                    <td><input type="number" class="form-control" name="user_zip" id="user_zip"
                                                        value="{{ Auth::user()->user_zip }}" required>
                                                    </td>
                                                </tr>
                                            </div>
                                        </table>

                                        <div class="row mt-5">
                                            <button id="save_button_settings" class="btn btn-sm btn-primary btn-update" data-id="{{ Auth::user()->uID }}">
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
