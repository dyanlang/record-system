@extends('layouts.DashB')
@section('content')


                                                
    <div class="container-fluid"> 
        <div class="row">
            @include('layouts.reports-layout.sabbath_report_includes')
        </div>        
        <div class=" no-gutters row  bg-white p-3 mt-4 mx-1 mb-3">
            <form>
                @csrf
                    <div class="row">
                        <div class="col">
                        <h5 class="text-uppercase"> add new record </h6>
                        </div>
                    </div>
                    <div class="row" >
                        
                        <div class="col-md-3  mr-1  text-truncate" id="specify1">
                            <label class="text-uppercase " id="description_sabbath_offerings"> Description </label>
                                <select type="text" class="form-select desc" style="cursor: pointer" name="tithes_offer_other_gifts_desciption" id="tithes_offer_other_gifts_desciption" required>
                                    <option disabled selected value>- Description -</option>
                                    <option value="None"> None </option>
                                    <option value="Specify"> Specify:  </option>
                                </select>
                            </div>

                        <script>
                            $(document).ready(function(){
                                $('.desc').change(function () {
                                    var selectedItem = $(this).val();
                                    if (selectedItem === 'Specify') {
                                        if (!$('#other-field').length) {
                                            $('<input class="form-control desc" type="text" name="other-field" id="other-field">').appendTo('#specify1'); 
                                        }
                                    }
                                });
                            });
                        </script>
                        <div class="col-md-3  mr-1  text-truncate" id="sabbath_sabbath_offerings">
                            <label class="text-uppercase "> Sabbath Offering </label>
                                <input type="number" class="form-control" name="tithes_offer_offering_plan_amount" placeholder="amount" id="tithes_offer_offering_plan_amount" min="1" max="10000" required />
                        </div>

                        <div class="col-md-3  mr-1  text-truncate"  id="type1">
                            <label class="text-uppercase " id="type_sabbath_offerings"> Type </label>
                                <select type="text" class="form-select tithes_offer_type" style="cursor: pointer" name="tithes_offer_type" id="tithes_offer_type" required>
                                    <option disabled selected value>- Select Type  -</option>
                                    <option value="Cash">Cash</option>
                                    <!-- <option value="Online Payment">Online Payment</option>
                                    <option value="Check">Check</option>
                                    <option value="type"> Specify: </option> -->

                                </select>
                        </div>
                        <script>
                            $(document).ready(function(){
                            $('.tithes_offer_type').change(function () {
                                var selectedItem = $(this).val();
                                if (selectedItem === 'type') {
                                    if (!$('#type-field').length) {
                                        $('<input class="form-control" type="text" name="type-field" id="type-field">').appendTo('#type1'); 
                                    }
                                }
                            });
                        });

                        </script>

                        <div class="col-md-2  mr-1  text-truncate" id="type_date_sabbath_offerings">
                            <label class="text-uppercase "> Date </label>
                                <input type="date" class="form-control" name="tithes_offer_date" id="tithes_offer_date" required/>
                        </div>
                        
                        

                        <div class="d-flex justify-content-end align-items-center col mt-3">
                            <div class="d-flex justify-content-end align-items-start mt-3">
                            <br>
                                <button id="button_submit_sabbath_offerings" class="btn btn-sm btn-success btn-save-tithes">
                                    +
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            <div class="insert"> </div>
            </div>
        </ul>
    </div>
</div>


