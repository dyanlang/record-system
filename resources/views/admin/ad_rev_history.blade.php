@extends('layouts.DashB')
@section('content')

                                             
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mt-4">
            <div class=" mb-0 ml-2">
                <h4 class="font-weight-bolder text-white "> Revision History  </h4> 
            <div class="no-gutters row">
                <div class="d-flex justify-content-between ">
                    <span class="text-left text-white"> 
                        @php  
                            $dtae = date_default_timezone_set('Asia/Manila') 
                        @endphp

                        {{  date('F j, Y g:i a  ') }} 
                    </span>
                </div>
            </div>
        </div>

    
    <!-- ALL -->
        <div id="ALL" class="tab-pane fade show active mt-5"> 
            <div class=" overflow-hidden">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="card"  id="reload">
                            <h3 class="px-4 pt-4 " > Revision Records </h3>

                            <div class="mx-4">
                                <a href="/tithes&offerings/reports"> 
                                  <span id="go_back_edit_details" 
                                        class="text-gray text-sm" > 
                                        <i class="las la-arrow-left" 
                                           style="font-size: 20px">  
                                        </i>
                                        <span >  GO BACK  </span> 
                                  </span>                   
                                </a>
                            </div>
                    
                             <div class="card-body">              
                              @if($revHistory->count() > 0)
                                @foreach ($revHistory as $revision)
                                  @if ($revision->tithes_offer_type == 'Cash')
                                    <div class="list-group">
                                      <div class=" list-group-item-custom cursor-pointer list-group-item">
                                        <div class="media">
                                          <div class="media-body" id="list_revision_history">
                                            <div class="row  my-2">
                                                <div class="col-md-2">
                                                  <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Name  </p>
                                                    <h6 class="text-gray">
                                                      <span><h6 class="text-sm ">  {{ $revision->firstname }} {{ $revision->lastname }} </h6></span>
                                                    </h6>
                                                </div>

                                                <div class="col-md-2">
                                                  <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Tithe Amount   </p>
                                                    <h6 class="text-gray">
                                                      <span>
                                                        <h6 class="text-sm text-truncate">  
                                                          @if ($revision->rev_tithe_amount != null)
                                                            <u> {{ number_format($revision->rev_tithe_amount, 2) }} </u> <br>
                                                          @endif
                                                        </h6>
                                                      </span>
                                                    </h6>
                                                </div>

                                                <div class="col-md-2">
                                                  <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Offering Plan   </p>
                                                    <h6 class="text-gray">
                                                      <span>
                                                        <h6 class="text-sm text-truncate">  
                                                          @if ($revision->rev_offer_amount != null)
                                                            <u> {{ number_format($revision->rev_offer_amount, 2) }} </u> <br>
                                                          @endif
                                                        </h6>
                                                      </span>
                                                    </h6>
                                                </div>

                                                <div class="col-md-2">
                                                  <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Other gifts   </p>
                                                    <h6 class="text-gray">
                                                      <span>
                                                        <h6 class="text-sm text-truncate">  
                                                          @if ($revision->rev_gifts_amount != null)
                                                            <u> {{ number_format($revision->rev_gifts_amount, 2) }} </u> <br>
                                                          @endif
                                                        </h6>
                                                      </span>
                                                    </h6>
                                                </div>

                                                <div class="col-md-2">
                                                  <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Offering Plan   </p>
                                                    <h6 class="text-gray">
                                                      <span>
                                                        <h6 class="text-sm text-truncate">  
                                                          @if ($revision->rev_description != null)
                                                            <u> {{ $revision->rev_description }} </u> <br>
                                                          @endif
                                                        </h6>
                                                      </span>
                                                    </h6>
                                                </div>

                                                <div class="col-md-1"><p class="mb-1  text-truncate text-xs text-color-gray-lighter gotham-book">  Type  </p>
                                                  <h6 class="text-sm text-gray">
                                                  @if ($revision->rev_type != null)
                                                      @if ($revision->rev_type == 0)                                        
                                                          <u> Cash </u>
                                                      @elseif ($revision->rev_type == 1)
                                                          <u>  Online Payment </u>
                                                      @elseif ($revision->rev_type == 2)
                                                          <u>  Check </u>
                                                      @endif
                                                  @endif
                                                  </h6>
                                              </div>

                                              <div class="col"><p class="mb-1  text-xs text-color-gray-lighter gotham-book">Date</p>
                                                  <h6 class="text-sm text-gray">
                                                      {{ $revision->rev_date }}
                                              </div>


                                  @elseif ($revision->tithes_offer_type == 'Online Payment')


                                              <div class="col-md-2">
                                                  <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Name  </p>
                                                    <h6 class="text-gray">
                                                      <span><h6 class="text-sm ">  {{ $revision->firstname }} {{ $revision->lastname }} </h6></span>
                                                    </h6>
                                                </div>

                                                <div class="col-md-2">
                                                  <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Tithe Amount   </p>
                                                    <h6 class="text-gray">
                                                      <span>
                                                        <h6 class="text-sm text-truncate">  
                                                          @if ($revision->rev_tithe_amount != null)
                                                            <u> {{ number_format($revision->rev_tithe_amount, 2) }} </u> <br>
                                                          @endif
                                                        </h6>
                                                      </span>
                                                    </h6>
                                                </div>

                                                <div class="col-md-2">
                                                  <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Offering Plan   </p>
                                                    <h6 class="text-gray">
                                                      <span>
                                                        <h6 class="text-sm text-truncate">  
                                                          @if ($revision->rev_offer_amount != null)
                                                            <u> {{ number_format($revision->rev_offer_amount, 2) }} </u> <br>
                                                          @endif
                                                        </h6>
                                                      </span>
                                                    </h6>
                                                </div>

                                                <div class="col-md-2">
                                                  <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Offering Plan   </p>
                                                    <h6 class="text-gray">
                                                      <span>
                                                        <h6 class="text-sm text-truncate">  
                                                          @if ($revision->rev_gifts_amount != null)
                                                            <u> {{ number_format($revision->rev_gifts_amount, 2) }} </u> <br>
                                                          @endif
                                                        </h6>
                                                      </span>
                                                    </h6>
                                                </div>

                                                <div class="col-md-2">
                                                  <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Offering Plan   </p>
                                                    <h6 class="text-gray">
                                                      <span>
                                                        <h6 class="text-sm text-truncate">  
                                                          @if ($revision->rev_description != null)
                                                            <u> {{ number_format($revision->rev_description, 2) }} </u> <br>
                                                          @endif
                                                        </h6>
                                                      </span>
                                                    </h6>
                                                </div>

                                                <div class="col-md-3"><p class="mb-1  text-xs text-color-gray-lighter gotham-book"> Payment Method  </p>
                                                  <h6 class="text-sm text-gray">
                                                  @if ($revision->rev_type != null)
                                                      @if ($revision->rev_type == 0)                                        
                                                          <u> Cash </u>
                                                      @elseif ($revision->rev_type == 1)
                                                          <u>  Online Payment </u>
                                                      @elseif ($revision->rev_type == 2)
                                                          <u>  Check </u>
                                                      @endif
                                                  @endif
                                                  </h6>
                                              </div>

                                              <div class="col-md-2"><p class="mb-1  text-xs text-color-gray-lighter gotham-book">Date</p>
                                                  <h6 class="text-sm text-gray">
                                                      {{ $revision->rev_date }}
                                              </div>

                            
                                            @endif
                                      
                                          
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  
                                  </div>


                              @endforeach 
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
<!-- END ALL -->
                                
<!-- end of tabs  -->

@endsection
