@extends('layouts.DashB')
@section('content') 

@php
$date =    date_default_timezone_set('Asia/Manila');

@endphp


<div class="container-fluid">
    <div class="row">
        
        <div class="col-lg-12 mt-4">
            <div class=" mb-0">
                <h4 class="font-weight-bolder text-white "> Disbursement / Report  </h4> 
            </div>
            <div class="no-gutters row">
                <div class="d-flex justify-content-between ">
                    <span class="text-left text-white"> @php  $dtae = date_default_timezone_set('Asia/Manila') @endphp {{  date('F j, Y g:i:a') }}</span>
            <!-- button ADD -->
                  
                </div>
            </div>
          

            <div class="container bg-white mt-2">
                    <div class="container rounded bg-white">
                        <div class="row">
                            <div  class="d-flex justify-content-between  mt-5">
                                <div>
                                    <a href="/disbursement_report">
                                            <span class="text-gray " > <i class="las la-arrow-left" style="font-size: 22px">   </i> <span"> Go Back </span> </span>                   
                                    </a>
                                </div>
                        <div>
                            <form method="POST" action="{{ route('add.disbursement') }}" enctype="multipart/form-data">
                                @csrf
                                <br>
                                   
                                        <input type="hidden" class="form-control" name="uID" id="uID"
                                                value="{{ Auth::user()->uID }}" readonly>

                            
                                    <button type="submit" class="btn btn-sm btn-success mx-1 ">
                                        <span class="text-sm"  > <i class="las la-save"  style="font-size: 20px"></i> </span>                   
                                    </button>
                                        
                                    </div>
                                    </div>

                                    <div class="container rounded bg-white">
                                        <div class="row">
                                            <div class="col-md-5 border-right">
                                                <div class="d-flex flex-column  p-3 py-5">

                                                <div>
                                                    <h5> Upload Image </h5>
                                                </div>
                                                <div class="form-group">
                                                            <tr>
                                                                <th scope="col">
                                                                    <label for="disbursement_file">Disbursement File</label>
                                                                </th>
                                                                <td><input type="file" class="form-control" name="disbursement_file" id="disbursement_file"
                                                                required>
                                                                    <label for="disbursement_status"></label>
                                                                    <input type="hidden" class="form-control" name="disbursement_status" id="disbursement_status"
                                                                    value="1" readonly>
                                                                    <label for="disbursement_delete_status"></label>
                                                                    <input type="hidden" class="form-control" name="disbursement_delete_status" id="disbursement_delete_status"
                                                                    value="1" readonly>
                                                                </td>
                                                            </tr>
                                                    </div>
                                                </div>
                                            </div>



                                    <div class="col-md-5 border-right">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="text-right text-uppercase"> ADD Disbursement</h4>
                                        </div>
                                        <tr>
                                            <th scope="col">
                                                <label name="disbursement_purpose" for="disbursement_purpose">Disbursement Purpose</label>
                                            </th>
                                            <br>
                                            <td><select name="disbursement_purpose" id="disbursement_purpose" class="form-control">
                                                <!-- This is where we set the value to be displayed-->
                                                <option name="disbursement_purpose" value="" selected disabled hidden>
                                                <-- Select an Option -->
                                                </option>
                                                <option name="disbursement_purpose" id="disbursement_purpose" value="Electric Bill">Electric Bill</option>
                                                <option name="disbursement_purpose" id="disbursement_purpose" value="Water Bill">Water Bill</option>
                                                <option name="disbursement_purpose" id="disbursement_purpose" value="Ministry Fund">Ministry Fund</option>
                                                <option name="disbursement_purpose" id="disbursement_purpose" value="Youth Activities">Youth Activities</option>
                                                <option name="disbursement_purpose" id="disbursement_purpose" value="Others">Others</option>
                                            </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">
                                                <label name="disbursement_type" for="disbursement_type">Disbursement Type</label>
                                            </th>
                                            <br>
                                            <td><select name="disbursement_type" id="disbursement_type" class="form-control">
                                                <!-- This is where we set the value to be displayed-->
                                                <option name="disbursement_type" value="" selected disabled hidden>
                                                <-- Select an Option -->
                                                </option>
                                                <option name="disbursement_type" id="disbursement_type" value="0">Cash</option>
                                                <option name="disbursement_type" id="disbursement_type" value="1">Online Payment</option>
                                                <option name="disbursement_type" id="disbursement_type" value="2">Check</option>
                                            </select>
                                            </td>
                                        </tr>
                                        <br>
                                        <div class="form-group">
                                        <tr>
                                            <th scope="col">
                                                <label for="disbursement_amount">Disbursement Amount</label>
                                            </th>
                                            <td><input type="number" class="form-control" name="disbursement_amount" id="disbursement_amount" min="1"
                                                value="" required>
                                            </td>
                                        </tr>
                                    </div>
                                    
                                    
                                   
                                </div>
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>


@endsection