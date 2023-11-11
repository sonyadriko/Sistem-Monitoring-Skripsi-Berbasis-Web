<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{ auth()->user()->role_id === 2 ? url('/dosen') : (auth()->user()->role_id === 3 ? url('/koordinator') : url('/dashboard')) }}" class="app-brand-link">
        <span class="app-brand-text demo menu-text fw-bolder">Sistem Informasi</span>
      </a>
      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      @if(Request::is('dashboard*'))
      <li class="menu-item active">
        <a href="{{url('/dashboard')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>
      @endif
      @if(Auth::user()->role_id == 1)
      @unless(Request::is('dashboard*'))
      <!-- Layouts -->
      <li class="menu-item">
        <a href="{{route('profile.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Profile</div>
        </a>
      </li>
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Pengajuan & Surat</span>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Pengajuan & Surat</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{ route('pengajuan-judul.create')}}" class="menu-link">
              <div data-i18n="Account">Pengajuan Judul Skripsi</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('seminar-proposal.create')}}" class="menu-link">
              <div data-i18n="Notifications">Pendaftaran Seminar Proposal</div>
            </a>
          </li>
          {{-- <li class="menu-item">
            <a href="pages-account-settings-connections.html" class="menu-link">
              <div data-i18n="Connections">Surat Survey ke Perusahaan</div>
            </a>
          </li> --}}
          <li class="menu-item">
            <a href="{{ route('pengajuan-st.index') }}" class="menu-link">
              <div data-i18n="Connections">Surat Tugas Bimbingan</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Bimbingan Proposal</span>
      </li>
      <li class="menu-item">
        <a href="{{route('bimbingan-mhs.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
          <div data-i18n="Authentications">Progress Bimbingan</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('bimbingans-mhs.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
          <div data-i18n="Authentications">Bimbingan Skripsi</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('revisi_sp.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
          <div data-i18n="Authentications">Revisi Seminar Proposal</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('revisi_sk.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
          <div data-i18n="Authentications">Revisi Sidang Skripsi</div>
        </a>
      </li>

      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link">
          <i class="menu-icon tf-icons bx bx-cube-alt"></i>
          <div data-i18n="Misc">Lain-lain</div>
        </a>
      </li>
      @endif
      @endif

      @if(Auth::user()->role_id == 3)
      <li class="menu-item">
        <a href="{{route('dashboard:koordinator')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Dashboard</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Pengajuan & Surat</span>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Proposal & Skripsi</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{ route('pengajuan-judul.index')}}" class="menu-link">
              <div data-i18n="Account">Pengajuan Judul</div>
            </a>
          </li>
          {{-- <li class="menu-item">
            <a href="{{ route('pembagian-dosen.create')}}" class="menu-link">
              <div data-i18n="Account">Pembagian Dosen</div>
            </a>
          </li> --}}

          {{-- <li class="menu-item">
            <a href="pages-account-settings-connections.html" class="menu-link">
              <div data-i18n="Connections">Surat Survey ke Perusahaan</div>
            </a>
          </li> --}}
          <li class="menu-item">
            <a href="{{ route('jadwal-seminar-proposal.index') }}" class="menu-link">
              <div data-i18n="Connections">Pendaftaran Seminar Proposal</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('koor-berita-acara-proposal.index') }}" class="menu-link">
              <div data-i18n="Connections">Berita Acara Proposal</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('koor-berita-acara-skripsi.index') }}" class="menu-link">
              <div data-i18n="Connections">Berita Acara Skripsi</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('koor-surat-tugas.index')}}" class="menu-link">
              <div data-i18n="Notifications">Surat Tugas Bimbingan</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('jadwal-sidang-skripsi.index')}}" class="menu-link">
              <div data-i18n="Notifications">Pendaftaran Sidang Skripsi</div>
            </a>
          </li>

        </ul>
      </li>
      @endif

      @if(Auth::user()->role_id == 2)
      <li class="menu-item">
        <a href="{{route('dashboard:dosen')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Dashboard</div>
        </a>
      </li>
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Bidang Ilmu</span>
      </li>
      <li class="menu-item">
        <a href="{{route('bidang-ilmu.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Bidang Ilmu</div>
        </a>
      </li>
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Bimbingan</span>
      </li>
      <li class="menu-item">
        <a href="{{route('bimbingan-dosen.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Mahasiswa Bimbingan</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Pengajuan</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('berita-acara-proposal.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Berita Acara Proposal</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('berita-acara-skripsi.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Berita Acara Skripsi</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('dosen-revisi-sempro.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Revisi Seminar Proposal</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('dosen-revisi-semhas.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Revisi Sidang Skripsi</div>
        </a>
      </li>
      @endif


      <!-- Components -->
      {{-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Components</span></li> --}}
      <!-- Cards -->
      {{-- <li class="menu-item">
        <a href="cards-basic.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-collection"></i>
          <div data-i18n="Basic">Cards</div>
        </a>
      </li>
      <!-- User interface -->
      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-box"></i>
          <div data-i18n="User interface">User interface</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="ui-accordion.html" class="menu-link">
              <div data-i18n="Accordion">Accordion</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-alerts.html" class="menu-link">
              <div data-i18n="Alerts">Alerts</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-badges.html" class="menu-link">
              <div data-i18n="Badges">Badges</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-buttons.html" class="menu-link">
              <div data-i18n="Buttons">Buttons</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-carousel.html" class="menu-link">
              <div data-i18n="Carousel">Carousel</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-collapse.html" class="menu-link">
              <div data-i18n="Collapse">Collapse</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-dropdowns.html" class="menu-link">
              <div data-i18n="Dropdowns">Dropdowns</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-footer.html" class="menu-link">
              <div data-i18n="Footer">Footer</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-list-groups.html" class="menu-link">
              <div data-i18n="List Groups">List groups</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-modals.html" class="menu-link">
              <div data-i18n="Modals">Modals</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-navbar.html" class="menu-link">
              <div data-i18n="Navbar">Navbar</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-offcanvas.html" class="menu-link">
              <div data-i18n="Offcanvas">Offcanvas</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-pagination-breadcrumbs.html" class="menu-link">
              <div data-i18n="Pagination &amp; Breadcrumbs">Pagination &amp; Breadcrumbs</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-progress.html" class="menu-link">
              <div data-i18n="Progress">Progress</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-spinners.html" class="menu-link">
              <div data-i18n="Spinners">Spinners</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-tabs-pills.html" class="menu-link">
              <div data-i18n="Tabs &amp; Pills">Tabs &amp; Pills</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-toasts.html" class="menu-link">
              <div data-i18n="Toasts">Toasts</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-tooltips-popovers.html" class="menu-link">
              <div data-i18n="Tooltips & Popovers">Tooltips &amp; popovers</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="ui-typography.html" class="menu-link">
              <div data-i18n="Typography">Typography</div>
            </a>
          </li>
        </ul>
      </li>

      <!-- Extended components -->
      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-copy"></i>
          <div data-i18n="Extended UI">Extended UI</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="extended-ui-perfect-scrollbar.html" class="menu-link">
              <div data-i18n="Perfect Scrollbar">Perfect scrollbar</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="extended-ui-text-divider.html" class="menu-link">
              <div data-i18n="Text Divider">Text Divider</div>
            </a>
          </li>
        </ul>
      </li>

      <li class="menu-item">
        <a href="icons-boxicons.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-crown"></i>
          <div data-i18n="Boxicons">Boxicons</div>
        </a>
      </li>

      <!-- Forms & Tables -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Forms &amp; Tables</span></li>
      <!-- Forms -->
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Form Elements">Form Elements</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="forms-basic-inputs.html" class="menu-link">
              <div data-i18n="Basic Inputs">Basic Inputs</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="forms-input-groups.html" class="menu-link">
              <div data-i18n="Input groups">Input groups</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Form Layouts">Form Layouts</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="form-layouts-vertical.html" class="menu-link">
              <div data-i18n="Vertical Form">Vertical Form</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="form-layouts-horizontal.html" class="menu-link">
              <div data-i18n="Horizontal Form">Horizontal Form</div>
            </a>
          </li>
        </ul>
      </li>
      <!-- Tables -->
      <li class="menu-item">
        <a href="tables-basic.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-table"></i>
          <div data-i18n="Tables">Tables</div>
        </a>
      </li>
      <!-- Misc -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
      <li class="menu-item">
        <a
          href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
          target="_blank"
          class="menu-link"
        >
          <i class="menu-icon tf-icons bx bx-support"></i>
          <div data-i18n="Support">Support</div>
        </a>
      </li>
      <li class="menu-item">
        <a
          href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
          target="_blank"
          class="menu-link"
        >
          <i class="menu-icon tf-icons bx bx-file"></i>
          <div data-i18n="Documentation">Documentation</div>
        </a>
      </li> --}}
    </ul>
  </aside>
