<div class="row mx-4">
    <div class="col-md-6">
        <h6 class="text-gray  text-sm">
            <span>
                <h6 class="text-sm">       Total No. of records {{ $tithesRep1->count() }}

                </h6>
            </span>
        </h6>
    </div>
    <div class="col-md-6" id="search_tithes_offerings">
        <div class="form-group">
                <input class="form-control" id="myInput" type="text" placeholder="Search..">     </div>
        </div>
   </div>

<div id="reload">
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


                            <div class="col-md-2">
                                <p class="mb-1 mx-3 text-xs text-color-gray-lighter gotham-book"> Type </p>
                                <h6 class="text-xs  mx-3 text-gray">
                                    @if ($tithes1->tithes_offer_type == 'Cash')

                                        <span class="badge badge-sm bg-gradient-warning">
                                            {{ $tithes1->tithes_offer_type }}
                                        </span></h6>

                                    @elseif ($tithes1->tithes_offer_type == 'GCash')

                                        <span class="badge badge-sm bg-gradient-success">
                                            {{ $tithes1->tithes_offer_type }}
                                        </span></h6>

                                    @elseif ($tithes1->tithes_offer_type == 'Bank')

                                        <span class="badge badge-sm bg-gradient-info">
                                            {{ $tithes1->tithes_offer_type }}
                                        </span></h6>

                                    @elseif($tithes1->tithes_offer_type == '')
                                            <span class="badge badge-sm bg-gradient-secondary">
                                            None
                                        </span></h6>
                                    @else

                                        <span class="badge badge-sm bg-gradient-primary">
                                            {{ $tithes1->tithes_offer_type }}
                                        </span></h6>

                                    @endif
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
                                                        <a  class="dropdown-item" href="/tithe_view/{{ $tithes1->toID }}">  
                                                            <i class="las la-door-open px-2"  style="font-size: 20px;"></i> 
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
                                                    <a type="btn" class="dropdown-item"  onclick="deleteRecord({{$tithes1->toID }})">
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
