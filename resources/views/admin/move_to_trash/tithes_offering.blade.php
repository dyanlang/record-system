
<div class="row mx-4 pt-4">
    <div class="col-md-6">
        <h6 class="text-gray  text-sm">
            <span>
                <h6 class="text-sm">       Total No. of records {{ $deleted_tithe->count() }}

                </h6>
            </span>
        </h6>
    </div>
    <div class="col-md-6" >
        <div class="form-group">
                <input class="form-control" id="myInput" type="text" placeholder="Search..">     </div>
        </div>
   </div>

<div id="reload1" class="keep-scrollin">
    @foreach ($deleted_tithe as $tithes)    
        @if ($tithes->tithes_offer_status == '1')
            <div class="list-group mx-3" >
                <div class=" list-group-item-custom cursor-pointer list-group-item">
                    <div class="media">
                        <div class="media-body">
                            <div class="row my-2">
                                <div class="col-md-2">
                                    <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Name of Contributor </p>
                                        <h6 class="text-gray  text-sm">
                                            <span><h6 class="text-sm"><a href="/member_tithes/{{ $tithes->member_ID }}" data-bs-toggle="tooltip" title="View Profile"> {{ $tithes->firstname }} {{ $tithes->lastname }} </a></h6></span>
                                        </h6>
                            </div>

                            <div class="col-md-2">
                                <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate"> Tithe Amount </p>
                                    <h6 class="text-gray  text-sm">
                                        <span> ₱ {{ number_format($tithes->tithes_offer_tithe_amount, 2) }} </span>
                                    </h6>
                            </div>

                            <div class="col-md-2">
                                <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate"> Offering Plan Amount </p>
                                    <h6 class="text-gray  text-sm">
                                        <span> ₱ {{ number_format($tithes->tithes_offer_offering_plan_amount, 2) }} </span>
                                    </h6>
                            </div>

                            <div class="col-md-2">
                                <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate"> Other Gifts Amount </p>
                                    <h6 class="text-gray text-sm">
                                        <span> ₱ {{ number_format($tithes->tithes_offer_other_gifts_amount, 2) }} </span>
                                    </h6>
                            </div>

                            <div class="col-md-2">
                                <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate"> Other Gifts Description </p>
                                    <h6 class="text-gray  text-sm">
                                        <span class="text-truncate"> {{ $tithes->tithes_offer_other_gifts_desciption }} </span>
                                    </h6>
                            </div>


                            <div class="col-md-2"><p class="mb-1  text-xs text-color-gray-lighter gotham-book"> Type </p>
                                <h6 class="text-xs text-gray">
                                    @if ($tithes->tithes_offer_type == 'Cash')
                                        <span  class="badge badge-sm bg-gradient-warning">
                                            Cash
                                        </span>
                                    @elseif ($tithes->tithes_offer_type == 'GCash')
                                        <span  class="badge badge-sm bg-gradient-success">
                                            GCash
                                        </span>

                                    @elseif ($tithes->tithes_offer_type == 'Bank')
                                        <span  class="badge badge-sm bg-gradient-info">
                                            Bank
                                        </span>
                                    @else
                                        <span  class="badge badge-sm bg-gradient-secondary">
                                            {{ $tithes->tithes_offer_type }}
                                        </span>
                                    @endif    
                            </div>
                            
                            <div class="col-md-1">
                                <p class="mb-1  text-xs text-color-gray-lighter gotham-book">Date</p>
                                <h6 class="text-xs text-truncate">  {{ $tithes->created_at->format('d/m/Y')}} </h6>
                            </div>
                            
                            <div class="d-flex justify-content-end align-items-center col">
                                <div class="d-flex justify-content-end align-items-start">
                                    
                                        <button class="btn btn-sm btn-success"   onclick="retrieve_tithe({{$tithes->toID }})">
                                            <i class="las la-trash-restore" style="font-size: 20px" ></i>  <span class="">  Restore </span>
                                        </button>
                        
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach 
        </div>
  
<script>
    $(document).ready(function(){
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#reload1 .list-group").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    });
</script>



    <script type="text/javascript">
    function retrieve_tithe(toID) {
        swal.fire({
            title: "Restore the Data?",
            icon: 'question',
            text: "You can still retrive the record in the Trash!",
            showCancelButton: !0,
            confirmButtonText: "Yes, Move it!",
            confirmButtonColor: '#2dce89',
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then((result) => {

            if (result.isConfirmed) {

                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "/retrieve_tithe/" + toID,
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
                            $("#notifDiv").fadeOut();
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