<div class="row mx-4 pt-4">
    <div class="col-md-6">
        <h6 class="text-gray  text-sm">
            <span>
                <h6 class="text-sm">       Total No. of records {{ $move_disbursement->count() }}

                </h6>
            </span>
        </h6>
    </div>
    <div class="col-md-6">
        <div class="form-group">
                <input class="form-control" id="myInput3" type="text" placeholder="Search..">     </div>
        </div>
   </div>

<div id="reload3" class="keep-scrollin ">


@foreach ($move_disbursement as $move_disbursement)
    <div class="list-group mx-4" >
        <div class=" list-group-item-custom cursor-pointer list-group-item">
            <div class="media">
                <div class="media-body">
                    <div class="row my-2">
                        <div class="col-md-3">
                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book">  Department </p>
                                <h6 class="text-gray  text-sm">
                                {{ $move_disbursement->disbursement_purpose }}
                                </h6>
                        </div>

                        <div class="col-md-2">
                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate">  Amount </p>
                                <h6 class="text-gray  text-sm">
                                    <span> ₱ {{ $move_disbursement->disbursement_amount }} </span>
                                </h6>
                        </div>

                        <div class="col-md-3">
                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate">  Description </p>
                                <h6 class="text-gray  text-sm">
                                    <span> 
                                    {{ $move_disbursement->disbursement_description }}
                                
                                    </span>
                                </h6>
                        </div>

                        <div class="col-md-2">
                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate">  Status </p>
                                <h6 class="text-gray  text-sm">
                                    <span> 

                                    @if ($move_disbursement->disbursement_type_status == 'Pending')
                                    <span  class="badge badge-sm bg-gradient-warning">   {{ $move_disbursement->disbursement_type_status }} </span> </h6>
                                    @elseif ($move_disbursement->disbursement_type_status == 'Approved')
                                    <span  class="badge badge-sm bg-gradient-success">   {{ $move_disbursement->disbursement_type_status }}  </span> </h6>
                                    @elseif($move_disbursement->disbursement_type_status == '')
                                        <span  class="badge badge-sm bg-gradient-secondary">   None  </span> </h6>
                                    @else
                                    <span  class="badge badge-sm bg-gradient-info">  {{ $move_disbursement->disbursement_type_status }}   </span> </h6>
                                    @endif
                                    
                                
                                    </span>
                                </h6>
                        </div>

                        <div class="col">
                            <p class="mb-1   text-xs text-color-gray-lighter gotham-book text-truncate">  Date  </p>
                                <h6 class="text-gray  text-sm">
                                    <span> 
                                    {{ $move_disbursement->created_at->format('d/m/Y')}}
                                
                                    </span>
                                </h6>
                        </div>
                            
                            <div class="d-flex justify-content-end align-items-center col">
                                <div class="d-flex justify-content-end align-items-start">
                                    <!-- <form method="POST" action="/retrieve_disbursement/{{ $move_disbursement->dsID }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT') -->

                                        <!-- <input type="hidden" name="dsID" id="dsID" value="{{ $move_disbursement->dsID }}" required> -->

                                        <button class="btn btn-sm btn-success"   onclick="retrieve_disbursement({{$move_disbursement->dsID }})" >
                                            <i class="las la-trash-restore" style="font-size: 20px" ></i>  <span class="">  Restore </span>
                                        </button>
<!--                                             
                                    </form> -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach 
    </div>


    <script>
    $(document).ready(function(){
    $("#myInput3").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#reload3 .list-group").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    });
</script>
    <script type="text/javascript">
    function retrieve_disbursement(dsID) {
        swal.fire({
            title:"Restore the Data?",
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
                    url: "/retrieve_disbursement/" + dsID,
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
                                toastr.success("You have successfully move the record to trash!");
                                $("#reload3").load(window.location.href + " #reload3" );
                        // refresh page after 2 seconds
                        setTimeout(function(){
                            $("#notifDiv").fadeOut();
                            $("#pending").load(window.location.href + " #pending" );         
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