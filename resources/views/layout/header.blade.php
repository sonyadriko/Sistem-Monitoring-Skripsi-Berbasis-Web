<nav class="navbar">
    <!-- Sidebar toggle button -->
    <a class="sidebar-toggler" href="#">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            <!-- Notification dropdown -->
            <li class="nav-item dropdown notifications">
                <a aria-expanded="false" aria-haspopup="true" class="notifications nav-link dropdown-toggle"
                    data-bs-toggle="dropdown" href="#" id="notificationDropdown" role="button">
                    <i data-feather="bell"></i>
                    <div class="indicator">
                        <div class="circle"></div>
                    </div>
                </a>
                <div aria-labelledby="notificationDropdown" class="dropdown-menu p-0">
                    <!-- Notification header -->
                    <div class="d-flex align-items-center justify-content-between border-bottom px-3 py-2">
                        <p>New Notifications</p>
                        <a class="text-muted" href="javascript:;">{{-- Clear all --}}</a>
                    </div>
                    <!-- Notification list -->
                    <div class="p-1">
                        <div class="nk-notification">
                        </div>
                    </div>
                    <!-- View all link -->
                    <div class="d-flex align-items-center justify-content-center border-top px-3 py-2">
                        <a href="javascript:;">View all</a>
                    </div>
                </div>
            </li>
            <!-- Profile dropdown -->
            <li class="nav-item dropdown">
                <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    href="{{ route('profile.index') }}" id="profileDropdown" role="button">
                    <!-- Profile image based on user role -->
                    @if (Auth::user()->role_id == 1)
                        <img alt="profile" class="wd-30 ht-30 rounded-circle" src="{{ asset('img/mhs_profile.svg') }}">
                    @elseif(Auth::user()->role_id == 2)
                        <img alt="profile" class="wd-30 ht-30 rounded-circle" src="{{ asset('img/man_profile.svg') }}">
                    @elseif(Auth::user()->role_id == 3)
                        <img alt="profile" class="wd-30 ht-30 rounded-circle"
                            src="{{ asset('img/women_profile.svg') }}">
                    @elseif(Auth::user()->role_id == 4)
                        <img alt="profile" class="wd-30 ht-30 rounded-circle"
                            src="{{ asset('img/women_profile.svg') }}">
                    @endif

                </a>
                <div aria-labelledby="profileDropdown" class="dropdown-menu p-0">
                    <!-- Profile details -->
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <!-- Large profile image based on user role -->
                            @if (Auth::user()->role_id == 1)
                                <img alt="profile" class="wd-80 ht-80 rounded-circle"
                                    src="{{ asset('img/mhs_profile.svg') }}">
                            @elseif(Auth::user()->role_id == 2)
                                <img alt="profile" class="wd-80 ht-80 rounded-circle"
                                    src="{{ asset('img/man_profile.svg') }}">
                            @elseif(Auth::user()->role_id == 3)
                                <img alt="profile" class="wd-80 ht-80 rounded-circle"
                                    src="{{ asset('img/women_profile.svg') }}">
                            @elseif(Auth::user()->role_id == 4)
                                <img alt="profile" class="wd-80 ht-80 rounded-circle"
                                    src="{{ asset('img/women_profile.svg') }}">
                            @endif
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">{{ Auth::user()->name }}</p>
                            <p class="tx-12 text-muted">
                                <!-- User role description -->
                                @if (Auth::user()->role_id == 1)
                                    Mahasiswa
                                @elseif(Auth::user()->role_id == 2)
                                    Dosen
                                @elseif(Auth::user()->role_id == 3)
                                    Koordiantor
                                @elseif(Auth::user()->role_id == 4)
                                    Ketua Jurusan
                                @endif
                            </p>
                        </div>
                    </div>
                    <!-- Profile actions -->
                    <ul class="list-unstyled p-1">
                        @if (Auth::user()->role_id == 1)
                            <a class="text-body ms-0" href="{{ route('profile.index') }}">
                                <li class="dropdown-item py-2">

                                    <i class="icon-md me-2" data-feather="user"></i>
                                    <span>Profile</span>
                                </li>
                            </a>
                        @endif
                        <a href="{{ route('auth-logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <li class="dropdown-item py-2">
                                <i class="icon-md me-2" data-feather="log-out"></i>
                                <span>Log Out</span>

                                <form action="{{ route('auth-logout') }}" id="logout-form" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </a>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
