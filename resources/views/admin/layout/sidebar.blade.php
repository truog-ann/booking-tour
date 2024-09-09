<div id="scrollbar">
    <div class="container-fluid">

        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span data-key="t-menu">Menu</span></li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('admin.index') }}" role="button" aria-expanded="false"
                    aria-controls="sidebarDashboards">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                </a>

            </li> <!-- end Dashboard Menu -->
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('stastics') }}" role="button" aria-expanded="false"
                    aria-controls="sidebarDashboards">
                    <i class="ri-bar-chart-2-fill"></i> <span data-key="t-dashboards">Thống kê</span>
                </a>

            </li> <!-- end Dashboard Menu -->
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarApps">
                    <i class="ri-apps-2-line"></i> <span data-key="t-apps">Tour</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarApps">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('types.index') }}" class="nav-link">
                                Quản lý danh mục Tour
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tours.index') }}" class="nav-link" data-key="t-chat"> Quản lý Tour </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('attributes.index') }}" class="nav-link" data-key="t-chat"> Quản lý thuộc tính
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarHotels" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarHotels">
                    <i class="ri-home-2-line"></i> <span data-key="t-apps">Khách sạn</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarHotels">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('hotels.index') }}" class="nav-link" role="button" aria-expanded="false"
                                aria-controls="sidebarCalendar" data-key="t-calender">
                                Khách sạn hợp tác
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('services.index') }}" class="nav-link" data-key="t-chat"> Quản lý dịch vụ </a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarPost" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarHotels">
                    <i class="ri-pages-line"></i> <span data-key="t-apps">Bài viết</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarPost">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('posts.index') }}" class="nav-link" role="button" aria-expanded="false"
                                aria-controls="sidebarCalendar" data-key="t-calender">
                                Danh sách bài viết
                            </a>
                            <a href="{{ route('posts.create') }}" class="nav-link" role="button" aria-expanded="false"
                                aria-controls="sidebarCalendar" data-key="t-calender">
                                Thêm bài viết
                            </a>
                        </li>






                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarBooking" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarHotels">
                    <i class="ri-list-ordered"></i> <span data-key="t-apps">Đơn hàng</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarBooking">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('bookings.index') }}" class="nav-link" role="button" aria-expanded="false"
                                aria-controls="sidebarCalendar" data-key="t-calender">
                                Danh sách đơn hàng
                            </a>
                       
                        </li>






                    </ul>
                </div>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('vouchers.index') }}" role="button" aria-expanded="false"
                    aria-controls="sidebarHotels">
                    <i class="ri-add-box-line"></i> <span data-key="t-apps">Vouchers</span>
                </a>

            </li> --}}

            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('users.index') }}" role="button" aria-expanded="false"
                    aria-controls="sidebarHotels">
                    <i class="ri-user-2-line"></i> <span data-key="t-apps">Tài khoản</span>
                </a>

            </li>
        </ul>
    </div>
    <!-- Sidebar -->
</div>

<div class="sidebar-background"></div>
</div>