<div id="ALL" class="tab-pane fade show active "> 
    <div class=" overflow-hidden">
        <div class="row ">
            <div class="col-lg-12 ">
                <div class="card" >
                    <h3 class="px-4 pt-4 " > All Records </h3>

            <div class="card-body">
                <form action="{{ url('/sabbath_offering') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" id="tithes" name="tithes" value="1">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3" id="datefrom_sabbath_offerings">
                                <span for="from3" class=" text-sm col-form-label">From</span>
                                <input type="date" class="form-control input-sm" id="from3" name="from3" style="font-size: 12px;"  value="<?php if(isset($_POST['from3'])) { echo $_POST['from3']; } ?>" required>
                            </div>
                            
                            <div class="col-md-3" id="dateto_sabbath_offerings">
                                <span for="to3" class=" text-sm col-form-label" >To</span>
                                <input type="date" class="form-control input-sm" id="to3" name="to3" style="font-size: 12px;" value="<?php if(isset($_POST['to3'])) { echo $_POST['to3']; } ?>" required>
                            </div> 

                            <div class="col-md p-2 my-3 d-flex justify-content-end">
                                
                                <section id="search_button_sabbath_offerings">
                                    <li class="list-group" data-bs-toggle="tooltip" title="Search Filter">
                                        <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 mr-4">
                                            <button type="submit"  class="btn btn-outline-success btn-sm" name="search_3" > 
                                                <i class="las la-search" style="font-size: 12pt"></i> SEARCH FILTER
                                            </button>
                                        </div> 
                                    </li>
                                    
                                
                                    <li class="list-group dropdown no-arrow d-sm-none" data-bs-toggle="tooltip" title="Search Filter">
                                        <button type="submit"  class="btn btn-outline-success btn-sm mr-3" name="search_3" > 
                                                <i class="las la-search" style="font-size: 20px"></i>
                                            </button>
                                    </li>
                                    </section>

                                    <section id="generated_report_sabbath_offerings">
                                    <li class="list-group" data-bs-toggle="tooltip" title="Export PDF">
                                        <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
                                            <button type="submit" class="btn btn-success btn-sm" name="exportPDF_3">
                                                <i class="las la-file-export" style="font-size: 12pt"></i> EXPORT PDF 
                                            </button>                 
                                        </div> 
                                    </li>
                                    
                                
                                    <li class="list-group dropdown no-arrow d-sm-none" data-bs-toggle="tooltip" title="Export PDF">
                                        <button type="submit" class="btn btn-success btn-sm" name="exportPDF_3">
                                                <i class="las la-file-export" style="font-size: 20px"></i>
                                            </button>  
                                    </li> 
                                    </section>   
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
                        

                <div class="row mx-4">
                    <div class="col-md-6">
                        <h6 class="text-gray  text-sm">
                            <span>
                                <h6 class="text-sm"> 
                                    Total No. of records {{ $sabbath->count() }}
                                </h6>
                            </span>
                        </h6>
                    </div>
                    <div class="col-md-6" id="search_bar_sabbath_offerings">
                        <div class="form-group">
                                <input class="form-control" id="myInput" type="text" placeholder="Search..">     </div>
                        </div>
                </div>

                <div id="reload"  class="keep-scrollin">
                    @if($sabbath->count() > 0)
                        @foreach ($sabbath as $tithes1)
                        <div class="list-group mx-4">
                            <div class=" list-group-item-custom cursor-pointer list-group-item">
                                <div class="media">
                                    <div class="media-body" id="list_sabbath_offerings">
                                        <div class="row my-2">
                                            <div class="col-md-0">
                                                <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> No </p>
                                                    <h6 class="text-gray  text-sm">
                                                        <span><h6 class="text-sm">    {{ $loop->iteration }}  </h6></span>
                                                    </h6>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate"> Sabbath Description  </p>
                                                    <h6 class="text-gray  text-sm">
                                                        <span> {{ $tithes1->tithes_offer_other_gifts_desciption }} </span>
                                                    </h6>
                                            </div>

                                            <div class="col-md-3">
                                                <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate"> Sabbath Offering Amount </p>
                                                    <h6 class="text-gray  text-sm">
                                                        <span> ₱ {{ number_format($tithes1->tithes_offer_offering_plan_amount, 2) }} </span>
                                                    </h6>
                                            </div>

                                            <div class="col-md-2">
                                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate"> Type </p>
                                                <h6 class="text-xs text-gray">
                                                    @if ($tithes1->tithes_offer_type == 'Cash')
                                                    <span  class="badge badge-sm bg-gradient-warning">
                                                        Cash
                                                    </span></h6>
                                                @elseif ($tithes1->tithes_offer_type == 'GCash')
                                                    <span  class="badge badge-sm bg-gradient-success">
                                                        GCash
                                                    </span></h6>

                                                @elseif ($tithes1->tithes_offer_type == 'Bank')
                                                    <span  class="badge badge-sm bg-gradient-info">
                                                        Bank
                                                    </span></h6>
                                                @else
                                                    <span  class="badge badge-sm bg-gradient-secondary">
                                                        {{ $tithes1->tithes_offer_type }}
                                                    </span></h6>
                                                @endif   
                                                </div>

                                                <div class="col-md-2">
                                                    <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate"> Date </p>
                                                        <h6 class="text-gray  text-sm">
                                                        <h6 class="text-xs ">  {{ $tithes1->tithes_offer_date }} </h6>
                                                </div>
                                    <!-- DROPDOWN -->
                                                <div class="d-flex justify-content-end align-items-center col">
                                                    <div class="d-flex justify-content-end align-items-start">
                                                        <div class="dropdown" id="dropdown_sabbath_offerings"> 
                                                            <a class="  text-black px-2" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" >
                                                                <i class="las la-ellipsis-v" style="font-size: 20px; font-weight: bolder" ></i>
                                                            </a>
                                                        
                                                            <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton2">
                                                                <li>  
                                                                    <a  class="dropdown-item text-xs" href="/sabbath_view/{{ $tithes1->toID }}">  
                                                                        <i class="las la-door-open px-2"  style="font-size: 20px;"></i> 
                                                                        <span> VIEW </span> 
                                                                    </a>
                                                                </li>
                                                                <li>   
                                                                    <a href="/sabbath_edit/{{ $tithes1->toID }}"  class="dropdown-item  text-xs" > 
                                                                    <i class="las la-edit px-2" style="font-size: 20px;"></i> 
                                                                            <span> EDIT </span>
                                                                    </a> 
                                                                </li>
                                                                <li> 
                                                                <a type="btn" class="dropdown-item text-xs"  onclick="deleteRecord({{$tithes1->toID }})">
                                                                        <i class="lar la-trash-alt px-2" style="font-size: 20px"></i> 
                                                                        <span> MOVE TO TRASH </span>
                                                                    </a>
                                                                </li>
                                                                    <!-- sweet alert -->
                                                                    
                                                                    
                                                                    
                                                                <li>   
                                                                    <a href="/sabbath_revision_history/{{ $tithes1->toID }}"  class="dropdown-item  text-xs" > 
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

