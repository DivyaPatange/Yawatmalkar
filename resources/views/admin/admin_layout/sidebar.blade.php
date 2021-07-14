<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            <a href="{{ url('/admin') }}" class="b-brand">
                <div class="b-bg">
                    <i class="feather icon-trending-up"></i>
                </div>
                <span class="b-title">Yawatmalkar</span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item active">
                    <a href="{{ url('/admin') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <li data-username="basic components Button Alert Badges breadcrumb Paggination progress Tooltip popovers Carousel Cards Collapse Tabs pills Modal Grid System Typography Extra Shadows Embeds" class="nav-item pcoded-hasmenu">
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Master Web</span></a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="{{ route('admin.pages.index') }}" class="">Pages</a></li>
                        <li class=""><a href="{{ route('admin.banner-image.index') }}" class="">Banner Image</a></li>
                        <li class=""><a href="{{ route('admin.testimonials.index') }}" class="">Testimonials</a></li>
                        <li class=""><a href="{{ route('admin.flashes-upcoming.index') }}" class="">Flashes & Upcomings</a></li>
                        <!-- <li class=""><a href="bc_tabs.html" class="">Tabs & pills</a></li>
                        <li class=""><a href="bc_typography.html" class="">Typography</a></li> -->


                        <!-- <li class=""><a href="icon-feather.html" class="">Feather<span class="pcoded-badge label label-danger">NEW</span></a></li> -->
                    </ul>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Category & Sub-Category</label>
                </li>
                <li data-username="form elements advance componant validation masking wizard picker select" class="nav-item">
                    <a href="{{ route('admin.category.index') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Category</span></a>
                </li>
                <li data-username="Table bootstrap datatable footable" class="nav-item">
                    <a href="{{ route('admin.sub-category.index') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-server"></i></span><span class="pcoded-mtext">Sub-Category</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Registration Form</label>
                </li>
                <li data-username="Charts Morris" class="nav-item"><a href="{{ route('admin.doctors.index') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-pie-chart"></i></span><span class="pcoded-mtext">Doctors Registration</span></a></li>
                <li data-username="Maps Google" class="nav-item"><a href="{{ route('admin.lawyers.index') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-map"></i></span><span class="pcoded-mtext">Lawyer Registration</span></a></li>
                <li data-username="Charts Morris" class="nav-item"><a href="{{ route('admin.beautician.index') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-pie-chart"></i></span><span class="pcoded-mtext">Beautician Registration</span></a></li>
                <li data-username="Charts Morris" class="nav-item"><a href="{{ route('admin.daily-needs.index') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-map"></i></span><span class="pcoded-mtext">Daily Needs Registration</span></a></li>

                <li class="nav-item pcoded-menu-caption">
                    <label>Schedule Data</label>
                </li>
                <li data-username="Authentication Sign up Sign in reset password Change password Personal information profile settings map form subscribe" class="nav-item pcoded-hasmenu">
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-lock"></i></span><span class="pcoded-mtext">Schedule</span></a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="{{ route('admin.doctor-schedule.index') }}" class="">Doctor Schedule</a></li>
                        <li class=""><a href="{{ route('admin.lawyer-schedule.index') }}" class="">Lawyer Schedule</a></li>
                        <li class=""><a href="{{ route('admin.beautician-schedule.index') }}" class="">Beautician Schedule</a></li>
                    </ul>
                </li>
                <li data-username="Sample Page" class="nav-item"><a href="sample-page.html" class="nav-link"><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Sample page</span></a></li>
                <li data-username="Disabled Menu" class="nav-item disabled"><a href="javascript:" class="nav-link"><span class="pcoded-micon"><i class="feather icon-power"></i></span><span class="pcoded-mtext">Disabled menu</span></a></li>
            </ul>
        </div>
    </div>
</nav>