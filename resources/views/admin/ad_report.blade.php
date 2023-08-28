@extends('layouts.DashB')
@section('content')
<div class="container-fluid">
    <div class="row" id="Tithes">
        <div class="col-lg-12 mt-4">

            
            <div class="mb-1 row">
                @include('layouts.reports-layout.ad_report_includes')
            </div>
                   

          <br>  

            <div class=" no-gutters row bg-white p-1 mx-1 mb-3">
                <form>
                    @csrf
                        <div class="row">
                            <div class="col mt-2">
                            <h5 class="text-uppercase"> add new record </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 mr-1 text-truncate" id="add_selectmember_tithes_offerings">
                                <label class="text-uppercase"> Select Member </label>
                                <select type="text" class="form-select text-truncate" name="uID" id="uID" required>
                                    <option  disabled selected value>- Select Contributor -</option>

                                    @foreach ($user as $users)
                                        <option   value="{{ $users->uID }}" data-name="{{ $users->firstname }} {{ $users->lastname }}"> {{ $users->firstname }} {{ $users->lastname }}   </option>
                                    @endforeach
                                </select>  
                            </div>

                            
                            <div class="col-md-2 mr-1 text-truncate" id="add_tithes_tithes_offerings">
                            <label class="text-uppercase "> Tithe </label>
                                <input type="number" class="form-control" name="tithes_offer_tithe_amount" placeholder="amount" id="tithes_offer_tithe_amount" min="1" max="10000" />

                            </div>

                            <div class="col-md-2 mr-1 text-truncate" id="add_offerings_tithes_offerings">
                            <label class="text-uppercase "> One Offering Plan </label>
                                <input type="number" class="form-control" name="tithes_offer_offering_plan_amount" placeholder="amount" id="tithes_offer_offering_plan_amount" min="1" max="10000" />
                            </div>

                            <div class="col-md-2 mr-1 text-truncate" id="add_othersgift_tithes_offerings">
                            <label class="text-uppercase "> Other Gifts </label>
                                <input type="number" class="form-control" name="tithes_offer_other_gifts_amount" placeholder="amount" id="tithes_offer_other_gifts_amount" min="1" max="10000" />
                            </div>

                            <div class="col-md-2 mr-1 text-truncate" id="specify">
                            <label class="text-uppercase "> Description </label>
                                <select type="text" class="form-select desc" style="cursor: pointer" name="tithes_offer_other_gifts_desciption" id="tithes_offer_other_gifts_desciption">
                                    <option disabled selected value>- Other Gifts -</option>
                                    <option value="None"> None </option>
                                    <option value="Specify"> Specify:  </option>
                                </select>
                                <input class="form-control desc" type="hidden" name="other-field" id="other-field">
                            </div>
                            <script>
                            $(document).ready(function() {
                            // Show/hide input field based on selected option
                            $('#tithes_offer_other_gifts_desciption').on('change', function() {
                                var selectedItem = $(this).val();
                                if (selectedItem === 'None') {
                                    $('#other-field').hide();
                                } else if (selectedItem === 'Specify') {
                                    $('#other-field').attr('type', selectedItem).show();
                                    
                                }
                                    });
                                });

                            </script> 

                        

                            <div class="col-md-2 mr-1 text-truncate"  id="type">

                                <label class="text-uppercase"> Type </label>
                                <select type="text" class="form-select tithes_offer_type" style="cursor: pointer" name="tithes_offer_type" id="tithes_offer_type" required>
                                    <option disabled selected value>- Select Type  -</option>
                                    <option value="Cash">Cash</option>
                                    <option value="pay">Online Payment</option>
                                    <option value="type">Specify:</option>
                                </select>

                                <div class="input-group mt-2" id="type-field-1" style="display: none">
                                    <span class="input-group-text" id="basic-addon1">
                                        <input type="radio" name="type_1" id="type_1" value="GCash" data-toggle="modal" data-target="#gcash">
                                    </span>
                                    <input type="text" placeholder="GCash" aria-label="GCash" aria-describedby="basic-addon1" class="form-control" style="font-size: 13px; padding-left: 4%" readonly>
                                </div>

                                <div class="input-group mt-2" id="type-field-2" style="display: none">
                                    <span class="input-group-text" id="basic-addon1">
                                        <input type="radio" name="type_1" id="type_1" value="Bank" data-toggle="modal" data-target="#bank">
                                    </span>
                                    <input type="text" placeholder="Bank" aria-label="Bank" aria-describedby="basic-addon1" class="form-control" style="font-size: 13px; padding-left: 4%" readonly>
                                </div>


                                <input class="form-control desc mt-2" type="hidden" name="type-field-3" id="type-field-3">
                                
                            </div>

                            <script>
                                $(document).ready(function() {
                                // Show/hide input field based on selected option
                                
                                    $('#tithes_offer_type').on('change', function() {
                                        var selectedItem = $(this).val();

                                        if (selectedItem === 'Cash') 
                                        {
                                            $('#type-field-1').hide();
                                            $('#type-field-2').hide();
                                            $('#type-field-3').hide();
                                        }
                                        else if (selectedItem === 'pay')
                                        {
                                            $('#type-field-1').attr('pay', selectedItem).show();
                                            $('#type-field-2').attr('pay', selectedItem).show();
                                            $('#type-field-3').hide();
                                        }
                                        
                                        else if (selectedItem === 'type') 
                                        {
                                            $('#type-field-1').hide();
                                            $('#type-field-2').hide();
                                            $('#type-field-3').attr('type', selectedItem).show();
                                        }

                                    });
                                });
                            </script> 
                            
                            <div class="col-md-2 mr-1 text-truncate" id="add_date_tithes_offerings">
                                <label class="text-uppercase "> Date </label>
                                <input type="date" class="form-control" name="tithes_offer_date" id="tithes_offer_date" required>
                            </div>

                            <div class="col-sm-1 my-1">
                              <br>
                                <button id="add_button_add_tithes_offerings" class="btn btn-sm btn-success btn-save-tithes" style="float: right; right: 0;">
                                    +
                            </button>
                            </div>
                        </div>
                    </form>

                    <div class="insert"> </div>
            </div>

        </ul>
     </div>



