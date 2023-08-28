<div class="mb-1 row mt-4">
    <div class="col-md-5">
        <div class="greetings">
            <h4 class="text-white font-weight-bolder">
             <?php $link = "/tithes&offerings/reports" ?>
                @for($i = 1; $i <= count(Request::segments()); $i++)
                    @if($i < count(Request::segments()) & $i > 0)
                        <a   class="text-white " href="<?= $link ?>" > {{ ucwords(str_replace('-',' ',Request::segment($i)))}}</a> /
                    @else {{ucwords(str_replace('-',' ',Request::segment($i)))}}
                    @endif
                @endfor
            </h4 >
            </h3>
            <p class="text-white  mb-0"> @php $dtae = date_default_timezone_set('Asia/Manila') @endphp {{  date('F j, Y g:i a') }} </p>
        </div>
    </div>
    <div class="d-flex justify-content-end align-items-center col-md-7">
        <div class="main-navigator-wrapper mb-3">
            <div class="navigator nav">
                <div class="nav-item">
                    <a href="/sabbath-offerings/records" class="p-2 active nav-link">
                        All Records
                    </a>
                </div> 
                <div class="nav-item">
                        <a href="/sabbath-offerings/summary" class="p-2 nav-link">
                            Summary   
                        </a>
                </div> 
                
                <div class="nav-item dropdown">
                    <a href="#" class="p-2 nav-link pe-auto"  id="dropdownMenuButton2" data-bs-toggle="dropdown">
                            Pending List
                    </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                        @if (Auth::user()->user_type == '2')

                            
                            <li>
                                <a class="dropdown-item" href="/sabbath-offerings/pending">
                                    <span> Pending List</span> 
                                </a>
                            </li>
                        
                            @elseif (Auth::user()->user_type == '1')
                            <li>
                                <a class="dropdown-item"href="/sabbath_offering_for_approval">
                                    <span>For Approval </span> 
                                </a>
                            </li>
                            
                        @endif
                        </ul>  

                </div> 
                    
            </div>
        </div>

    