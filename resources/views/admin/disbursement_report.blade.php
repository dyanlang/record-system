@extends('layouts.DashB')
@section('content')
  

<div class="container-fluid">
    <div class="mb-1 row">
        <div class="col-md-5">
                <div class="greetings">
                    <h4 class="text-white font-weight-bolder">
                        Disbursement / Report
                    </h4>
                    <p class="text-white  mb-0"> @php $dtae = date_default_timezone_set('Asia/Manila') @endphp {{  date('F j, Y g:i a') }} </p>
                </div>
            </div>
        @include('layouts.reports-layout.disbursement_includes')
    </div>

      
            
            
    <div class=" no-gutters row bg-white p-3 mt-4  mx-1 mb-3">
        <form>
            @csrf
                <div class="row">
                    <div class="col">
                    <h5 class="text-uppercase"> Add new Record </h6>
                    </div>
                </div>
                
                <div class="row">

                    <input type="hidden" class="form-control" name="uID" id="uID" value="{{ Auth::user()->uID }}" readonly>

                    <div class="col-md-3  mr-1  text-truncate"  id="type3">
                        <label class="text-uppercase" id="list_disbursement_report"> Department </label>
                            <select type="text" class="form-select disbursement_purpose" style="cursor: pointer" name="disbursement_purpose" id="disbursement_purpose" required>
                                <option disabled selected value>- Select Type  -</option>
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
                            <input class="form-control" type="hidden" name="purpose-field" id="purpose-field">
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
                    <div class="col-md-2  mr-1  text-truncate" id="amount_disbursement_report">
                        <label class="text-uppercase "> Amount </label>
                        <input type="number" class="form-control" name="disbursement_amount" placeholder="amount" id="disbursement_amount" min="1" max="10000" required />
                    </div>

                    <div class="col-md-3 mr-1 text-truncate" id="description_disbursement_report">
                        <label class="text-uppercase "> Description </label>
                        <input class="form-control desc" type="text" name="disbursement_description" id="disbursement_description" required>
                    </div>

                    <div class="col-md-2  mr-1  text-truncate" id="Status_other">
                        <label class="text-uppercase" id="status_disbursement_report"> Status </label>
                            <select type="text" class="form-select disbursement_type_status" style="cursor: pointer" name="disbursement_type_status" id="disbursement_type_status" required>
                                <option disabled selected value>- Select Type  -</option>
                                <option value="Approved"> Approved </option>
                                <option value="Pending"> Pending </option>
                                <option value="Needs Review"> Needs Review </option>
                                <option value="type"> Others:  </option>

                            </select>
                            <input class="form-control" type="hidden" name="status-field" id="status-field">
                    </div>

                    <script>
                            $(document).ready(function() {
                            // Show/hide input field based on selected option
                            $('#disbursement_type_status').on('change', function() {
                                var selectedItem = $(this).val();
                                if (selectedItem === 'Approved' || selectedItem === 'Pending' || selectedItem === 'Needs Review') {
                                    $('#status-field').hide();
                                } else if (selectedItem === 'type') {
                                    $('#status-field').attr('type', selectedItem).show();
                                    
                                }
                                    });
                                });
                                

                    </script>

                    <div class="col-md-2 text-truncate" id="date_disbursement_report">
                        <label class="text-uppercase "> Date </label>
                        <input type="date" class="form-control" name="disbursement_date" id="disbursement_date" required>
                    </div>

                   <div class="d-flex justify-content-end align-items-center col mt-3">
                                <div class="d-flex justify-content-end align-items-start mt-3">
                        <br>
                        
                        <button class="btn btn-sm btn-success btn-save-tithes" id="add_button_disbursement_report">
                               +
                        </button>
                    </div>
                    </div>
                </div>
            </form> 

                    <div class="insert"> </div>
        </div>
    </div>
        <!-- ALL -->
        <div id="ALL" class="tab-pane fade show active"> 
            <div class=" overflow-hidden">
                <div class="row ">
                    <div class="col-lg-12  ">
                        <div class="card"  >
                            <h3 class="px-4 pt-4  " > Disbursement Record </h3>

                            <div class="card-body">
                                <form action="{{ url('/disbursement_report') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- <input type="hidden" id="tithes" name="tithes" value="1"> -->
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-3" id="datefrom_disbursement_report">
                                                <span for="from2" class=" text-sm col-form-label">From</span>
                                                <input type="date" class="form-control input-sm" id="from2" name="from2" style="font-size: 12px;"  value="<?php if(isset($_POST['from2'])) { echo $_POST['from2']; } ?>" required>
                                            </div>
                                            
                                            <div class="col-md-3" id="dateto_disbursement_report">
                                                <span for="to2" class=" text-sm col-form-label" >To</span>
                                                <input type="date" class="form-control input-sm" id="to2" name="to2" style="font-size: 12px;" value="<?php if(isset($_POST['to2'])) { echo $_POST['to2']; } ?>" required>
                                            </div> 

                                            <div class="col-md p-2 my-3 d-flex justify-content-end">

                                            <section id="search_button_disbursement_report">
                                            <li class="list-group" data-bs-toggle="tooltip" title="Search Filter">
                                                <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 mr-4">
                                                   <button type="submit" class="btn btn-outline-success btn-sm" name="search_2" >
                                                    <i class="las la-search" style="font-size: 20px"></i>SEARCH FILTER</button>
                                                </div> 
                                            </li>
                                            
                                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                                            <li class="list-group no-arrow d-sm-none d-md-none"  data-bs-toggle="tooltip" title="Search Filter">
                                                <a href="/tithes_offerings_requests">
                                                    <button type="submit" class="btn btn-outline-success btn-sm mr-3" name="search_2" >
                                                    <i class="las la-search" style="font-size: 20px"></i></button>
                                                </a> 
                                            </li>
                                            </section>
                                            <section id="export_pdf_disbursement_report">
                                            <li class="list-group" data-bs-toggle="tooltip" title="Export PDF">
                                                <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
                                                   <button type="submit" class="btn btn-success btn-sm" name="exportPDF_2">
                                                 <i class="las la-file-export" style="font-size: 20px"></i> EXPORT PDF </button>  
                                                </div> 
                                            </li>
                                            
                                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                                            <li class="list-group no-arrow d-sm-none d-md-none"  data-bs-toggle="tooltip" title="Export PDF">
                                                <button type="submit" class="btn btn-success btn-sm" name="exportPDF_2">
                                                 <i class="las la-file-export" style="font-size: 20px"></i>  </button>  
                                            </li>
                                                </section>
                                                                         
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div> 


                            <div class="card-body">
                                <div class="row mx-0">
                                <div class="col-md-6">
                                    <h6 class="text-gray  text-sm">
                                        <span>
                                            <h6 class="text-sm" id="reload1">  Total No. of records {{ $dsment->count() }}

                                            </h6>
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-md-6" id="search_bar_disbursement_report">
                                    <div class="form-group">
                                            <input class="form-control" id="myInput" type="text" placeholder="Search..">     </div>
                                    </div>
                            </div>

                            <div id="reload" class="keep-scrollin">
                            @if($dsment->count() > 0)
                            @foreach ($dsment as $disbursements)
                                    <div class="list-group" >
                                        <div class=" list-group-item-custom cursor-pointer list-group-item">
                                            <div class="media">
                                                <div class="media-body" id="list_record_disbursement_report">
                                                    <div class="row my-2">
                                                        <div class="col-md-1">
                                                                <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> No </p>
                                                                    <h6 class="text-gray  text-sm">
                                                                        <span>    {{ $loop->iteration }} </span>
                                                                    </h6>
                                                            </div>
                                                        <div class="col-md-3">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book">  Department </p>
                                                                <h6 class="text-gray  text-sm">
                                                                {{ $disbursements->disbursement_purpose }}
                                                                </h6>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate">  Amount </p>
                                                                <h6 class="text-gray  text-sm">
                                                                    <span> ₱ {{ $disbursements->disbursement_amount }} </span>
                                                                </h6>
                                                        </div>

                                                        <div class="col-md-3 text-truncate">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book ">  Description </p>
                                                                <h6 class="text-gray  text-sm">
                                                                    <span> 
                                                                    {{ $disbursements->disbursement_description }}
                                                                
                                                                    </span>
                                                                </h6>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate">  Status </p>
                                                                <h6 class="text-gray  text-sm">
                                                                    <span> 

                                                                    @if ($disbursements->disbursement_type_status == 'Pending')
                                                                    <span  class="badge badge-sm bg-gradient-warning">   {{ $disbursements->disbursement_type_status }} </span> </h6>
                                                                    @elseif ($disbursements->disbursement_type_status == 'Approved')
                                                                    <span  class="badge badge-sm bg-gradient-success">   {{ $disbursements->disbursement_type_status }}  </span> </h6>
                                                                    @elseif($disbursements->disbursement_type_status == '')
                                                                        <span  class="badge badge-sm bg-gradient-secondary">   None  </span> </h6>
                                                                    @else
                                                                    <span  class="badge badge-sm bg-gradient-info">  {{ $disbursements->disbursement_type_status }}   </span> </h6>
                                                                    @endif
                                                                    
                                                                
                                                                    </span>
                                                                </h6>
                                                        </div>

                                                        <div class="col">
                                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate">  Date  </p>
                                                                <h6 class="text-gray  text-sm">
                                                                    <span> 
                                                                    {{ $disbursements->disbursement_date }}
                                                                
                                                                    </span>
                                                                </h6>
                                                        </div>
                                                        
                                                        <!-- DROPDOWN -->
                                                        <div class="d-flex justify-content-end align-items-center col">
                                                                    <div class="d-flex justify-content-end align-items-start">
                                                                        <div class="dropdown" id="dropdown_menu_disbursement_report"> 
                                                                            <a class="  text-black px-2" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" >
                                                                                <i class="las la-ellipsis-v" style="font-size: 20px; font-weight: bolder" ></i>
                                                                            </a>
                                                                        
                                                                            <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton2">
                                                                                <li>  
                                                                                    <a  class="dropdown-item text-xs" href="/disbursement_view/{{ $disbursements->dsID }}">  
                                                                                        <i class="las la-door-open px-2"  style="font-size: 20px;"></i> 
                                                                                        <span> VIEW </span> 
                                                                                    </a>       
                                                                                </li>
                                                                                <li>   
                                                                                    <a  href="/disbursement_edit/{{ $disbursements->dsID }}" class="dropdown-item text-xs">
                                                                                        <span data-bs-toggle="modal"   data-bs-target="#exampleModal{{$disbursements->toID }}"> 
                                                                                            <i class="las la-edit px-2" style="font-size: 20px" ></i> 
                                                                                        <span> EDIT </span>
                                                                                        </span>
                                                                                    </a>
                                                                                </li>
                                                                                <li> 
                                                                                    <a  class="dropdown-item text-xs"  href="#"  onclick="remove_disbursement({{$disbursements->dsID }})" class=" $disbursements->dsID">
                                                                                        <i class="lar la-trash-alt px-2" style="font-size: 20px"></i> 
                                                                                        <span> MOVE TO TRASH </span>
                                                                                    </a>
                                                                                </li>
                                                                                
                                                                                 <!-- sweet alert -->
                                                                                 <a  >
                                                                                   
                                                                                     <li>   
                                                                                        <a href="/revision_history_disbursement/{{ $disbursements->dsID }}"  class="dropdown-item  text-xs" > 
                                                                                            <i class="las la-clock px-2" style="font-size: 20px"></i> 
                                                                                            <span> REVISION HISTORY </span>
                                                                                        </a> 
                                                                                    </li>
                                                                            </ul>
                                                                        </div> 
                                                                        </div>
                                                                </div> 
                                                                 <!-- DROPDOWN -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>     
                        <!-- pagination -->  
                        
                        <!-- pagination -->  
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
    <!-- END ALL -->