<!-- start of tabs -->


       
        <!-- ALL -->
        <div class="tab-content">
        <div id="ALL" class="tab-pane fade show active"> 
            <div class=" overflow-hidden">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="card" >
                            <h3 class="px-4 pt-4 " > All Records </h3>

                            <div class="card-body">
                                <form action="{{ url('/ad_reports') }}" method="POST"   enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" id="tithes" name="tithes" value="1">
                                    <div class="container-fluid" id="">
                                        <div class="row">
                                            <div class="col-md-3" id="list_searchfrom_tithes_offerings">
                                                <span for="from1" class=" text-sm col-form-label">From</span>
                                                <input type="date" class="form-control input-sm" id="from3" name="from3" style="font-size: 12px;"  value="<?php if(isset($_POST['from3'])) { echo $_POST['from3']; } ?>" required>
                                            </div>
                                            
                                            <div class="col-md-3" id="list_searchto_tithes_offerings">
                                                <span for="to1" class=" text-sm col-form-label" >To</span>
                                                <input type="date" class="form-control input-sm" id="to3" name="to3" style="font-size: 12px;" value="<?php if(isset($_POST['to3'])) { echo $_POST['to3']; } ?>" required>
                                            </div> 

                                            <div class="col-md p-2 my-3 d-flex justify-content-end">

                                    <section id="list_search_button_tithes_offerings">
                                        <li class="list-group" data-bs-toggle="tooltip" title="Search Filter">
                                            <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 mr-4">
                                                    <button type="submit" class="btn btn-outline-success btn-sm" name="search_3" >
                                                     <i class="las la-search" style="font-size: 12pt"></i>SEARCH FILTER</button>
                                                </div>

                                            </li>
                                            
                                        
                                            <li class="list-group dropdown no-arrow d-sm-none" title="Search Filter">
                                                 <button id="list_searchbtn_tithes_offerings"  formtarget="_blank" target="_blank"  type="submit" class="btn btn-outline-success btn-sm"  title="search" name="search_3" >
                                                 <i class="las la-search" style="font-size: 20px"></i></button>
                                            </li>
