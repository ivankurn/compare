<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-boxed">

        @include('layouts.content.headermenu')
    
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
    
                <div class="container">
                <!-- BEGIN CONTAINER -->
                        <div class="page-container">
        
                        <!-- BEGIN SIDEBAR -->
@if(Session::get('lv') == 'Admin Sistem')
                        @include('layouts.content.sidebar.sidebar_adm')
@else
                        @include('layouts.content.sidebar.sidebar_cust')
@endif
                        <!-- END SIDEBAR -->
        
        
                        @yield('body')
                
                        </div>
                </div>
        </div>