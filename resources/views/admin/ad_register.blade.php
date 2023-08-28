@extends('layouts.DashB')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mt-4 mb-2 ">
            <div class=" ml-2 ">
                <h4 class="font-weight-bolder text-white ">Church Members List</h4> 
            </div>
            <div class="no-gutters row">
                <div class="d-flex justify-content-between ">
                    <span class="text-left text-white ml-3">
                        @php 
                            $dtae = date_default_timezone_set('Asia/Manila') 
                        @endphp 
                        
                            {{  date('F j, Y g:i a  ') }}
                    </span>
                <!-- button ADD -->
                 
                <div class="nav-item">
                    <a      id="church_member_list_add_member" 
                            class="text-truncate active nav-link cursor-pointer "
                            data-toggle="modal" 
                            data-target="#bd-example-modal-lg"> 
                    
                    + Add Member
                    </a>
                </div> 
                
                </div>
            </div>

            <div class="modal hide fade" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header  bg-gradient-success"> 
                            <h5 class="modal-title text-white"  id="exampleModalCenterTitle"> Add New Member</h5>
                            <button type="button" class="btn-sm btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('ad.register') }}" id="main_form"> 
                                    @csrf

                                    <input type="hidden" name="user_status" value="0">

                                    <div class="row">
                                        <p style="color: gray;">Personal Info</p>
                                        <div class="col-md-4 form-group">
                                            <label for="firstname" class="col-md-12 text-xs"><i style="color: red">*</i> First Name</label>
                                            <!-- <div class="col-md-3"> -->
                                                <input name="firstname" id="firstname" type="text" style="font-size: 11px" class="form-control" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
                                                <span class="invalid-feedback" role="alert"></span>

                                            <!-- </div> -->
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="middlename" class="col-md-12 text-xs"><i style="color: red"></i> Middle Name</label>

                                            <!-- <div class="col-md-3"> -->
                                                <input name="middlename" id="middlename" type="text" style="font-size: 11px" class="form-control" value="{{ old('middlename') }}">

                                            <!-- </div> -->
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="lastname" class="col-md-12 text-xs"><i style="color: red">*</i> Last Name</label>

                                            <!-- <div class="col-md-3"> -->
                                                <input name="lastname" id="lastname" type="text" style="font-size: 11px" class="form-control" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="birthday" class="col-md-12 text-xs"><i style="color: red">*</i> Date of Birth</label>

                                            <!-- <div class="col-md-3"> -->
                                                <input name="birthday" id="birthday" type="date" style="font-size: 11px" data-date-format='yy-mm-dd' class="form-control" placeholder="YYYY-MM-DD" 
                                                value="{{ old('birthday') }}" required autocomplete="birthday" autofocus>

                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="uMob" class="col-md-12 text-xs"><i style="color: red">*</i> Mobile Number</label>

                                            <!-- <div class="col-md-3"> -->
                                                <input name="user_mobile_number" id="user_mobile_number" type="number" style="font-size: 11px" class="form-control" 
                                                value="{{ old('user_mobile_number') }}" min="0" required autocomplete="user_mobile_number" autofocus>

                                            <!-- </div> -->
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label for="uStrt" class="col-md-12 text-xs" ><i style="color: red">*</i> Street</label>

                                            <input name="user_street" id="user_street" type="text" style="font-size: 11px" class="form-control" value="{{ old('user_street') }}" required autocomplete="user_street" autofocus>

                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="uBrgy" class="col-md-12 text-xs"><i style="color: red">*</i> Barangay</label>

                                            <input name="user_barangay" id="user_barangay" type="text" style="font-size: 11px" class="form-control" value="{{ old('user_barangay') }}" required autocomplete="user_barangay" autofocus>

                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="uCity" class="col-md-12 text-xs"><i style="color: red">*</i> City</label>

                                            <input name="user_city" id="user_city" type="text" style="font-size: 11px" class="form-control" value="{{ old('user_city') }}" required autocomplete="user_city" autofocus>

                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="uZip" class="col-md-12 text-xs"><i style="color: red">*</i> Zip Code</label>

                                            <input name="user_zip" id="user_zip" type="number" min="1" style="font-size: 11px" class="form-control" value="{{ old('user_zip') }}" required autocomplete="user_zip" autofocus>

                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <p style="color: gray;">Position</p>
                                    
                                        <div class="col-md-3 form-group">
                                            <p style="font-size: 11px"><input name="user_type" id="user_type" type="radio" value="2" autofocus> Admin</p>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <p style="font-size: 11px"><input name="user_type" id="user_type" type="radio" value="1" autofocus> Co-Admin</p>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <p style="font-size: 11px"><input name="user_type" id="user_type" type="radio" value="0" autofocus> Member</p>
                                        </div>
                                    
                                    </div>

                                    <br>
                                    
                                    <div class="row">
                                        <p style="color: gray;">Login Credential</p>
                                        <div class="col-md-6 form-group">
                                            <label for="username" class="col-md-12" style="font-size: 11px"><i style="color: red">*</i> Username</label>

                                            <!-- <div class="col-md-3"> -->
                                                <input name="username" id="username" type="text" style="font-size: 11px" class="form-control" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                                <span class="text-danger error-text username_error" style="font-size: 12px"></span>
                                               
                                            <!-- </div> -->
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="email" class="col-md-12 text-xs"><i style="color: red">*</i> Email Address</label>

                                            <!-- <div class="col-md-3"> -->
                                                <input name="email" id="email" type="text text-xs" style="font-size: 11px" class="form-control" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                <span class="text-danger error-text email_error" style="font-size: 12px"></span>
                                               
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="password" class="col-md-12 text-xs" ><i style="color: red">*</i> Password</label>

                                            <!-- <div class="col-md-3"> -->
                                            <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                                            <span class="text-danger error-text password_error" style="font-size: 12px"></span>
                                            
                                            <!-- </div> -->
                                        </div>


                                        <div class="col-md-4 form-group">
                                            <label for="password-confirm" class="col-md-12 text-xs"><i style="color: red">*</i> Confirm Password</label>

                                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="current-password">
                                            <span class="text-danger error-text confirm-password_error" style="font-size: 12px"></span>
                                            
                                        </div>

                                        
                                    </div>

                                    <br>
                                            
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-sm btn-success float-left">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
              
       <!--  -->

       <div id="ALL" class="tab-pane fade show active mt-4"> 
            <div class=" overflow-hidden">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="card">
                        <h3 class="px-4 pt-4 " >List of Church Members </h3>

          
                        <div class="card-body">
                            <form action="{{ url('/search/member') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-3" id="church_member_datefrom">
                                            <span for="from1" class="text-sm col-form-label">From</span>
                                            <input type="date" class="form-control input-sm" id="from1" name="from1" style="font-size: 12px;"  value="<?php if(isset($_POST['from1'])) { echo $_POST['from1']; } ?>" required>
                                        </div>
                                        <div class="col-md-3" id="church_member_dateto">
                                            <span id="church_member_dateto" for="to1" class="text-sm col-form-label">To</span>
                                                <input type="date" class="form-control input-sm" id="to1" name="to1" style="font-size: 12px;" value="<?php if(isset($_POST['to1'])) { echo $_POST['to1']; } ?>" required>
                                        </div>
                                        
        

                                            <div class="col-md p-2 my-3 d-flex justify-content-end">
                                                
                                                <section id="church_member_search_button">
                                                    <li class="list-group" data-bs-toggle="tooltip" title="Search Filter">
                                                        <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 mr-4">
                                                              <button type="submit" class="btn btn-outline-success btn-sm" name="search_1" >
                                                                 <i class="las la-search" style="font-size: 20px"></i> SEARCH FILTER </button>                                           
                                                        </div> 
                                                    </li>
                                                
                                                    
                                            
                                                    <li class="list-group dropdown no-arrow d-sm-none" data-bs-toggle="tooltip" title="Search Filter">
                                                        <button type="submit"  class="btn btn-outline-success btn-sm mr-3" name="search_1" > 
                                                                <i class="las la-search" style="font-size: 20px"></i>
                                                            </button>
                                                    </li>
                                                 </section>

                                                <section id="church_member_export_pdf">
                                                    <li class="list-group" data-bs-toggle="tooltip" title="Export PDF">
                                                        
                                                        <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
                                                            <button type="submit" class="btn btn-success btn-sm" name="exportPDF_1"> 
                                                            <i class="las la-file-export" style="font-size: 20px"></i> EXPORT PDF </button>                 
                                                        </div> 
                                                    </li>
                                                    
                                                
                                                    <li class="list-group dropdown no-arrow d-sm-none" data-bs-toggle="tooltip" title="Export PDF">
                                                       <button type="submit" id="export_pdf_church_members" class="btn btn-success btn-sm" name="exportPDF_1" id="exportPDF_1">
                                                            <i class="las la-file-export" style="font-size: 20px"></i>
                                                       </button>
                                                    </li>    
                                                </section>


                                        </div> 
                                    </div>
                                </div>
                            </form>

                            <!--  -->
                            <div class="row">
                                <div class="col-md-6">

                                    <h6 class="text-gray  text-sm">
                                        <span>
                                            <h6 class="text-sm">       Total No. of records {{ $member->count() }}

                                            </h6>
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="church_member_search_bar">
                                            <input class="form-control" id="myInput" type="text" placeholder="Search..">     </div>
                                    </div>
                                </div>

                            <div id="reload" class="keep-scrollin">
                            @if($member->count() > 0)
                                @foreach ($member as $members)
                                    <div class="list-group">
                                        <div class=" list-group-item-custom cursor-pointer list-group-item">
                                            <div class="media">
                                                <div class="media-body" id="church_member_list_record">
                                                    <div class="row my-2">
                                                        <div class="col-sm-1">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> No </p>
                                                                <h6 class="text-gray  text-sm">
                                                                    <span><h6 class="text-sm">    {{ $loop->iteration }}  </h6></span>
                                                                </h6>
                                                        </div>

                                                        <div class="col">
                                                            <img src="/users/{{$members->user_image}}" class="rounded-circle img-fluid"  width="38" alt="">  
                                                        </div>     
                                                        <div class="col-md-3">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Name </p>
                                                            <div class="d-flex flex-column ">
                                                                <span>
                                                                    <h6 class="text-sm">
                                                                        <a href="/member_tithes/{{ $members->uID }}" data-bs-toggle="tooltip" title="View Profile">
                                                                            @if ($members->uID == Auth()->user()->uID)
                                                                                {{$members->firstname}} {{$members->middlename}} {{$members->lastname}} (You)
                                                                            @else
                                                                                {{$members->firstname}} {{$members->middlename}} {{$members->lastname}}
                                                                            @endif
                                                                        </a>
                                                                    </h6>
                                                                </span>
                                                            </div>                                         
                                                        </div> 
                                                        <div class="col-md-3">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> User type  </p>
                                                            <h6 class="text-gray">
                                                                <span>
                                                                   
                                                                        @if($members->user_type == '2') 
                                                                            <h6 class="text-sm mb-0">       Admin  </h6>
                                                                        @elseif($members->user_type == '1') 
                                                                            <h6 class="text-sm mb-0">      Co-Admin </h6>
                                                                        @elseif($members->user_type == '0') 
                                                                            <h6 class="text-sm mb-0">     Member    </h6>
                                                                        @endif
                                                                    </h6>
                                                                </span>
                                                            </h6>
                                                        </div> 
                                                        <div class="col-md-2">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Status  </p>
                                                            <h6 class="text-gray">
                                                                <span>
                                                                    <h6 class="text-sm mb-0"> 
                                                                        @if($members->user_status == '0') 
                                                                            <span class="badge badge-sm bg-gradient-success">
                                                                                Activated
                                                                            </span>
                                                                        @elseif($members->user_status == '1') 
                                                                            <span class="badge badge-sm bg-gradient-danger">
                                                                                Deactivated
                                                                            </span>
                                                                        @else
                                                                            <span class="badge badge-sm bg-gradient-warning">
                                                                                Pending
                                                                            </span>
                                                                        @endif
                                                                    </h6>
                                                                </span>
                                                            </h6>
                                                        </div>
                                                        <div class="col-md-2"><p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Date Join  </p>
                                                            <span>
                                                            <h6 class="text-sm">   
                                                                {{ $members->created_at->format('d/m/Y') }}
                                                            </span>
                                                        </div>

                                                        <div class="d-flex justify-content-end align-items-center col">
                                                            <div class="d-flex justify-content-end align-items-start">
                                                                <div class="dropdown" id="church_member_dropdown_menu"> 
                                                                    <a class="  text-black px-2" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown">
                                                                        <i class="las la-ellipsis-v" style="font-size: 20px; font-weight: bolder"></i>
                                                                    </a>
                                                                
                                                                    <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton2">
                                                                        <li>  
                                                                            <a class="dropdown-item" href="/member_tithes/{{ $members->uID }}">  
                                                                                <i class="las la-door-open px-2"  style="font-size: 20px;"></i> 
                                                                                <span> VIEW </span> 
                                                                            </a>                                                                                 

                                                                        </li>
                                                                        <li> 
                                                                        @if ($members->uID != Auth()->user()->uID && $members->user_type != '2')
                                                                                <a href="/edit/{{ $members->uID }}" class="dropdown-item">
                                                                                    <span> 
                                                                                        <i class="las la-edit px-2" style="font-size: 24px"></i> 
                                                                                        <span> EDIT </span>
                                                                                    </span>
                                                                                </a>
                                                                            @endif
                                                                        </li> 
                                                                        <!--
                                                                         <li> 
                                                                            <a class="dropdown-item" href="#" onclick="remove{{$members->uID }}('normalAlert')" class="$members->dsID">
                                                                                <i class="lar la-trash-alt px-2" style="font-size: 24px"></i> 
                                                                                <span> MOVE TO TRASH </span>
                                                                             </a>
                                                                        </li>
                                                                        -->
                                                                        <script>
                                                                            function remove{{$members->dsID }}() {
                                                                                Swal.fire({
                                                                                    title: 'Are you sure?',
                                                                                    icon: 'warning',
                                                                                    confirmButtonColor: '#2dce89',
                                                                                    showCancelButton: true,
                                                                                    confirmButtonText: '<a href="/remove_disbusement/{{ $members->uID }}" style="color:white">  Yes, Move it to trash  </a>' 
                                                                                })
                                                                            };
                                                                        </script>
                                                                         <!--
                                                                        <li>   
                                                                            <a href="/revision_history/{{ $members->uID }}"  class="dropdown-item  text-sm" > 
                                                                                <i class="las la-clock px-2" style="font-size: 24px"></i> 
                                                                                <span> REVISION HISTORY </span>
                                                                            </a> 
                                                                        </li>
                                                                        -->
                                                                    </ul>
                                                                </div> 
                                                            </div>
                                                        </div> 
                                                  
                                                    
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach 
                                    </div>
                                    @else
                                    <center>
                                    <div class="text-gray my-10 mx-auto vh-100"> 
                                        <h4 class="opacity-2"> There's no recent activities here. </h4>
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



          
        
    
   
 <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#reload .list-group").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});


