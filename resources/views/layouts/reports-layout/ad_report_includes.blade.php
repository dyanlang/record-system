    <div class="col-md-5">
        <div class="greetings">
            <h4 class="text-white font-weight-bolder">
            <?php $link = "/tithes&offerings/reports" ?>
                @for($i = 1; $i <= count(Request::segments()); $i++)
                    @if($i < count(Request::segments()) & $i > 0)
                        <a   class="text-white " href="<?= $link ?>" > {{ ucwords(str_replace('&',' & ',Request::segment($i)))}}</a> /
                    @else {{ucwords(str_replace('-',' ',Request::segment($i)))}}
                    @endif
                @endfor
            </h4 >

            <p class="text-white  mb-0"> @php $dtae = date_default_timezone_set('Asia/Manila') @endphp {{  date('F j, Y g:i a') }} </p>
        </div>
    </div>
    


    <div class=" d-flex justify-content-end align-items-left col-md-7">
        <div class="main-navigator-wrapper">
            <div class="navigator nav">
                <div class="nav-item">
                    <a       href="{{ url('/tithes&offerings/reports') }}" class="text-truncate active nav-link">
                        All Records
                    </a>
                </div> 


                <div class="nav-item mx-2">
                        <a    href="{{ url('/tithes&offerings/summary') }}" class=" nav-link">
                            Summary   
                        </a>
                </div> 
             
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link pe-auto"  
                        id="dropdownMenuButton2" 
                        data-bs-toggle="dropdown">
                            Pending Requests
                    </a>
                        <ul class="dropdown-menu" 
                            aria-labelledby="dropdownMenuButton2">
                        @if (Auth::user()->user_type == '2')   

                            
                            <li>
                                <a class="dropdown-item" href="/tithes&offerings/pending">
                                    <span> Co-Admin's Pending </span> 
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/tithes&offerings/co-admin-request">  
                                    <span>   For Approval List </span> 
                                </a>
                            </li>
                            
                            @endif
                            @if (Auth::user()->user_type == '2' || Auth::user()->user_type == '1')
                            <li>
                                <a class="dropdown-item" href="/tithes&offerings/members-request">
                                    <span> Member's Requests </span> 
                                </a>
                            </li>
                             @if (Auth::user()->user_type == '1') 
                          
                             <li>
                                <a class="dropdown-item" href="/tithes&offerings/co-admin-approval">
                                    <span>  For Approval </span> 
                                </a>
                            </li>
                            
                            @endif
                        @endif
                        </ul>  
                </div>      
            </div>
        </div>
    </div>

    @if (Auth::user()->user_type == '2')  
    <div class=" text-end">
            <a  href="{{ url('/tithes&offerings/payment') }}" class="nav-link">
            Online Payment Credentials
            </a>
    </div>
    @endif