<!-- END ALL -->

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
                url: "/delete_sabbath/" + toID,
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
                        "timeOut": "2000",
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
        // let uID = $('#uID').val();
        // let Name = $("option:selected").attr('data-name');
        // let TITHE = $('#tithes_offer_tithe_amount').val(); 
        let OFFER = $('#tithes_offer_offering_plan_amount').val();
        // let OTHERS = $('#tithes_offer_other_gifts_amount').val();
        let DESC = $('#tithes_offer_other_gifts_desciption').val();        
        let OTHER_FIELD = $('#other-field').val();  
        let TYPE = $('#tithes_offer_type').val();
        let TYPE_FIELD = $('#type-field').val();
        let OFFER_DATE = $('#tithes_offer_date').val();
        // let FILE = $('#tithes_offer_file').val();

        var type;
            if (TYPE == "Cash") {
                type= '<span  class="badge badge-sm bg-gradient-warning">  Cash </span> </h6>';
            } else if (TYPE == "Online Payment") {
                type = ' <span  class="badge badge-sm bg-gradient-success">  Online </span> </h6>';
            }  else if (TYPE == "Check") {
                type = ' <span  class="badge badge-sm bg-gradient-primary">  Check </span> </h6>';
            }else{
                type =  TYPE_FIELD;
                
            }

        var noSaving;

        if (OFFER == null)  {
            noSaving = '<span class="text-xs text-danger  text-truncate">  Oppss...please try again! </span>  ';
        }
        else if (OFFER > 10000) {
            noSaving = '<span class="text-xs text-danger  text-truncate">  Please enter a value less than or equal to 10000. </span>  ';

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
                            
                        <div class="col"><p class="mb-1 text-xs text-color-gray-lighter gotham-book"> Description </p>
                                <span>
                                    <h6 class="text-sm">  ` + Description +   ` </h6> 
                                </span> 
                            </div>


                            <div class="col-md-2 ">
                                <p class="mb-1  text-truncate  text-xs text-color-gray-lighter gotham-book">  Sabbath Offering </p>
                                    <h6 class="text-gray">
                                        <span> ₱ ` + OFFER + ` </span>
                                    </h6>
                            </div>
                            

                            
                            <div class="col"><p class="mb-1  text-xs text-color-gray-lighter gotham-book"> Type </p>
                                <h6 class="text-sm text-gray">`  + type +
                                    `
                            </div>

                            <div class="col"><p class="mb-1  text-xs text-color-gray-lighter gotham-book"> Type </p>
                                <h6 class="text-sm text-gray">`  + OFFER_DATE +
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
                    url: '/add_offering',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success:function(data) {
                        console.log(data);
                        if(data.status) {
                        
                            // $("#notifDiv").removeClass('alert alert-success');
                            // $("#notifDiv").addClass('btn btn-outline-white  ');
                            // $("#notifDiv").text(data.message);
                            // $("#overlay").fadeIn(300);
                            
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
                            toastr.success("You have successfully added new record!");
                                $("#reload").load(window.location.href + " #reload" );

                            setTimeout(function(){
                                $("#notifDiv").fadeOut();
                                $("#pending").load(window.location.href + " #pending" );
                                $("#Notifs_list").load(window.location.href + " #Notifs_list" );

                            }, 2000, );


                            // $('[id="uID"]').val('');
                            // $('[id="tithes_offer_tithe_amount"]').val('');
                            $('[id="tithes_offer_offering_plan_amount"]').val('');
                            // $('[id="tithes_offer_other_gifts_amount"]').val('');
                            $('[id="tithes_offer_other_gifts_desciption"]').val('');
                            $('[id="other-field"]').val('');
                            $('[id="tithes_offer_type"]').val('');
                            $('[id="type-field"]').val('');
                            $('[id="tithes_offer_date"]').val('');
                            // $('[id="tithes_offer_file"]').val('');

                            

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
                                "timeOut": "2000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            toastr.error("Something went wrong, please try again!");
                            setTimeout(function(){
                                
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
                                "timeOut": "2000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            toastr.error("Something went wrong. Please try again!");
                    }
                });
            }
        });
        
    });
});

</script>
@endpush