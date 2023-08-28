@extends('layouts.DashB')

@section('content')
<section>
<div class="container-fluid">
<div class="row">
        <div class="col-lg-12 mt-4">
            <div class=" mb-0">
                <h4 class="font-weight-bolder text-white "> Settings  </h4> 
            </div>
            <div class="no-gutters row">
                <div class="d-flex justify-content-between ">
                    <span class="text-left text-white"> @php  $dtae = date_default_timezone_set('Asia/Manila') @endphp {{  date('F j, Y g:i:a  ') }} </span>
                </div>
            </div>
        </div>
  

    <div class="row mt-4">
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="card-header text-center">
                    <img src="/users/{{Auth::user()->user_image}}" alt="profile_image"
                        class="rounded-circle img-fluid" style="width: 100px;">
                        <h5 class="my-3"> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} </h5>
                        <p class="text-muted mb-1"> @if (Auth::user()->user_type == 2)
                                                            Admin
                                                    @elseif (Auth::user()->user_type == 1)
                                                            Officer
                                                    @else
                                                            ---
                                                    @endif
                        </p>
                        <button type="button" 
                        class="btn btn-sm btn-success" href="javascript:;" role="tab" aria-selected="false"  data-toggle="modal"  data-target="#editA"> Change Profile Pciture                           </button>
                        <!-- <button type="button" class="btn btn-outline-primary ms-1"> </button> -->

                        <button type="button" 
                        class="btn btn-sm btn-outline-success"><a href="{{ url('/ad_setting') }}"> Edit Personal Info </a></button>
                        <!-- <button type="button" class="btn btn-outline-primary ms-1"> </button> -->
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
                                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        <div class="col-lg-8">
            <div class="card mb-5">


                <div class="card-body">
                    <div class="card-header">
                            <h3>Change Password</h3>
                    </div>
                    <div class="row">

                        @if (session('error'))
                            <div class="alert text-warning">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert text-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors)
                            @foreach ($errors->all() as $error)
                                <div class="alert text-warning">{{ $error }}</div>
                            @endforeach
                        @endif

                        <form method="POST" action="{{ route('changePasswordPost') }}">
                            @csrf

                               
                            <div class="row mb-4">
                                <div class="col ">
                                    <table class="table table-borderless">

                                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                            <tr>
                                                <th scope="col">
                                                    <label for="new-password" class="col-md-4 control-label">Old Password</label>
                                                </th>
                                                <td>
                                                    <input type="password" class="form-control" name="current-password" id="current-password" required>
                                                </td>
                                            </tr>

                                            <!--@if ($errors->has('current-password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('current-password') }}</strong>
                                                </span>
                                            @endif-->
                                        </div>
                                        
                                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                            <tr>
                                                <th scope="col">
                                                    <label for="new-password">New Password</label>
                                                </th>
                                                <td><input type="password" class="form-control" name="new-password" id="new-password" required>
                                                </td>
                                            </tr>
                                            
                                            <!--@if ($errors->has('new-password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('new-password') }}</strong>
                                                </span>
                                            @endif-->
                                        </div>

                                        <div class="form-group">
                                            <tr>
                                                <th scope="col">
                                                    <label for="new-password-confirm">Confirm New Password</label>
                                                </th>
                                                <td><input type="password" class="form-control" name="new-password_confirmation" id="new-password-confirm" required>
                                                </td>
                                            </tr>
                                        </div>
                                        
                                        
                                            <tr>
                                                <th scope="col">
                                                    <button type="submit" class="btn btn-success">Change Password</button>
                                                </th>
                                            </tr>
                                       
                                    </table>
                                </div>
                            </div>
                    </form>

                    </div>
                </div>

                
             
 
            </div>
        </div>

        <!-- modal -->

        <div class="modal fade" id="editB" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="staticBackdropLabel"> Edit Profile Info </h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="container">
                        <form method="POST" action="/edit_profile/{{ Auth::user()->uID }}">
                            @csrf
                            @method('PUT')

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <table class="table table-format">
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
                                                        <input id="datepicker" class="form-control" name="birthday" placeholder="YYYY-MM-DD" value="{{ Auth::user()->birthday }}" required/>
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

                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