</section>
<section id="list_generatepdf_tithes_offerings">
                                            <li class="list-group" data-bs-toggle="tooltip" title="Export PDF">
                                            <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
                                                    <button type="submit" class="btn btn-success btn-sm" name="exportPDF_3" target="_blank">
                                                    <i class="las la-file-export" style="font-size: 12pt"></i> EXPORT PDF </button>                 
                                            </div>
                                            </li>
                                            
                                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                                            <li class="list-group no-arrow d-sm-none d-md-none" title="Church Member Requests">
                                                    <button id="list_generatepdf_tithes_offerings" type="submit" class="btn btn-success btn-sm" title="Export PDF" name="exportPDF_3" target="_blank">
                                                    <i class="las la-file-export" style="font-size: 20px"></i> </button>                 
                                            </li>          
                                            </div>
                                            </section>
                                        </div>
                                    </div>
                                </form>
                            </div> 



                           


                           <div class="row mx-4">
                                <div class="col-md-6">
                                    <h6 class="text-gray  text-sm">
                                        <span>
                                            <h6 class="text-sm" id="reload">
                                                Total No. of records {{ $tithesRep1->count() }}
                                            </h6>
                                        </span>
                                    </h6>
                                </div>
                               
                                <div class="col-md-6" id="search_tithes_offerings">
                                    <div class="form-group">
                                    
                                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                                       
                                    </div>
                                </div>
                             
                                </div>
                        
                                <div id="user_table"  class="keep-scrollin">
                                    @if($tithesRep1->count() > 0)
                                        @foreach ($tithesRep1 as $tithes1)
                                        <div class="list-group mx-4">
                                            <div class=" list-group-item-custom cursor-pointer list-group-item">
                                                <div class="media">
                                                    <div class="media-body" id="add_records_tithes_offerings">
                                                        <div class="row my-2">
                                                    

                                                        <div class="col-sm-1">
                                                                <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> No </p>
                                                                    <h6 class="text-gray  text-sm">
                                                                        <span><h6 class="text-sm">    {{ $loop->iteration }}  </h6></span>
                                                                    </h6>
                                                            </div>

                                                            <div class="col-sm-2 text-truncate">
                                                                <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Name of Contributor </p>
                                                                    <h6 class="text-gray  text-sm">
                                                                        <span><h6 class="text-sm"><a href="/member_tithes/{{ $tithes1->member_ID }}" data-bs-toggle="tooltip" title="View Profile"> {{ $tithes1->firstname }} {{ $tithes1->lastname }} </a></h6></span>
                                                                    </h6>
                                                            </div>

                                                            <div class="col-md-2 text-truncate">
                                                                <p class="mb-1 text-xs text-color-gray-lighter gotham-book text-truncate"> Tithe Amount </p>
                                                                    <h6 class="text-gray  text-sm">
                                                                        <span> ₱ {{ number_format($tithes1->tithes_offer_tithe_amount, 2) }} </span>
                                                                    </h6>
                                                            </div>

                                                            <div class="col-md-2 text-truncate">
                                                                <p class="mb-1  mr-3 text-xs text-color-gray-lighter gotham-book text-truncate"> Offering Plan Amount </p>
                                                                    <h6 class="text-gray  text-sm">
                                                                        <span> ₱ {{ number_format($tithes1->tithes_offer_offering_plan_amount, 2) }} </span>
                                                                    </h6>
                                                            </div>

                                                            <div class="col-md-2 text-truncate">
                                                                <p class="mb-1   mr-3  text-xs text-color-gray-lighter gotham-book text-truncate"> Other Gifts Amount </p>
                                                                    <h6 class="text-gray text-sm">
                                                                        <span> ₱ {{ number_format($tithes1->tithes_offer_other_gifts_amount, 2) }} </span>
                                                                    </h6>
                                                            </div> 

                                                            <div class="col-md-2 text-truncate">
                                                                <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate"> Other Gifts Description </p>
                                                                    <h6 class="text-gray  text-sm">
                                                                        <span class="text-truncate"> {{ $tithes1->tithes_offer_other_gifts_desciption }} </span>
                                                                    </h6>
                                                            </div>


                                                            <div class="col-md-1">
                                                                <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Type </p>
                                                                <h6 class="text-xs  text-gray">
                                                                    @if ($tithes1->tithes_offer_type == 'Cash')
                                                                        <span class="badge badge-sm bg-gradient-warning">
                                                                        Cash
                                                                        </span></h6>

                                                                    @elseif ($tithes1->tithes_offer_type == 'GCash')
                                                                        <span class="badge badge-sm bg-gradient-success">
                                                                        GCash
                                                                        </span></h6>

                                                                    @elseif ($tithes1->tithes_offer_type == 'Bank')
                                                                        <span class="badge badge-sm bg-gradient-info">
                                                                        Bank
                                                                        </span></h6>

                                                                    @else
                                                                        <span class="badge badge-sm bg-gradient-secondary">
                                                                            {{ $tithes1->tithes_offer_type }}
                                                                        </span></h6>
                                                                    @endif  
                                                            </div>

                                                            <div class="col-md-1">
                                                                <p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Status </p>
                                                                <h6 class="text-xs  text-gray">
                                                                    @if ($tithes1->tithes_offer_approval == '2')
                                                                        <span class="badge badge-sm bg-gradient-success">
                                                                            Approved
                                                                        </span>

                                                                    @elseif ($tithes1->tithes_offer_approval == '1')
                                                                        <span class="badge badge-sm bg-gradient-warning">
                                                                            Pending
                                                                        </span>
                                                                    @endif  
                                                                </h6>
                                                            </div>
                                                            
                                                            <div class="col text-truncate">
                                                                <p class="mb-1  text-xs text-color-gray-lighter gotham-book">Date</p>
                                                                <h6 class="text-sm ">  {{ $tithes1->tithes_offer_date }} </h6>
                                                            </div>
                                                            <!-- DROPDOWN -->
                                                                <div class="d-flex justify-content-end align-items-center col" >
                                                                        <div class="d-flex justify-content-end align-items-start">
                                                                            <div class="dropdown" id="dropdown_tithes_offerings"> 
                                                                                <a class="text-black px-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" >
                                                                                    <i class="las la-ellipsis-v" style="font-size: 20px; font-weight: bolder" ></i>
                                                                                </a>
                                                                            
                                                                                <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton2">
                                                                                    <li>  
                                                                                        <a  class="dropdown-item text-sm" href="/tithe_view/{{ $tithes1->toID }}">  
                                                                                            <i class="las la-door-open px-2"  style="font-size: 24px;"></i> 
                                                                                            <span> VIEW </span> 
                                                                                        </a>
                                                                                    </li>
                                                                                    <li>   
                                                                                        <a href="/tithe_edit/{{ $tithes1->toID }}"  class="dropdown-item  text-sm" > 
                                                                                        <i class="las la-edit px-2" style="font-size: 24px" style="font-size: 20px;"></i> 
                                                                                                <span> EDIT </span>
                                                                                        </a> 
                                                                                    </li>
                                                                                    <li> 
                                                                                    <a type="btn" class="dropdown-item  text-sm"  onclick="deleteRecord({{$tithes1->toID }})">
                                                                                            <i class="lar la-trash-alt px-2" style="font-size: 24px"></i> 
                                                                                            <span> MOVE TO TRASH </span>
                                                                                        </a>
                                                                                    </li>
                                                                                            
                                                                                    <li>   
                                                                                        <a href="/revision_history/{{ $tithes1->toID }}"  class="dropdown-item  text-sm" > 
                                                                                            <i class="las la-clock px-2" style="font-size: 24px"></i> 
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

                                        <!-- pagination -->                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- END ALL -->
