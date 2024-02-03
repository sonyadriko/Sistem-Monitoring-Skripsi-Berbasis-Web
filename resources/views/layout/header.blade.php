<nav class="navbar">
	<a class="sidebar-toggler" href="#">
		<i data-feather="menu"></i>
	</a>
	<div class="navbar-content">
		{{-- <form class="search-form">
      <div class="input-group">
        <div class="input-group-text">
          <i data-feather="search"></i>
        </div>
        <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
      </div>
    </form> --}}
		<ul class="navbar-nav">
			{{-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i data-feather="mail"></i>
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="messageDropdown">
          <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
            <p>9 New Messages</p>
            <a href="javascript:;" class="text-muted">Clear all</a>
          </div>
          <div class="p-1">
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="me-3">
                <img class="wd-30 ht-30 rounded-circle" src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">
              </div>
              <div class="d-flex justify-content-between flex-grow-1">
                <div class="me-4">
                  <p>Leonardo Payne</p>
                  <p class="tx-12 text-muted">Project status</p>
                </div>
                <p class="tx-12 text-muted">2 min ago</p>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="me-3">
                <img class="wd-30 ht-30 rounded-circle" src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">
              </div>
              <div class="d-flex justify-content-between flex-grow-1">
                <div class="me-4">
                  <p>Carl Henson</p>
                  <p class="tx-12 text-muted">Client meeting</p>
                </div>
                <p class="tx-12 text-muted">30 min ago</p>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="me-3">
                <img class="wd-30 ht-30 rounded-circle" src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">
              </div>
              <div class="d-flex justify-content-between flex-grow-1">
                <div class="me-4">
                  <p>Jensen Combs</p>
                  <p class="tx-12 text-muted">Project updates</p>
                </div>
                <p class="tx-12 text-muted">1 hrs ago</p>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="me-3">
                <img class="wd-30 ht-30 rounded-circle" src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">
              </div>
              <div class="d-flex justify-content-between flex-grow-1">
                <div class="me-4">
                  <p>Amiah Burton</p>
                  <p class="tx-12 text-muted">Project deatline</p>
                </div>
                <p class="tx-12 text-muted">2 hrs ago</p>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="me-3">
                <img class="wd-30 ht-30 rounded-circle" src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">
              </div>
              <div class="d-flex justify-content-between flex-grow-1">
                <div class="me-4">
                  <p>Yaretzi Mayo</p>
                  <p class="tx-12 text-muted">New record</p>
                </div>
                <p class="tx-12 text-muted">5 hrs ago</p>
              </div>
            </a>
          </div>
          <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
            <a href="javascript:;">View all</a>
          </div>
        </div>
      </li> --}}
			<li class="nav-item dropdown notifications">
				<a aria-expanded="false" aria-haspopup="true" class="notifications nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" id="notificationDropdown" role="button">
					<i data-feather="bell"></i>
					<div class="indicator">
						<div class="circle"></div>
					</div>
				</a>
				<div aria-labelledby="notificationDropdown" class="dropdown-menu p-0">
					<div class="d-flex align-items-center justify-content-between border-bottom px-3 py-2">
						<p>New Notifications</p>
						<a class="text-muted" href="javascript:;">{{-- Clear all --}}</a>
					</div>
					<div class="p-1">
						<div class="nk-notification">
						</div>
					</div>
					<div class="d-flex align-items-center justify-content-center border-top px-3 py-2">
						<a href="javascript:;">View all</a>
					</div>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="{{ route('profile.index') }}" id="profileDropdown" role="button">
					@if (Auth::user()->role_id == 1)
                    <img alt="profile" class="wd-30 ht-30 rounded-circle" src="{{ asset('img/mhs_profile.svg') }}">
                    @elseif(Auth::user()->role_id == 2)
                    <img alt="profile" class="wd-30 ht-30 rounded-circle" src="{{ asset('img/man_profile.svg') }}">
                    @elseif(Auth::user()->role_id == 3)
                    <img alt="profile" class="wd-30 ht-30 rounded-circle" src="{{ asset('img/women_profile.svg') }}">
                    @elseif(Auth::user()->role_id == 4)
                    <img alt="profile" class="wd-30 ht-30 rounded-circle" src="{{ asset('img/women_profile.svg') }}">
                    @endif

				</a>
				<div aria-labelledby="profileDropdown" class="dropdown-menu p-0">
					<div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
						<div class="mb-3">
							@if (Auth::user()->role_id == 1)
                    <img alt="profile" class="wd-80 ht-80 rounded-circle" src="{{ asset('img/mhs_profile.svg') }}">
                    @elseif(Auth::user()->role_id == 2)
                    <img alt="profile" class="wd-80 ht-80 rounded-circle" src="{{ asset('img/man_profile.svg') }}">
                    @elseif(Auth::user()->role_id == 3)
                    <img alt="profile" class="wd-80 ht-80 rounded-circle" src="{{ asset('img/women_profile.svg') }}">
                    @elseif(Auth::user()->role_id == 4)
                    <img alt="profile" class="wd-80 ht-80 rounded-circle" src="{{ asset('img/women_profile.svg') }}">
                    @endif
						</div>
						<div class="text-center">
							<p class="tx-16 fw-bolder">{{ Auth::user()->name }}</p>
							<p class="tx-12 text-muted">
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
					<ul class="list-unstyled p-1">
                        @if(Auth::user()->role_id == 1)
						<li class="dropdown-item py-2">
							<a class="text-body ms-0" href="{{ route('profile.index') }}">
								<i class="icon-md me-2" data-feather="user"></i>
								<span>Profile</span>
							</a>
						</li>
                        @endif
						{{-- <li class="dropdown-item py-2">
              <a href="javascript:;" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="edit"></i>
                <span>Edit Profile</span>
              </a>
            </li>
            <li class="dropdown-item py-2">
              <a href="javascript:;" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="repeat"></i>
                <span>Switch User</span>
              </a>
            </li> --}}
						{{-- <li class="dropdown-item py-2">
              <a href="{{ route('logout') }}" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="log-out"></i>
                <span>Log Out</span>
              </a>
            </li> --}}
						<li class="dropdown-item py-2">
							<a href="{{ route('auth-logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								<i class="icon-md me-2" data-feather="log-out"></i>
								<span>Log Out</span>
							</a>

							<form action="{{ route('auth-logout') }}" id="logout-form" method="POST" style="display: none;">
								@csrf
							</form>
						</li>

					</ul>
				</div>
			</li>
		</ul>
	</div>
</nav>
