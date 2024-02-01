<nav class="sidebar">
  <div class="sidebar-header">
    @php
    $dashboardUrl = '';
    switch (auth()->user()->role_id) {
        case 2:
            $dashboardUrl = url('/dosen');
            break;
        case 3:
            $dashboardUrl = url('/koordinator');
            break;
        case 4:
            $dashboardUrl = url('/ketua_jurusan');
            break;
        default:
            $dashboardUrl = url('/dashboard');
    }
@endphp
<a href="{{ $dashboardUrl }}" class="sidebar-brand">
    {{-- <a href="{{ auth()->user()->role_id === 2 ? url('/dosen') : (auth()->user()->role_id === 3 ? url('/koordinator') : url('/dashboard')) }}" class="sidebar-brand"> --}}
      SM<span> SKRIPSI</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
        @if(Auth::user()->role_id == 1)

        {{-- <li class="nav-item nav-category">Main</li> --}}
        <li class="nav-item">
            @php
                $dashboardUrl = '';
                switch (auth()->user()->role_id) {
                    case 2:
                        $dashboardUrl = url('/dosen');
                        break;
                    case 3:
                        $dashboardUrl = url('/koordinator');
                        break;
                    case 4:
                        $dashboardUrl = url('/ketua_jurusan');
                        break;
                    default:
                        $dashboardUrl = url('/dashboard');
                }
            @endphp
            <a href="{{ $dashboardUrl }}" class="nav-link">
                {{-- <a href="{{ auth()->user()->role_id === 2 ? url('/dosen') : auth()->user()->role_id === 3 ? url('/koordinator') : auth()->user()->role_id === 4 ? url('/ketua_jurusan') : url('/dashboard')) }}" class="nav-link"> --}}
                <i class="link-icon" data-feather="box"></i>
                <span class="link-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Pengajuan & Surat</li>
        <li class="nav-item ">
            <a class="nav-link" data-bs-toggle="collapse" href="#email" role="button"  aria-controls="email">
                <i class="link-icon" data-feather="inbox"></i>
                <span class="link-title">Forms</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="email">
                <ul class="nav sub-menu">
                    <li class="nav-item">
                    <a href="{{ route('pengajuan-judul.form') }}" class="nav-link">Pengajuan Judul</a>
                    {{-- <a href="{{ route('pengajuan-judul.create') }}" class="nav-link">Pengajuan Judul</a> --}}

                    </li>
                    <li class="nav-item">
                    <a href="{{ route('seminar-proposal.check')}}" class="nav-link">Sidang Proposal</a>
                    </li>
                    <li class="nav-item">
                    <a href="{{ route('pengajuan-st.check') }}" class="nav-link">Surat Tugas Bimbingan</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sidang-skripsi.check')}}" class="nav-link">Sidang Skripsi</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('yudisium.check')}}" class="nav-link">Yudisium</a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a href="{{ route('surat-survey.index')}}" class="nav-link">Surat Survey Perusahaan</a>
                    </li> --}}
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">Bimbingan & Revisi</li>
        <li class="nav-item ">
            <a class="nav-link" data-bs-toggle="collapse" href="#bimbingan" role="button"  aria-controls="bimbingan">
                <i class="link-icon" data-feather="book"></i>
                <span class="link-title">Bimbingan</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="bimbingan">
                <ul class="nav sub-menu">
                    <li class="nav-item">
                        <a href="{{ route('bimbingan-mhs.index') }}" class="nav-link">Bimbingan Proposal</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('bimbingans-mhs.index')}}" class="nav-link">Bimbingan Skripsi</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item ">
            <a class="nav-link" data-bs-toggle="collapse" href="#revisi" role="button"  aria-controls="revisi">
                <i class="link-icon" data-feather="inbox"></i>
                <span class="link-title">Revisi</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="revisi">
                <ul class="nav sub-menu">
                    <li class="nav-item">
                        <a href="{{ route('revisi_sp.index') }}" class="nav-link">Sidang Proposal Skripsi</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('revisi_sk.index')}}" class="nav-link">Sidang Laporan Skripsi</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">Lain - lain</li>
        <li class="nav-item ">
            <a class="nav-link" data-bs-toggle="collapse" href="#lainlain" role="button"  aria-controls="lainlain">
                <i class="link-icon" data-feather="mail"></i>
                <span class="link-title">Lain - lain</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="lainlain">
                <ul class="nav sub-menu">
                    {{-- <li class="nav-item">
                        <a href="{{ route('pengajuan-judul.index')}}" class="nav-link">Surat Survey Perusahaan</a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ route('faq')}}" class="nav-link">FAQ</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    @elseif(Auth::user()->role_id == 3)
    <li class="nav-item">
        <a href="{{ auth()->user()->role_id === 2 ? url('/dosen') : (auth()->user()->role_id === 3 ? url('/koordinator') : url('/dashboard')) }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item nav-category">Pengajuan & Surat</li>
        <li class="nav-item ">
            <a class="nav-link" data-bs-toggle="collapse" href="#email" role="button"  aria-controls="email">
                <i class="link-icon" data-feather="book-open"></i>
                <span class="link-title">Proposal & Skripsi</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
        <div class="collapse" id="email">
            <ul class="nav sub-menu">
                <li class="nav-item">
                    <a href="{{ route('pengajuan-judul.index')}}" class="nav-link">Pengajuan Judul</a>

                </li>
                <li class="nav-item">
                    <a href="{{ route('koor-surat-tugas.index')}}" class="nav-link">Surat Tugas</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('bidang-ilmu.index')}}" class="nav-link">Tema Penelitian</a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('koor-yudisium.index')}}" class="nav-link">Yudisium</a>
                </li> --}}

            </ul>
        </div>
    </li>

    <li class="nav-item nav-category">Jadwal & Berita Acara</li>
    <li class="nav-item">
        <a href="{{ route('penjadwalan-koordinator.index') }}" class="nav-link">
            <i class="link-icon" data-feather="calendar"></i>
            <span class="link-title">Penjadwalan</span>
        </a>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#penjadwalan" role="button" aria-controls="general">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Penjadwalan</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="penjadwalan">
            <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('pengajuan-judul.index')}}" class="nav-link">Pengajuan Judul</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('koor-surat-tugas.index')}}" class="nav-link">Surat Tugas</a>
                </li>
              </ul>
        </div>
      </li> --}}

      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#ba" role="button"  aria-controls="email">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Berita Acara</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="ba">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('koor-berita-acara-proposal.index') }}" class="nav-link">BA Sidang Proposal</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('koor-berita-acara-skripsi.index') }}" class="nav-link">BA Sidang Skripsi</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item nav-category">Manajemen</li>
      <li class="nav-item">
        <a href="{{route('data-pengguna.index')}}" class="nav-link">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">Data Pengguna</span>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a href="{{route('lap-tahunan.index')}}" class="nav-link">
          <i class="link-icon" data-feather="clipboard"></i>
          <span class="link-title">Laporan Tahunan</span>
        </a>
      </li> --}}
      <li class="nav-item">
        <a href="{{route('ruangan.index')}}" class="nav-link">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Ruangan</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('mata-kuliah.index')}}" class="nav-link">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Mata Kuliah Pendukung</span>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a href="{{route('ruangan.index')}}" class="nav-link">
          <i class="link-icon" data-feather="smile"></i>
          <span class="link-title">Info Penting</span>
        </a>
      </li> --}}
     @elseif(Auth::user()->role_id == 2)
     <li class="nav-item">
        <a href="{{ auth()->user()->role_id === 2 ? url('/dosen') : (auth()->user()->role_id === 3 ? url('/koordinator') : url('/dashboard')) }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item nav-category">Bidang Ilmu</li>
    <li class="nav-item">
        <a href="{{route('dosen-bidang-ilmu.index')}}" class="nav-link">
          <i class="link-icon" data-feather="sidebar"></i>
          <span class="link-title">Tema Penelitian</span>
        </a>
    </li>
    <li class="nav-item nav-category">Bimbingan & Revisi</li>
    <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#bs" role="button"  aria-controls="email">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Mahasiswa Bimbingan</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="bs">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('bimbingan-dosen.index') }}" class="nav-link">Proposal Skripsi</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('bimbingans-dosen.index')}}" class="nav-link">Laporan Skripsi</a>
            </li>
          </ul>
        </div>
    </li>
    <li class="nav-item">
        <a href="{{route('jadwal-menguji.index')}}" class="nav-link">
          <i class="link-icon" data-feather="sidebar"></i>
          <span class="link-title">Daftar Jadwal</span>
        </a>
    </li>
    <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#rev" role="button"  aria-controls="email">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Revisi</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="rev">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('dosen-revisi-sempro.index') }}" class="nav-link">Sidang Proposal Skripsi</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('dosen-revisi-semhas.index')}}" class="nav-link">Sidang Laporan Skripsi</a>
            </li>
          </ul>
        </div>
    </li>

    <li class="nav-item nav-category">Berita Acara</li>
    <li class="nav-item">
        <a href="{{route('berita-acara-proposal.index')}}" class="nav-link">
          <i class="link-icon" data-feather="book-open"></i>
          <span class="link-title">Sidang Proposal</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('berita-acara-skripsi.index')}}" class="nav-link">
          <i class="link-icon" data-feather="file-text"></i>
          <span class="link-title">Sidang Skripsi</span>
        </a>
    </li>
    @elseif(Auth::user()->role_id == 4)
    <li class="nav-item">
        <a href="{{ auth()->user()->role_id === 2 ? url('/dosen') : (auth()->user()->role_id === 3 ? url('/koordinator') : (auth()->user()->role_id === 4 ? url('/ketua_jurusan') : url('/dashboard'))) }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item nav-category">Data</li>
    <li class="nav-item">
        <a href="{{route('data-mhs')}}" class="nav-link">
          <i class="link-icon" data-feather="sidebar"></i>
          <span class="link-title">Mahasiswa</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('data-dsn')}}" class="nav-link">
          <i class="link-icon" data-feather="sidebar"></i>
          <span class="link-title">Dosen</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('data-bi')}}" class="nav-link">
          <i class="link-icon" data-feather="sidebar"></i>
          <span class="link-title">Bidang Ilmu</span>
        </a>
    </li>
    <li class="nav-item nav-category">Jadwal</li>
    <li class="nav-item">
        <a href="{{route('data-jadwal')}}" class="nav-link">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Daftar Jadwal</span>
        </a>
    </li>
      @endif
  </div>
</nav>
{{-- <nav class="settings-sidebar">
  <div class="sidebar-body">
    <a href="#" class="settings-sidebar-toggler">
      <i data-feather="settings"></i>
    </a>
    <h6 class="text-muted mb-2">Sidebar:</h6>
    <div class="mb-3 pb-3 border-bottom">
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
          Light
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
          Dark
        </label>
      </div>
    </div>
    <div class="theme-wrapper">
      <h6 class="text-muted mb-2">Light Version:</h6>
      <a class="theme-item active" href="https://www.nobleui.com/laravel/template/demo1/">
        <img src="{{ url('assets/images/screenshots/light.jpg') }}" alt="light version">
      </a>
      <h6 class="text-muted mb-2">Dark Version:</h6>
      <a class="theme-item" href="https://www.nobleui.com/laravel/template/demo2/">
        <img src="{{ url('assets/images/screenshots/dark.jpg') }}" alt="light version">
      </a>
    </div>
  </div>
</nav> --}}