<!-- end of tabs  -->


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
    function remove_disbursement(dsID) {
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
                            "timeOut": "3000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                                toastr.success("You have successfully move the record to trash! Please wait to redirect!");

                        // refresh page after 2 seconds
                        setTimeout(function(){
                            $("#notifDiv").fadeOut();
                            $("#pending").load(window.location.href + " #pending" );
                            $("#reload").load(window.location.href + " #reload" );
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

        $('.btn-save-tithes').on('click', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let uID = $('#uID').val();

            let PURPOSE = $('#disbursement_purpose').val();
            let PURPOSE_FIELD = $('#purpose-field').val(); 

            // let Name = $("option:selected").attr('data-name');
            let AMOUNT = $('#disbursement_amount').val(); 

            // let STATUS = $('#disbursement_status').val();
            let DESC = $('#disbursement_description').val();
            
            let STATUS = $('#disbursement_type_status').val();        
            let STATUS_FIELD = $('#status-field').val();  
         
            let DIS_DATE = $('#disbursement_date').val();

            var noSaving;

            if (PURPOSE == null || STATUS == null  )  {
                noSaving = '<span class="text-xs text-danger"> Oppss...please try again! </span> ';
            }
            else if (AMOUNT > 10000) {

                noSaving = '<span class="text-xs text-danger  text-truncate">  Please enter a value less than or equal to 10000. </span>  ';

            } else {
                noSaving = ' <span class="text-xs text-success">  Saving... Please wait </span>' ;
            }

            var PURPS;

            if(PURPOSE === 'type'){
                PURPS = PURPOSE_FIELD;
            }else{
                PURPS = PURPOSE;
            }

            var STAT;

            if(STATUS  === 'others'){
                STAT = STATUS_FIELD;
            }else{
                STAT = STATUS;
            }
                        
            let markup = `
            <div class="list-group1 mx-4">
                <div class=" list-group-item-custom cursor-pointer list-group-item">
                    <div class="media">
                        <div class="media-body">
                            <div class="row media-row my-2">
                                <div class="col-md-3">
                                    <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Department </p>
                                        <h6 class="text-gray">
                                            <span><h6 class="text-sm"> ` + PURPS + `</h6></span>
                                        </h6>
                                </div>
                                <div class="col-md-2">
                                    <p class="mb-1   text-xs text-color-gray-lighter gotham-book">  Amount </p>
                                        <h6 class="text-gray">
                                            <span> ₱ ` + AMOUNT + ` </span>
                                        </h6>
                                </div>
                                
                                <div class="col-md-2">
                                    <p class="mb-1 text-truncate  text-xs text-color-gray-lighter gotham-book">  Description </p>
                                        <h6 class="text-gray">
                                            <span> ` + DESC + ` </span>
                                        </h6>
                                </div>


                                <div class="col-md-2"><p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Status </p>
                                    <span>
                                        <h6 class="text-sm">  ` + STAT +   ` </h6> 
                                    </span> 
                                </div>

                                <div class="col-md-2"><p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Date </p>
                                    <span>
                                        <h6 class="text-sm">  ` + DIS_DATE +   ` </h6> 
                                    </span> 
                                </div>

                                <div class="col"><p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Saving Status </p>
                                    <span>
                                        <h6 class="text-sm">  ` + noSaving +   ` </h6> 
                                    </span> 
                                </div>
                                          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            `;
         
           
            var i = 0;
            $(".insert").append(markup);
                setTimeout(function(){
                    $(".insert").fadeOut(markup);
                 
                    i++
                    if(i>=markup[i]){
                        i=0;
                     }
                $(".insert").html([i]);  
                $(".insert").fadeIn();       

            }, 3000, );

            const form = $(this).parents('form');

            $(form).validate({
             
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/storings',
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
                                "timeOut": "3000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                                toastr.success("You have successfully added new disbursement record!");
                                 $("#reload").load(window.location.href + " #reload" );
                                 $("#reload1").load(window.location.href + " #reload1" );

                                setTimeout(function(){
                                    $("#notifDiv").fadeOut();
                                    $("#pending").load(window.location.href + " #pending" );
                              
                                    $("#Notifs_list").load(window.location.href + " #Notifs_list" );
                                  
                                }, 3000, );
                                
                                $('[id="uID"]').val('');
                                $('[id="disbursement_purpose"]').val('');
                                $('[id="disbursement_amount"]').val('');
                                // $('[id="disbursement_status"]').val('');
                                $('[id="disbursement_description"]').val('');
                                $('[id="disbursement_status"]').val('');
                                $('[id="disbursement_date"]').val('');
                              
                               
                                // $("#pending").load(window.location.href + " #pending" );
                                 $("#Notifs_list").load(window.location.href + " #Notifs_list" );
                            
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
                                    $("#notifDiv").fadeOut();
                                }, 3000, );
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
                                 toastr.error("Opps! Something went wrong, please try again!");
                                setTimeout(function(){
                                    $("#notifDiv").fadeOut();
                                }, 3000, );
                        }
                    });
                }
            });
            
        });
    });

</script>
@endpush