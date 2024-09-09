<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
@include('admin.layout.header')
@yield('styles')
<div id="layout-wrapper">

    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box horizontal-logo">
                        <a href="{{ route('admin.index') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ url('assets/images/LOGO-DEAH2-Photoroom.png') }} " alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ url('assets/images/LOGO-DEAH2-Photoroom.png') }} " alt="" height="17">
                            </span>
                        </a>

                        <a href="{{ route('admin.index') }}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ url('assets/images/LOGO-DEAH2-Photoroom.png') }} " alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ url('assets/images/LOGO-DEAH2-Photoroom.png') }} " alt="" height="17">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                        id="topnav-hamburger-icon">
                        <span class="hamburger-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>

                    <!-- App Search-->
                  
                </div>

                <div class="d-flex align-items-center">





                    <div class="ms-1 header-item d-none d-sm-flex">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                            data-toggle="fullscreen">
                            <i class='bx bx-fullscreen fs-22'></i>
                        </button>
                    </div>

                    <div class="ms-1 header-item d-none d-sm-flex">
                        <button type="button"
                            class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                            <i class='bx bx-moon fs-22'></i>
                        </button>
                    </div>



                    <div class="dropdown ms-sm-3 header-item topbar-user">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <img class="rounded-circle header-profile-user"
                                    src="{{ asset(auth()->user()->avatar) }} " alt="Header Avatar">
                                <span class="text-start ms-xl-2">
                                    <span
                                        class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ auth()->user()->name }}
                                    </span>
                                    <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Admin</span>
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <h6 class="dropdown-header">Welcome {{ auth()->user()->name }}</h6>

                            <a class="dropdown-item" href="{{ route('auth.logout') }}"><i
                                    class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle" data-key="t-logout">Logout</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- removeNotificationModal -->
    <!-- /.modal -->
    <!-- ========== App Menu ========== -->
    <div class="app-menu navbar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <!-- Dark Logo-->
            <a href="{{ route('admin.index') }}" class="logo logo-dark">
                <span class="logo-sm">
                    <img src=" {{ url('assets/images/LOGO-DEAH2-Photoroom.png') }} " alt="" height="80">
                </span>
                <span class="logo-lg">
                    <img src="{{ url('assets/images/LOGO-DEAH2-Photoroom.png') }} " alt="" height="80">
                </span>
            </a>
            <!-- Light Logo-->
            <a href="{{ route('admin.index') }}" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{ url('assets/images/LOGO-DEAH2-Photoroom.png') }} " alt="" height="80">
                </span>
                <span class="logo-lg">
                    <img src="{{ url('assets/images/LOGO-DEAH2-Photoroom.png') }} " alt="" height="80">
                </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>

        @include('admin.layout.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                @yield('content')
            </div>
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © DEAH.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by Themesbrand
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->



<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!--preloader-->
<div id="preloader">
    <div id="status">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>



@include('admin.layout.footer')
@yield('scripts')