</script>

<script type="text/javascript">
    $('#datepicker').datepicker({  
       format: 'yyyy-mm-dd'
    });  
</script>

<script>
$('input[id=1]').change(function(){
    if($(this).is(':checked')){
$('input[id=2]').attr('disabled',true);
    $(this).attr('disabled','');
$('input[id=3]').attr('disabled',true);
    $(this).attr('disabled','');
}
else{
$('input[type=checkbox]').attr('disabled','');
}
});

$('input[id=2]').change(function(){
    if($(this).is(':checked')){
$('input[id=1]').attr('disabled',true);
    $(this).attr('disabled','');
$('input[id=3]').attr('disabled',true);
    $(this).attr('disabled','');
}
else{
$('input[type=checkbox]').attr('disabled','');
}
});

$('input[id=3]').change(function(){
    if($(this).is(':checked')){
$('input[id=1]').attr('disabled',true);
    $(this).attr('disabled','');
$('input[id=2]').attr('disabled',true);
    $(this).attr('disabled','');
}
else{
$('input[type=checkbox]').attr('disabled','');
}
});

</script>


@push('javascript')

<script>
    $(function() {


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


        $("#main_form").on('submit', function(e) {
            e.preventDefault();


            let pass = $('#password').val();
            let con_pass = $('#password_confirmation').val();

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },

                success: function(data) {

      

                    if(data.status == 0) {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                    else {

                        $("#main_form")[0].reset();

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

                    }
                }
            });
        });

        // $('#btnSubmit').click(function() {

        //     $('#bd-example-modal-lg').hide();
        //     // $('.modal-backdrop').remove(); 
        // });

    });
</script>

@endpush

@endsection

