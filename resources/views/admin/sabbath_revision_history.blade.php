@extends('layouts.DashB')
@section('content')

                                             
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class=" ml-1 mb-0">
                <h4 class="font-weight-bolder text-white"> Revision History  </h4> 
            </div>
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
        <div id="ALL" class="mt-5 tab-pane fade show active keep-scrollin"> 
            <div class=" overflow-hidden">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="card"  id="reload">
                            <h3 class="px-4 pt-4 " > </h3>

                            <div class="mx-4">
                                <a href="/sabbath-offerings/records">
                                        <span id="goback_sabbath_revision_history"
                                             class="text-gray text-sm" > 
                                             <i class="las la-arrow-left" 
                                                style="font-size: 12px">  
                                             </i> 
                                             <span"> GO BACK </span> 
                                            </span>                   
                                </a>
                            </div>
                    
                             <div class="card-body">              
                              @if($revHistory->count() > 0)
                                @foreach ($revHistory as $revision)
                                    <div class="list-group">
                                      <div class=" list-group-item-custom cursor-pointer list-group-item">
                                        <div class="media">
                                          <div class="media-body" id="list_sabbath_revision_history">
                                            <div class="row  my-2">

                                            <div class="col">
                                                <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> No </p>
                                                    <h6 class="text-gray  text-sm">
                                                        <span><h6 class="text-sm">    {{ $loop->iteration }}  </h6></span>
                                                    </h6>
                                            </div>

                                            <div class="col-md-3">
                                                  <p class="mb-1   text-xs text-color-gray-lighter gotham-book"> Description   </p>
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


                                                <div class="col-md-3">
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

                                                <div class="col-md-3"><p class="mb-1  text-truncate text-xs text-color-gray-lighter gotham-book">  Type  </p>
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
