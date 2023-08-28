@extends('layouts.DashB')
@section('content')
<script>
    $(document).ready(function(){
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
            $('#myTab a[href="' + activeTab + '"]').tab('show');
        }
    });
    </script>


                                             
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 ml-1 mt-4 mb-3">
            <div class=" mb-0">
                <h4 class="font-weight-bolder text-white "> Trash Records  </h4> 
            </div>
            <div class="no-gutters row">
                <div class="d-flex justify-content-between ">
                    <span class="text-left text-white mx-3"> 
                        @php  
                            $dtae = date_default_timezone_set('Asia/Manila') 
                        @endphp

                        {{ date('F j, Y g:i a') }} 
                    </span>
                </div>
            </div>
        </div>
       
        <!-- start -->
        <div class="bs-example mt-4"id="trash_records_declined">
            <div class="scroll">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="nav-item" id="list_trash_records_offerings">
                        <a href="#sectionA" class="nav-link active text-sm" data-toggle="tab"> Tithes & Offerings </a>
                    </li>
                    <li class="nav-item" id="list_trash_records_sabbath">
                        <a href="#sectionB" class="nav-link text-sm" data-toggle="tab"> Sabbath Offerings </a>
                    </li>
                    <li class="nav-item" id="list_trash_records_disbursement">
                        <a href="#sectionC" class="nav-link text-sm" data-toggle="tab"> Disbursement</a>
                    </li>
                    <li class="nav-item" id="list_trash_records_request_tithes_offerings">
                        <a href="#sectionD" class="nav-link text-sm" data-toggle="tab"> Declined Request (Tithes & Offerings) </a>
                    </li>
                    <li class="nav-item" id="trash_records_declined_request_tithes_offerings">
                        <a href="#sectionE" class="nav-link text-sm" data-toggle="tab"> Declined Request (Sabbath Offerings) </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="trash_records_list_of_records">
                <div id="sectionA" class="tab-pane fade show active bg-white">
                    @if($deleted_tithe->count() > 0)

                        @include('admin.move_to_trash.tithes_offering')

                    @else
                        <center>
                            <div class="text-gray py-10 mx-auto vh-100"> 
                                <h4 class="opacity-2"> There's no recent activities here. </h4>
                            </div>
                        </center>
                    @endif
                    
                </div>

                <div id="sectionB" class="tab-pane fade bg-white">
                    @if($deleted_sabbath->count() > 0)

                        @include('admin.move_to_trash.sabbath_offering')

                    @else
                        <center>
                            <div class="text-gray py-10 mx-auto vh-100"> 
                                <h4 class="opacity-2"> There's no recent activities here. </h4>
                            </div>
                        </center>
                    @endif
                </div>

                <div id="sectionC" class="tab-pane fade bg-white">
                    @if($move_disbursement->count() > 0)

                        @include('admin.move_to_trash.disbursement_record')

                    @else
                        <center>
                            <div class="text-gray py-10 mx-auto vh-100"> 
                                <h4 class="opacity-2"> There's no recent activities here. </h4>
                            </div>
                        </center>
                    @endif
                </div>

                <div id="sectionD" class="tab-pane fade bg-white">
                    @if($declined_member_request->count() > 0)

                        @include('admin.move_to_trash.decline_request')

                    @else
                        <center>
                            <div class="text-gray py-10 mx-auto vh-100"> 
                                <h4 class="opacity-2"> There's no recent activities here. </h4>
                            </div>
                        </center>
                    @endif
                </div>
                

                <div id="sectionE" class="tab-pane fade bg-white">
                    @if($declined_sabbath_offering_request->count() > 0)

                        @include('admin.move_to_trash.declined_sabbath_offering_request')

                    @else
                        <center>
                            <div class="text-gray py-10 mx-auto vh-100"> 
                                <h4 class="opacity-2"> There's no recent activities here. </h4>
                            </div>
                        </center>
                    @endif
                </div>
                
            </div>
        </div>
        <!-- end -->
    </div>
</div>
       
@endsection



