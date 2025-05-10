<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <!--<img src="{{ URL::asset('build/images/logo-dark-sm.png') }}" alt="" height="26">-->
                <span class="fs-3 w-100"><strong>SRY</strong> </span>
            </span>
            <span class="logo-lg">
                <!--<img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="80">-->
                <span class="fs-3 w-100"><strong>SRY</strong> </span>
            </span>
        </a>

        <a href="index" class="logo logo-light">
            <span class="logo-lg">
                <!--<img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="30">-->
                <span class="fs-3 w-100"><strong>SRY</strong></span>
            </span>
            <span class="logo-sm">
                <!--<img src="{{ URL::asset('build/images/logo-light-sm.png') }}" alt="" height="26">-->
                <span class="fs-3 w-100"><strong>SRY</strong></span>
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
        <i class="bx bx-menu align-middle"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Company Info</li>

                <li>
                    <a href="javascript: void(0);">
                        <i class="bx bx-home-alt icon nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Company</span>

                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('dashboard') }}" data-key="t-ecommerce">Company Info</a></li>
                    </ul>

                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-envelope icon nav-icon"></i>
                        <span class="menu-item" data-key="t-email">Leave</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/leave-requests/create" data-key="t-inbox">Leave Request</a></li>
                    </ul>
                </li>









            </ul>
        </div>


        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
