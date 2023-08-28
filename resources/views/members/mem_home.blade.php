@extends('layouts.member')
@section('content')

<section>
    <div class="container" style="max-width: 1500%;">
        <div class="row" style="justify-content: center">
            <div class="col-md-11 mt-4">
                <div class=" mb-0">
                    <a href="/home">
                        <h4 class="font-weight-bolder text-white ">Welcome, {{ Auth::user()->firstname }}!</h4>
                    </a>
                </div>
                <div class="no-gutters row">
                    <div class="d-flex justify-content-between ">
                        <span class="text-left text-white">
                            @php  
                                $dtae = date_default_timezone_set('Asia/Manila') 
                            @endphp 
                            
                                {{ date('F j, Y g:i a') }}
                        </span>
                       

                        <button type="button" class="btn btn-success btn-sm" id="profile_picture_online_payment">
                            <span id="church_member_list_add_member" class="text-sm text-end" data-toggle="modal" data-target="#bd-example-modal-lg">Online Payment Details</span>
                        </button>

                            <div class="modal fade" id="bd-example-modal-lg" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title text-white" id="staticBackdropLabel">
                                                        Online Payment Details
                                                    </h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="container">

                                                        @if ($get_gcash->count() > 0)
                                                            @foreach ($get_gcash as $gcash)
                                                                <div class="row mt-3 pb-3" style="border-bottom: 1px dotted lightgray">
                                                                    <div class="col-md-6">
                                                                        <center>
                                                                            <img src="/payments/{{ $gcash->on_gcash_image }}" alt="avatar" class="img-fluid" style="max-width: 100%;">
                                                                        </center>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                            <label style="font-size: 14px">GCash Account Name:</label>
                                                                            <p style="background-color: #e3e3e3; border: 1px solid gray; border-radius: 6px; font-size: 14px; padding: 5px">
                                                                                {{ $gcash->on_account_name }}
                                                                            </p>

                                                                            <label style="font-size: 14px">Contact Number:</label>
                                                                            <p style="background-color: #e3e3e3; border: 1px solid gray; border-radius: 6px; font-size: 14px; padding: 5px">
                                                                                {{ $gcash->on_contact_number }}
                                                                            </p>
                                                                    </div>
                                                
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <center>
                                                                <div class="text-gray p-6 m-3"> 
                                                                    <h4 class="opacity-2">
                                                                        No details for GCash
                                                                    </h4>
                                                                </div>
                                                            </center>
                                                        @endif
                                                        
                                                    </div>

                                     
                                                    <div class="container">
                                                            @if ($get_bank->count() > 0)
                                                                @foreach ($get_bank as $bank)
                                                                    <div class="row mt-3 pb-3" style="border-bottom: 1px dotted lightgray">
                                                                        <div class="col-md-12">
                                                                            <label style="font-size: 14px">Bank Name:</label>
                                                                            <p style="background-color: #e3e3e3; border: 1px solid gray; border-radius: 6px; font-size: 14px; padding: 5px">
                                                                                {{ $bank->on_bank_name }}
                                                                            </p>

                                                                            <label style="font-size: 14px">Account Name:</label>
                                                                            <p style="background-color: #e3e3e3; border: 1px solid gray; border-radius: 6px; font-size: 14px; padding: 5px">
                                                                                {{ $bank->on_account_name }}
                                                                            </p>

                                                                            <label style="font-size: 14px">Account Number:</label>
                                                                            <p style="background-color: #e3e3e3; border: 1px solid gray; border-radius: 6px; font-size: 14px; padding: 5px">
                                                                                {{ $bank->on_bank_account_number }}
                                                                            </p>

                                                                            <label style="font-size: 14px">Contact Number:</label>
                                                                            <p style="background-color: #e3e3e3; border: 1px solid gray; border-radius: 6px; font-size: 14px; padding: 5px">
                                                                                {{ $bank->on_contact_number }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <center>
                                                                    <div class="text-gray p-6 m-3"> 
                                                                        <h4 class="opacity-2">
                                                                            No details for E-Wallet/Bank
                                                                        </h4>
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
                </div>
            </div>


        </div>

        <div class="row mt-3" style="justify-content: center">
        
            <div class="col-md-4 mt-4">
                <div class="row">
                    <div class="col-md-11" id="profile_picture_member_profile">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="/users/{{ Auth::user()->user_image }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                <h5 class="my-3">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h5>
                                <p class="text-muted mb-3">  
                                    Church Member
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row mt-4" style="justify-content: center">
                    <div class="col-md-12">
                        <div class="card mb-3" id="add_tithes_member_profile">
                            <div class="card-header">
                                <h5>ADD TITHES AND OFFERINGS</h5>
                            </div>
                            <div class="card-body">
                                        <div class="row mb-3 ">
                                            <button type="button" id="add_tithes_member_profile_payment_button" class="btn btn-primary btn-update" style="font-size: 20px;">
                                                <span data-toggle="modal" data-target="#bank">
                                                    <i class="las la-wallet" style="font-size: 20px;"></i>&nbsp; PAYMENT TRANSACTION
                                                </span> 
                                            </button>
                                        </div>

                                        <!-- MODAL TITHES -->

                                        <div class="modal fade" id="bank" data-backdrop="static" tabindex="-1" role="dialog"        
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title text-white" id="staticBackdropLabel">
                                                            Transaction Details
                                                        </h5>
                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                    <form id="main_form">
                                                    @csrf
                                                        <div class="container">
                                                            <div class="row">
                                                                
                                                                    <label style="font-size: 12px">Select Transaction:</label>
                                                                    <select type="text" class="form-select tithes_offer_type"
                                                                        style="cursor: pointer" name="tithes_offer_type" id="tithes_offer_type" required>
                                                                        <option disabled selected value></option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option disabled></option>
                                                                        <option value="Bank">BPI / BPI Family Savings Bank</option>
                                                                        <option value="Bank">BDO Unibank, Inc.</option>
                                                                        <option value="Bank">
                                                                            Metropolitan Bank and Trust Co.
                                                                        </option>
                                                                        <option value="GCash">G-Xchange / GCash</option>
                                                                        <option value="Bank">LANDBANK / OFBank</option>
                                                                        <option value="Bank">
                                                                            Maya Philippines, Inc. / Maya Wallet
                                                                        </option>
                                                                        <option value="Bank">Union Bank of the Philippines</option>
                                                                        <option value="Bank">Philippine National Bank</option>
                                                                    </select>
                                                                
                                                            </div>

                                                            

                                                            

                                                            <div class="row" id="type-field-1">
                                                                <div class="col">
                                                                    <label style="font-size: 12px">Account No.:</label>
                                                                    <input name="tithes_account_number" id="tithes_account_number" type="number" 
                                                                        class="form-control" min="0">
                                                                </div>

                                                                <div class="col">
                                                                    <label style="font-size: 12px">Account Name:</label>
                                                                    <input name="tithes_account_name" id="tithes_account_name" type="text" 
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="row" id="type-field-2">
                                                                <div class="col">
                                                                    <label style="font-size: 12px">Reference No.:</label>
                                                                    <input name="tithes_reference_number" id="tithes_reference_number" type="number" 
                                                                        class="form-control" min="0">
                                                                </div>
                                                            </div>

                                                            <div class="row" id="type-field-6">
                                                                <div class="col">
                                                                    <label style="font-size: 12px">Date:</label>
                                                                    <input name="tithes_offer_date" id="tithes_offer_date" type="date" 
                                                                        class="form-control" required>
                                                                </div>
                                                                
                                                            </div>

                                                            <div class="row" id="type-field-3">
                                                                    <label style="font-size: 12px">Receipt:</label>
                                                                    <input name="tithes_reciept" id="tithes_reciept" type="file" class="form-control">
                                                            </div>
                                                            <br>

                                                            <div class="row" id="type-field-4">
                                                                <div class="col">
                                                                    <label for="tithes_offer_tithe_amount" style="font-size: 12px">Tithes Amnt</label>
                                                                    <input id="tithes_offer_tithe_amount" type="number" class="form-control" 
                                                                        name="tithes_offer_tithe_amount" placeholder="Amount" min="1" max="10000" onchange="summation()">
                                                                </div>

                                                                <div class="col">
                                                                    <label for="tithes_offer_offering_plan_amount" 
                                                                        style="font-size: 12px">Offering Plan Amnt</label>
                                                                    <input id="tithes_offer_offering_plan_amount" type="number" class="form-control" 
                                                                        name="tithes_offer_offering_plan_amount" placeholder="Amount" min="1" max="10000" onchange="summation()">
                                                                </div>
                                                            </div>

                                                            <div class="row" id="type-field-5">
                                                                <div class="col">
                                                                    <label for="tithes_offer_other_gifts_amount"
                                                                        style="font-size: 12px">Other Gifts Amnt</label>
                                                                    <input id="tithes_offer_other_gifts_amount" type="number" class="form-control" 
                                                                        name="tithes_offer_other_gifts_amount" placeholder="Amount" min="1" max="10000" onchange="summation()">
                                                                </div>

                                                                <div class="col">
                                                                    <label for="tithes_offer_other_gifts_desciption" 
                                                                        style="font-size: 12px">Description</label>
                                                                    <input id="tithes_offer_other_gifts_desciption" type="text" class="form-control" 
                                                                        name="tithes_offer_other_gifts_desciption">
                                                                </div>
                                                            </div>

                                                            
                                                            <br>
                                                            <div class="row">
                                                                <label for="total_amount" style="font-size: 12px">Total Amount</label>
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <p id="total" value="myvalue"></p>
                                                                </span>
                                                                
                                                            </div>

                                                            <script>

                                                            function summation() {
                                                                var x = document.getElementById('tithes_offer_tithe_amount').value;
                                                                var y = document.getElementById('tithes_offer_offering_plan_amount').value;
                                                                var z = document.getElementById('tithes_offer_other_gifts_amount').value;

                                                                var total = (x*1) + (y*1) + (z*1);
                                                                var total_amount = total.toLocaleString("en-US");
                                                                /*x.addEventListener('input', function(){*/
                                                                    document.getElementById("total").innerHTML = total_amount;
                                                                /*});*/

                                                            }
                                                            </script>
                                                            
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                                <button class="btn btn-primary float-left btn-save-tithes">
                                                                    Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- END MODAL -->

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
                                                        $('#type-field-4').show();
                                                        $('#type-field-5').show();
                                                        $('#type-field-6').show();
                                                    }
                                                    else if (selectedItem === 'GCash')
                                                    {
                                                        $('#type-field-1').show();
                                                        $('#type-field-2').show();
                                                        $('#type-field-3').show();
                                                        $('#type-field-4').show();
                                                        $('#type-field-5').show();
                                                        $('#type-field-5').show();
                                                    }
                                                    
                                                    else if (selectedItem === 'Bank') 
                                                    {
                                                        $('#type-field-1').show();
                                                        $('#type-field-2').show();
                                                        $('#type-field-3').show();
                                                        $('#type-field-4').show();
                                                        $('#type-field-5').show();
                                                        $('#type-field-6').show();

                                                    }

                                                });
                                            });

                                        </script>

                                        
                                                            











                            
                                <!--<form id="reload">
                                    <div class="container p-0">

                                        <div class="row mb-2" id="tithes_amount_member_profile">
                                            <label for="tithes_offer_tithe_amount" class="col-md-3">Tithes Amount</label>

                                            <div class="col-md-8">
                                                <input id="tithes_offer_tithe_amount" type="number" class="form-control" name="tithes_offer_tithe_amount" placeholder="Amount" min="1" max="10000">
                                            </div>

                                        </div>

                                        <div class="row mb-2" id="offering_plan_amount_member_profile">
                                            <label for="tithes_offer_offering_plan_amount" class="col-md-3">Offering Plan Amount</label>

                                            <div class="col-md-8">
                                                <input id="tithes_offer_offering_plan_amount" type="number" class="form-control" name="tithes_offer_offering_plan_amount" placeholder="Amount" min="1" max="10000">
                                            </div>
                                        </div>

                                        <div class="row mb-2" id="offering_gifts_amount_member_profile">
                                            <label for="tithes_offer_other_gifts_amount" class="col-md-3">Other Gifts Amount</label>
                                            <div class="col-md-8">
                                                <input id="tithes_offer_other_gifts_amount" type="number" class="form-control" name="tithes_offer_other_gifts_amount" placeholder="Amount" min="1" max="10000">
                                            </div>
                                        </div>

                                        <div class="row mb-2" id="descripton_member_profile">
                                            <label for="tithes_offer_other_gifts_desciption" class="col-md-3">Description</label>
                                            <div class="col-md-8">
                                                <input id="tithes_offer_other_gifts_desciption" type="text" class="form-control" name="tithes_offer_other_gifts_desciption">
                                            </div>
                                        </div>

                                        <div class="row mb-2" id="type">
                                            <label for="tithes_offer_type" class="col-md-3">Type</label>
                                            <div class="col-md-8">
                                                <select type="text" class="form-select tithes_offer_type" style="cursor: pointer" name="tithes_offer_type" id="tithes_offer_type" required>
                                                    <option disabled selected value>- Select Type -</option>
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

                                        <div class="row mb-2" id="add_date_member_profile">
                                            <label for="tithes_offer_date" class="col-md-3">Date</label>
                                            <div class="col-md-8">
                                                <input id="tithes_offer_date" type="date" class="form-control" name="tithes_offer_date" required>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-md-11">
                                                <button id="submit_button_member_profile" class="btn btn-success btn-save-tithes" style="float: right">Submit</button>
                                            </div>
                                        </div>
                                    </div>-->

                                    

                                    <!--<div class="modal fade" id="bank" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title text-white" id="staticBackdropLabel">
                                                        Bank Details
                                                    </h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="container">

                                                        @if ($get_bank->count() > 0)
                                                            @foreach ($get_bank as $bank)
                                                                <div class="row mt-3 pb-3" style="border-bottom: 1px dotted lightgray">
                                                                    <div class="col-md-12">
                                                                        <label style="font-size: 14px">Bank Name:</label>
                                                                        <p style="background-color: #e3e3e3; border: 1px solid gray; border-radius: 6px; font-size: 14px; padding: 5px">
                                                                            {{ $bank->on_bank_name }}
                                                                        </p>

                                                                        <label style="font-size: 14px">Account Name:</label>
                                                                        <p style="background-color: #e3e3e3; border: 1px solid gray; border-radius: 6px; font-size: 14px; padding: 5px">
                                                                            {{ $bank->on_account_name }}
                                                                        </p>

                                                                        <label style="font-size: 14px">Account Number:</label>
                                                                        <p style="background-color: #e3e3e3; border: 1px solid gray; border-radius: 6px; font-size: 14px; padding: 5px">
                                                                            {{ $bank->on_bank_account_number }}
                                                                        </p>

                                                                        <label style="font-size: 14px">Contact Number:</label>
                                                                        <p style="background-color: #e3e3e3; border: 1px solid gray; border-radius: 6px; font-size: 14px; padding: 5px">
                                                                            {{ $bank->on_contact_number }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <center>
                                                                <div class="text-gray p-6 m-3"> 
                                                                    <h4 class="opacity-2">
                                                                        Nothing to show
                                                                    </h4>
                                                                </div>
                                                            </center>
                                                        @endif
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>-->
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="row" style="justify-content: center">
            <div class="col-md-12">
                <div class="row" style="justify-content: center">
                    <div class="col-md-12">

                        <div class="card mb-3">
                            <div class="card-header">
                                <h5>
                                    MY TITHES AND OFFERINGS CONTRIBUTION
                                </h5>
                            </div>
                            <div class="card-body" style="padding-bottom: 0">
                                <form action="/home" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-4" id="datefrom_member_profile">
                                                <label for="from1" class="col-form-label text-xs">From</label>
                                                <input type="date" class="form-control input-sm" id="from1" name="from1"  value="<?php if(isset($_POST['from1'])) { echo $_POST['from1']; } ?>" required>
                                            </div>
                                            <div class="col-md-4" id="dateto_member_profile">
                                                <label for="to1" class="col-form-label text-xs">To</label>
                                                <input type="date" class="form-control input-sm" id="to1" name="to1" value="<?php if(isset($_POST['to1'])) { echo $_POST['to1']; } ?>" required>
                                            </div>
                                            <div class="col-md-4 justify-content-end">
                                                <button id="search_button_member_profile" type="submit" class="btn btn-success btn-sm" name="mem_search" style="float: right; margin-top: 2rem">
                                                    <i class="las la-search" style="font-size: 20px"></i> SEARCH
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="row mx-4 mt-5">
                                <div class="col-md-6">
                                    <h6 class="text-gray  text-sm">
                                        <span>
                                            <h6 class="text-sm">
                                                Total No. of records {{ $history->count() }}
                                            </h6>
                                        </span>
                                    </h6>
                                </div>

                                <div class="col-md-6" id="search_bar_member_profile">
                                    <div class="form-group">
                                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                                    </div>
                                </div>
                            </div>

                            <div id="reload">
                                <div class="keep-scrolling">
                                    @if ($history->count() > 0)
                                        @foreach ($history as $tithes)
                                            <div class="list-group mx-4">
                                                <div class=" list-group-item-custom cursor-pointer list-group-item">
                                                    <div class="media">
                                                        <div class="media-body " id="list_of_record_member_profile">
                                                            <div class="row my-2">

                                                                <div class="col-md-2">
                                                                    <p class="mb-1 text-xs text-color-gray-lighter gotham-book">
                                                                        No
                                                                    </p>
                                                                    <h6 class="text-gray  text-sm">
                                                                        <span>
                                                                            <h6 class="text-sm">
                                                                                {{ $loop->iteration }}
                                                                            </h6>
                                                                        </span>
                                                                    </h6>
                                                                </div>
                                                                <div class="col-sm-2 text-truncate">
                                                                    <p class="mb-1 text-xs text-color-gray-lighter gotham-book text-truncate">
                                                                        Tithe Amount
                                                                    </p>
                                                                    <h6 class="text-gray  text-sm">
                                                                        <span> 
                                                                            ₱ {{ number_format($tithes->tithes_offer_tithe_amount, 2) }}
                                                                        </span>
                                                                    </h6>
                                                                </div>

                                                                <div class="col-sm-2 text-truncate">
                                                                    <p class="mb-1  mr-3 text-xs text-color-gray-lighter gotham-book text-truncate"> 
                                                                        Offering Plan Amount
                                                                    </p>
                                                                    <h6 class="text-gray  text-sm">
                                                                        <span> 
                                                                            ₱ {{ number_format($tithes->tithes_offer_offering_plan_amount, 2) }}
                                                                        </span>
                                                                    </h6>
                                                                </div>

                                                                <div class="col-sm-2 text-truncate">
                                                                    <p class="mb-1  mr-3 text-xs text-color-gray-lighter gotham-book text-truncate"> 
                                                                        Other Gifts Amount
                                                                    </p>
                                                                    <h6 class="text-gray  text-sm">
                                                                        <span> 
                                                                            ₱ {{ number_format($tithes->tithes_offer_other_gifts_amount, 2) }}
                                                                        </span>
                                                                    </h6>
                                                                </div>

                                                                <div class="col-md-2 text-truncate">
                                                                    <p class="mb-1  mr-3 text-xs text-color-gray-lighter gotham-book text-truncate"> 
                                                                        Other Gifts Description
                                                                    </p>
                                                                    <h6 class="text-gray  text-sm">
                                                                        <span> 
                                                                            {{ $tithes->tithes_offer_other_gifts_desciption }}
                                                                        </span>
                                                                    </h6>
                                                                </div>

                                                                <div class="col-md-2 text-truncate">
                                                                    <p class="mb-1 mr-3 text-xs text-color-gray-lighter gotham-book text-truncate"> 
                                                                        Type
                                                                    </p>
                                                                    <h6 class="text-gray  text-sm">
                                                                        @if ($tithes->tithes_offer_type == 'Cash')
                                                                            <span class="badge badge-sm bg-gradient-warning">
                                                                                {{ $tithes->tithes_offer_type }}
                                                                            </span>

                                                                        @elseif ($tithes->tithes_offer_type == 'GCash')

                                                                            <span class="badge badge-sm bg-gradient-success">
                                                                                {{ $tithes->tithes_offer_type }}
                                                                            </span>

                                                                        @elseif ($tithes->tithes_offer_type == 'Bank')

                                                                            <span class="badge badge-sm bg-gradient-info">
                                                                                {{ $tithes->tithes_offer_type }}
                                                                            </span>

                                                                        @elseif($tithes->tithes_offer_type == '')
                                                                                <span class="badge badge-sm bg-gradient-secondary">
                                                                                None
                                                                            </span>
                                                                        @else

                                                                            <span class="badge badge-sm bg-gradient-primary">
                                                                                {{ $tithes->tithes_offer_type }}
                                                                            </span>

                                                                        @endif
                                                                    </h6>
                                                                </div>

                                                                <div class="col-md-1 text-truncate">
                                                                    <p class="mb-1  mr-3 text-xs text-color-gray-lighter gotham-book text-truncate"> 
                                                                        Date
                                                                    </p>
                                                                    <h6 class="text-gray  text-sm">
                                                                        <span> 
                                                                            {{ $tithes->tithes_offer_date }}
                                                                        </span>
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <tr>
                                            <div class="text-gray p-6 m-3"> 
                                                <h4 class="opacity-2">
                                                    There's no recent activities here.
                                                </h4>
                                            </div>
                                        </tr>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

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

            let ACCOUNT = $('#tithes_account_number').val(); 
            let ACCOUNT_NAME = $('#tithes_account_name').val();
            let REFERENCE = $('#tithes_reference_number').val();
            let RECIEPT = $('#tithes_reciept').val(); 
            let TITHE = $('#tithes_offer_tithe_amount').val(); 
            let OFFER = $('#tithes_offer_offering_plan_amount').val();
            let OTHERS = $('#tithes_offer_other_gifts_amount').val();
            let DESC = $('#tithes_offer_other_gifts_desciption').val();        
            let TYPE = $('#tithes_offer_type').val();
            let DATE = $('#tithes_offer_date').val();
            /*let TYPE_1= $('#type_1').val();
            let TYPE_2= $('#type-field-3').val();*/


            const form = $(this).parents('form');

            $(form).validate({
             
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/add_new_tithes',
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
                                toastr.success("You have successfully added new record request!");
                                // $("#user_table").load(window.location.href + " #user_table" );
                                 $("#reload").load(window.location.href + " #reload" );

                                setTimeout(function(){

                                    $("#main_form")[0].reset();
                                    $("#notifDiv").fadeOut();
                                    $("#pending").load(window.location.href + " #pending" );
                                    $("#Notifs_list").load(window.location.href + " #Notifs_list" );

                                    $('[id="tithes_account_number"]').val(); 
                                    $('[id="tithes_account_name"]').val();
                                    $('[id="tithes_reference_number"]').val();
                                    $('[id="tithes_reciept"]').val(); 
                                    $('[id="tithes_offer_tithe_amount"]').val('');
                                    $('[id="tithes_offer_offering_plan_amount"]').val('');
                                    $('[id="tithes_offer_other_gifts_amount"]').val('');
                                    $('[id="tithes_offer_other_gifts_desciption"]').val('');
                                    $('[id="tithes_offer_type"]').val('');
                                    $('[id="tithes_offer_date"]').val('');

                                    /*$('[id="type_1"]').val('');
                                    $('[id="type-field-3"]').val('');*/
  

                                  
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

                                    
                                    $('[id="tithes_account_number"]').val(); 
                                    $('[id="tithes_account_name"]').val();
                                    $('[id="tithes_reference_number"]').val();
                                    $('[id="tithes_reciept"]').val(); 
                                    $('[id="tithes_offer_tithe_amount"]').val('');
                                    $('[id="tithes_offer_offering_plan_amount"]').val('');
                                    $('[id="tithes_offer_other_gifts_amount"]').val('');
                                    $('[id="tithes_offer_other_gifts_desciption"]').val('');
                                    $('[id="tithes_offer_type"]').val('');
                                    $('[id="tithes_offer_date"]').val('');
                                    /*$('[id="type_1"]').val('');
                                    $('[id="type-field-3"]').val('');*/

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
                                toastr.error("Something went wrong... please try again!");

                                    $('[id="tithes_account_number"]').val(); 
                                    $('[id="tithes_account_name"]').val();
                                    $('[id="tithes_reference_number"]').val();
                                    $('[id="tithes_reciept"]').val(); 
                                    $('[id="tithes_offer_tithe_amount"]').val('');
                                    $('[id="tithes_offer_offering_plan_amount"]').val('');
                                    $('[id="tithes_offer_other_gifts_amount"]').val('');
                                    $('[id="tithes_offer_other_gifts_desciption"]').val('');
                                    $('[id="tithes_offer_type"]').val('');
                                    $('[id="tithes_offer_date"]').val('');
                                    /*$('[id="type_1"]').val('');
                                    $('[id="type-field-3"]').val('');*/

                        }
                    });
                }
            });
            
        });
    });
</script>
@endpush