<!--  -->

    

    <script>
        $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#user_table .list-group").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
    </script>

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
            // let uID = $('#uID').val();
            // let Name = $("option:selected").attr('data-name');

            let uID = $('#uID').val();
            let Name = $("option:selected").attr('data-name');
            let TITHE = $('#tithes_offer_tithe_amount').val(); 
            let OFFER = $('#tithes_offer_offering_plan_amount').val();
            let OTHERS = $('#tithes_offer_other_gifts_amount').val();
            let DESC = $('#tithes_offer_other_gifts_desciption').val();        
            let OTHER_FIELD = $('#other-field').val();  
            let TYPE = $('#tithes_offer_type').val();
            let TYPE_2 = $('#type_1').val();
            let TYPE_FIELD_3 = $('#type-field-3').val();
            let TITHE_DATE = $('#tithes_offer_date').val();
            // let FILE = $('#tithes_offer_file').val();

            var type;
                if (TYPE == "Cash") 
                {
                    type= '<span class="badge badge-sm bg-gradient-warning"> Cash </span></h6>';
                } 
                
                else if (TYPE == "pay") 
                {

                    type = '<span class="badge badge-sm bg-gradient-warning"> Online Payment </span></h6>';
                    
                }  

                else
                {
                    type =  TYPE_FIELD_3;
                }

            var noSaving;

            if (uID == null)  {
                noSaving = '<span class="text-xs text-danger  text-truncate"> Please enter contributors name </span>  ';
            }
            else if (TITHE > 10000 || OFFER > 10000 || OTHERS > 10000) {

                noSaving = '<span class="text-xs text-danger  text-truncate"> Please enter a value less than or equal to 10000. </span>  ';
            } 
            else {
                noSaving = '<span class="text-xs text-success text-truncate">  Saving... Please wait </span>';
            }

            var Description;

            if(DESC === 'Specify'){
                Description = OTHER_FIELD;
            }else{
                Description = DESC;
            }
            
            let markup = `
            <div class="list-group1 mx-4">
                <div class=" list-group-item-custom cursor-pointer list-group-item">
                    <div class="media">
                        <div class="media-body">
                            <div class="row media-row my-2">
                                <div class="col-md-2">
                                    <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Name of Contributor </p>
                                        <h6 class="text-gray">
                                            <span><h6 class="text-sm"> ` + Name + `</h6></span>
                                        </h6>
                                </div>
                                <div class="col-md-2">
                                    <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Tithe </p>
                                        <h6 class="text-gray">
                                            <span> ₱ ` + TITHE + ` </span>
                                        </h6>
                                </div>
                                <div class="col-md-2 ">
                                    <p class="mb-1  text-truncate  text-xs text-color-gray-lighter gotham-book"> One Offering Plan </p>
                                        <h6 class="text-gray">
                                            <span> ₱ ` + OFFER + ` </span>
                                        </h6>
                                </div>
                                <div class="col-md-2">
                                    <p class="mb-1 text-truncate  text-xs text-color-gray-lighter gotham-book"> Other Gifts </p>
                                        <h6 class="text-gray">
                                            <span> ₱ ` + OTHERS + ` </span>
                                        </h6>
                                </div>

                                <div class="col"><p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Description </p>
                                    <span>
                                        <h6 class="text-sm">  ` + Description +   ` </h6> 
                                    </span> 
                                </div>

                                <div class="col"><p class="mb-1  text-xs text-color-gray-lighter gotham-book"> Type </p>
                                    <h6 class="text-sm text-gray">`  + type +
                                      `
                                </div>

                                <div class="col"><p class="mb-1  text-xs text-color-gray-lighter gotham-book"> Date </p>
                                    <h6 class="text-sm text-gray">`  + TITHE_DATE +
                                      `
                                </div>
                               
                                
                                <div class="col"><p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Status  </p>
                                    <span>
                                        <h6 class="text-xs">  </h6>  `+ noSaving +  `
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
                     }
                $(".insert").html([i]);  
                    
                

            }, 3000, );

            $(".insert").fadeIn(); 

            

            const form = $(this).parents('form');

$(form).validate({
 
    submitHandler: function() {
        var formData = new FormData(form[0]);
        $.ajax({
                        type: 'POST',
                        url: '/admin_add_tithes',
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
                                toastr.success("You have successfully added new record!");
                                $("#user_table").load(window.location.href + " #user_table" );
                                 $("#reload").load(window.location.href + " #reload" );

                                setTimeout(function(){
                                    $("#notifDiv").fadeOut();
                                    $("#pending").load(window.location.href + " #pending" );
                                    $("#Notifs_list").load(window.location.href + " #Notifs_list" );

                                    $('[id="uID"]').val('');
                                    $('[id="tithes_offer_tithe_amount"]').val('');
                                    $('[id="tithes_offer_offering_plan_amount"]').val('');
                                    $('[id="tithes_offer_other_gifts_amount"]').val('');
                                    $('[id="tithes_offer_other_gifts_desciption"]').val('');
                                    $('[id="other-field"]').val('');
                                    $('[id="tithes_offer_type"]').val('');
                                    $('[id="type_1"]').val('');
                                    $('[id="type-field-3"]').val('');
                                    $('[id="tithes_offer_date"]').val('');

                                  
                                }, 2000, );

                             
                            }else{
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
                                toastr.error("Something went wrong... please try again!");
                                setTimeout(function(){

                                    
                                $('[id="uID"]').val('');
                                $('[id="tithes_offer_tithe_amount"]').val('');
                                $('[id="tithes_offer_offering_plan_amount"]').val('');
                                $('[id="tithes_offer_other_gifts_amount"]').val('');
                                $('[id="tithes_offer_other_gifts_desciption"]').val('');
                                $('[id="other-field"]').val('');
                                $('[id="tithes_offer_type"]').val('');
                                $('[id="type_1"]').val('');
                                $('[id="type-field-3"]').val('');
                                $('[id="tithes_offer_date"]').val('');
                                 
                                }, 2000, );
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
                                toastr.error();

                                $('[id="uID"]').val('');
                                $('[id="tithes_offer_tithe_amount"]').val('');
                                $('[id="tithes_offer_offering_plan_amount"]').val('');
                                $('[id="tithes_offer_other_gifts_amount"]').val('');
                                $('[id="tithes_offer_other_gifts_desciption"]').val('');
                                $('[id="other-field"]').val('');
                                $('[id="tithes_offer_type"]').val('');
                                $('[id="type_1"]').val('');
                                $('[id="type-field-3"]').val('');
                                $('[id="tithes_offer_date"]').val('');
                        }
                    });
                }
            });
            
        });
    });

</script>


@endpush