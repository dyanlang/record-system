  <!-- Notification list -->


<div class="card-body keep-scrolling " >
    <div id='Notifs_list'>
        @foreach($notif_list as $notif_list)
            @if($notif_list->is_read == '0')    
                    <div class="list-group">
                        <a href="/view_notification/{{$notif_list->nID}}">
                            <div class=" list-group-item-custom cursor-pointer list-group-item_read">
                                <div class="media">
                                    <div class="media-body">

                                        <div class="row">
                                            <div class="col-10 mt-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex flex-column px-1">
                                                        <img src="/users/{{$notif_list->user_image}}" class="rounded-circle img-fluid" width="40" alt="">  
                                                    </div>

                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark">
                                                            <span class="text-sm"> {{$notif_list->firstname}}   {{$notif_list->lastname}} </span>
                                                        <h6 class="mb-1 text-dark text-xs">

                                                            <!-- If added new tithes and offerings record -->
                                                                @if( $notif_list->type == 'Tithes_Offering')
                                                                        @if($notif_list->notif_type == 'Added')
                                                                                added new record to tithes and offerings!

                                                                        @elseif($notif_list->notif_type == "Modified")                          
                                                                            modified a record from tithes and offerings!

                                                                        @elseif($notif_list->notif_type == "Retrieved") 
                                                                            retrieved a record from trash to tithes and offerings!

                                                                        @elseif($notif_list->notif_type == "Move To Trash") 
                                                                            moved a record from  tithes and offerings to trash!
                                                                        
                                                                        @elseif($notif_list->notif_type == "For Approval") 
                                                                            checked a record from tithes and offerings and needs your approval
                                                                        
                                                                        @elseif($notif_list->notif_type == "Declined") 
                                                                            declined a record from tithes and offerings!
                                                                        @else
                                                                                {{ $notif_list->notif_type }}

                                                                        @endif


                                                                @elseif($notif_list->type == 'Disbursement')
                                                                        @if($notif_list->notif_type == "Added")
                                                                                added new record to disbursement!

                                                                        @elseif($notif_list->notif_type == "Modified")                          
                                                                            modified a record from disbursement!
                                                                        
                                                                        @elseif($notif_list->notif_type == "Retrieved") 
                                                                            retrieved a record from trash to disbursement!

                                                                        @elseif($notif_list->notif_type == "Move To Trash") 
                                                                            moved a record from disbursement to trash!

                                                                        @elseif($notif_list->notif_type == "For Approval") 
                                                                            checked a record from disbursement and needs your approval
                                                                        
                                                                        @elseif($notif_list->notif_type == "Declined") 
                                                                            declined a record from disbursement!
                                                                        @else
                                                                            {{ $notif_list->notif_type }}
                                                                        @endif

                                                                @elseif($notif_list->type == 'Sabbath Offering')
                                                                        @if($notif_list->notif_type == "Added")
                                                                                added new record to  sabbath offering!

                                                                        @elseif($notif_list->notif_type == "Modified")                          
                                                                            modified a record from  sabbath offering!
                                                                        
                                                                        @elseif($notif_list->notif_type == "Retrieved") 
                                                                            retrieved a record from trash to sabbath offering!

                                                                        @elseif($notif_list->notif_type == "Move To Trash") 
                                                                            moved a record from  sabbath offering to trash!
                                                                        
                                                                        @elseif($notif_list->notif_type == "For Approval") 
                                                                            a record from sabbath offeringa and needs your approval!
                                                                        
                                                                        @elseif($notif_list->notif_type == "Declined") 
                                                                        declined a record sabbath offering!
                                                                        
                                                                        @else
                                                                            {{ $notif_list->notif_type }}
                                                                        @endif
                                    
                                                                @elseif($notif_list->type == 'User Info')
                                                                        @if($notif_list->notif_type == "Added")
                                                                                added new user!

                                                                        @elseif($notif_list->notif_type == "Modified")                          
                                                                            modified a user's info!
                                                                        
                                                                        @else
                                                                            {{ $notif_list->notif_type }}
                                                                        @endif
                                                                            
                                                                @elseif($notif_list->type == 'Users Info')
                                                                        @if($notif_list->notif_type == "Added")
                                                                                added new user!

                                                                        @elseif($notif_list->notif_type == "Modified")                          
                                                                            modified a user's info!
                                                                        
                                                                        @else
                                                                            {{ $notif_list->notif_type }}
                                                                        @endif

                                                                @else
                                                                {{ $notif_list->notif_type }}  {{ $notif_list -> type}}
                                                                @endif
                                                        </h6> 
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                        
                                        <div class="d-flex justify-content-end align-items-center col">
                                            <div class="d-flex justify-content-end align-items-start">
                                                <div class="dropdown"> 
                                                    <a  class="text-black px-1" 
                                                        type="btn" 
                                                        id="dropdownMenuButton2" 
                                                        data-bs-toggle="dropdown">
                                                        <i class="las la-ellipsis-v" 
                                                            style="font-size: 20px; font-weight: bolder">
                                                        </i>
                                                    </a>
                                                    <ul class="dropdown-menu" 
                                                        aria-labelledby="dropdownMenuButton2">

                                                        <a href="/view_notification/{{$notif_list->nID}}">  
                                                            <li>
                                                                <i class="las la-eye mx-2"
                                                                    style="font-size: 20px">
                                                                </i> 
                                                                <span  class="text-xs"> View </span> 
                                                            </li>
                                                        </a>
                                                        <li>
                                                            <a href="#" onclick="mark_as_read({{$notif_list->nID }})" >  
                                                                <i  class="las la-check mx-2"  
                                                                    style="font-size: 20px">
                                                                </i> 
                                                                    <span  class="text-xs"> Mark As Read  </span> 
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" onclick="remove_notification({{$notif_list->nID }})" >  
                                                                <i class="las la-times-circle  mx-2"
                                                                    style="font-size: 20px">
                                                                </i> 
                                                                    <span class="text-xs"> Remove this Notification  </span> 
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div> 
                                            </div>
                                        </div> 

                                        <div class="row">
                                            <div class="col">
                                                <p class="text-xs float-end"> 
                                                    {{$notif_list->updated_at->diffForHumans()}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

            @else
                    <div class="list-group">
                        <a href="/view_notification/{{$notif_list->nID}}"> 
                            <div class=" list-group-item-custom cursor-pointer list-group-item">
                                <div class="media">
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-10 mt-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex flex-column px-1">
                                                        <img src="/users/{{$notif_list->user_image}}" 
                                                            class="rounded-circle img-fluid" 
                                                            width="40" 
                                                            alt="IMAGE">  
                                                    </div>

                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark">
                                                            <span class="text-sm"> 
                                                                {{$notif_list->firstname}} {{$notif_list->lastname}}
                                                            </span>
                                                        <h6 class="mb-1 text-dark text-xs">
                                                            <!-- If added new tithes and offerings record -->
                                                            @if( $notif_list->type == 'Tithes_Offering')
                                                                    @if($notif_list->notif_type == 'Added')
                                                                            added new record to tithes and offerings!

                                                                    @elseif($notif_list->notif_type == "Modified")                          
                                                                        modified a record from tithes and offerings!

                                                                    @elseif($notif_list->notif_type == "Retrieved") 
                                                                        retrieved a record from trash to tithes and offerings!

                                                                    @elseif($notif_list->notif_type == "Move To Trash") 
                                                                        moved a record from  tithes and offerings to trash!
                                                                    
                                                                    @elseif($notif_list->notif_type == "For Approval") 
                                                                        checked a record from tithes and offerings and needs your approval
                                                                    
                                                                    @elseif($notif_list->notif_type == "Declined") 
                                                                        declined a record from tithes and offerings!
                                                                    @else
                                                                            {{ $notif_list->notif_type }}

                                                                    @endif


                                                            @elseif($notif_list->type == 'Disbursement')

                                                                @if($notif_list->notif_type == "Added")
                                                                        added new record to disbursement!

                                                                @elseif($notif_list->notif_type == "Modified")                          
                                                                    modified a record from disbursement!
                                                                
                                                                @elseif($notif_list->notif_type == "Retrieved") 
                                                                    retrieved a record from trash to disbursement!

                                                                @elseif($notif_list->notif_type == "Move To Trash") 
                                                                    moved a record from disbursement to trash!

                                                                @elseif($notif_list->notif_type == "For Approval") 
                                                                checked a record from disbursement and needs your approval
                                                                
                                                                @elseif($notif_list->notif_type == "Declined") 
                                                                    declined a record from disbursement!
                                                                @else
                                                                    {{ $notif_list->notif_type }}
                                                                @endif

                                                            @elseif($notif_list->type == 'Sabbath Offering')
                                                                @if($notif_list->notif_type == "Added")
                                                                        added new record to  sabbath offering!

                                                                @elseif($notif_list->notif_type == "Modified")                          
                                                                    modified a record from  sabbath offering!
                                                                
                                                                @elseif($notif_list->notif_type == "Retrieved") 
                                                                    retrieved a record from trash to sabbath offering!

                                                                @elseif($notif_list->notif_type == "Move To Trash") 
                                                                    moved a record from  sabbath offering to trash!
                                                                
                                                                @elseif($notif_list->notif_type == "For Approval") 
                                                                    a record from sabbath offeringa and needs your approval!
                                                                
                                                                @elseif($notif_list->notif_type == "Declined") 
                                                                declined a record sabbath offering!
                                                                
                                                                @else
                                                                    {{ $notif_list->notif_type }}
                                                                @endif
                                        
                                                            @elseif($notif_list->type == 'User Info')
                                                                @if($notif_list->notif_type == "Added")
                                                                        added new user!

                                                                @elseif($notif_list->notif_type == "Modified")                          
                                                                    modified a user's info!
                                                                
                                                                @else
                                                                    {{ $notif_list->notif_type }}
                                                                @endif
                                        
                                                            @elseif($notif_list->type == 'Users Info')
                                                                @if($notif_list->notif_type == "Added")
                                                                        added new user!

                                                                @elseif($notif_list->notif_type == "Modified")                          
                                                                    modified a user's info!
                                                                
                                                                @else
                                                                    {{ $notif_list->notif_type }}
                                                                @endif

                                        
                                                            @else
                                                                {{ $notif_list->notif_type }}  {{ $notif_list -> type}}
                                                            @endiF
                                                        </h6>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        
                                        <div class="d-flex justify-content-end align-items-center col">
                                            <div class="d-flex justify-content-end align-items-start">
                                                <div class="dropdown"> 
                                                    <a  class="text-black px-1" 
                                                        type="btn" id="dropdownMenuButton2" 
                                                        data-bs-toggle="dropdown">
                                                        <i class="las la-ellipsis-v" 
                                                        style="font-size: 20px; font-weight: bolder">
                                                        </i>
                                                    </a>

                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            
                                                        <a href="/view_notification/{{$notif_list->nID}}">  
                                                            <li>    
                                                                <i  class="las la-eye mx-2"  
                                                                    style="font-size: 20px">
                                                                </i> 
                                                                <span  class="text-xs"> View </span> 
                                                            </li>
                                                        </a>

                                                        <li>
                                                            <a href="#" onclick="remove_notification({{$notif_list->nID }})" >  
                                                                <i  class="las la-times-circle  mx-2" 
                                                                    style="font-size: 20px">
                                                                </i> 
                                                                <span class="text-xs">
                                                                    Remove this Notification
                                                                </span> 
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div> 
                                            </div>
                                        </div> 

                                        <div class="row">
                                            <div class="col">
                                                <p class="text-xs float-end"> 
                                                    {{$notif_list->created_at->diffForHumans()}} 
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endif
        @endforeach  
    </div>
</div>


<script type="text/javascript">
      function remove_notification(nID) {
        swal.fire({
            title: "Remove this notification?",
            icon: 'question',
            showCancelButton: !0,
            confirmButtonText: "Yes, Remove it!",
            confirmButtonColor: '#2dce89',
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then((result) => {

            if (result.isConfirmed) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: "/remove_notification/" + nID,
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
                            "timeOut": "2000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        toastr.success("You have remove notification!");
                        setTimeout(function(){
                            $("#notifDiv").fadeOut();
                            $("#pending").load(window.location.href + " #pending" );
                            $("#reload").load(window.location.href + " #reload" );
                            $("#Notifs_list").load(window.location.href + " #Notifs_list" );
                        },2000);
                    }
                });
              } 
            },  function (dismiss) {
           return false;
        })
      }
  </script>
  
  
  <script type="text/javascript">
      function mark_as_read(nID) {
        swal.fire({
            title: "Mark notification as read?",
            icon: 'question',
            showCancelButton: !0,
            confirmButtonText: "Yes, Mark it!",
            confirmButtonColor: '#2dce89',
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then((result) => {

            if (result.isConfirmed) {
               var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: "/mark_as_read/" + nID,
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
                            "timeOut": "3000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        toastr.success("The notification is now mark as read!");
                        setTimeout(function(){
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