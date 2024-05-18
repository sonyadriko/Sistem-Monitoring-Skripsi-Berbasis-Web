<nav class="sidebar">
  <!-- Sidebar header with dynamic dashboard URL based on user role -->
  <div class="sidebar-header">
    @php
    // Inisialisasi variabel URL dashboard
    $dashboardUrl = '';
    // Menentukan URL dashboard berdasarkan peran pengguna
    switch (auth()->user()->role_id) {
        case 2:
            $dashboardUrl = url('/dosen'); // URL untuk role_id 2 (Dosen)
            break;
        case 3:
            $dashboardUrl = url('/koordinator'); // URL untuk role_id 3 (Koordinator)
            break;
        case 4:
            $dashboardUrl = url('/ketua_jurusan'); // URL untuk role_id 4 (Ketua Jurusan)
            break;
        default:
            $dashboardUrl = url('/dashboard'); // URL default untuk peran lain
    }
    @endphp
    <!-- Tautan ke dashboard spesifik pengguna -->
    <a href="{{ $dashboardUrl }}" class="sidebar-brand">
      SM<span> SKRIPSI</span>
    </a>
    <!-- Pengatur sidebar untuk tampilan mobile -->
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <!-- Sidebar body containing navigation links -->
  <div class="sidebar-body">
    <ul class="nav">
        <!-- Navigation for users with role_id 1 (Administrator) -->
        @if(Auth::user()->role_id == 1)
        <!-- Item menu untuk Mahasiswa -->
        <li class="nav-item">
            @php
                // Menginisialisasi ulang URL dashboard untuk role_id 1 (Mahasiswa)
                $dashboardUrl = url('/dashboard');
            @endphp
            <!-- Link menuju dashboard untuk Mahasiswa -->
            <a href="{{ $dashboardUrl }}" class="nav-link">
                <i class="link-icon" data-feather="box"></i>
                <span class="link-title">Dashboard</span>
            </a>
        </li>
        <!-- Kategori dan item menu tambahan untuk Mahasiswa -->
        <li class="nav-item nav-category">Pengajuan & Surat</li>
        <li class="nav-item ">
            <!-- Menu dropdown untuk Forms -->
            <a class="nav-link" data-bs-toggle="collapse" href="#email" role="button"  aria-controls="email">
                <i class="link-icon" data-feather="inbox"></i>
                <span class="link-title">Forms</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="email">
                <ul class="nav sub-menu">
                    <!-- Sub-menu untuk Pengajuan Judul -->
                    <li class="nav-item">
                    <a href="{{ route('pengajuan-judul.form') }}" class="nav-link">Pengajuan Judul</a>
                    </li>
                    <!-- Sub-menu untuk Sidang Proposal -->
                    <li class="nav-item">
                    <a href="{{ route('seminar-proposal.check')}}" class="nav-link">Sidang Proposal</a>
                    </li>
                    <!-- Sub-menu untuk Surat Tugas Bimbingan -->
                    <li class="nav-item">
                    <a href="{{ route('pengajuan-st.check') }}" class="nav-link">Surat Tugas Bimbingan</a>
                    </li>
                    <!-- Sub-menu untuk Sidang Skripsi -->
                    <li class="nav-item">
                        <a href="{{ route('sidang-skripsi.check')}}" class="nav-link">Sidang Skripsi</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">Bimbingan & Revisi</li>
        <li class="nav-item ">
            <!-- Menu dropdown untuk Bimbingan -->
            <a class="nav-link" data-bs-toggle="collapse" href="#bimbingan" role="button"  aria-controls="bimbingan">
                <i class="link-icon" data-feather="book"></i>
                <span class="link-title">Bimbingan</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="bimbingan">
                <ul class="nav sub-menu">
                    <!-- Sub-menu untuk Bimbingan Proposal -->
                    <li class="nav-item">
                        <a href="{{ route('bimbingan-mhs.index') }}" class="nav-link">Bimbingan Proposal</a>
                    </li>
                    <!-- Sub-menu untuk Bimbingan Skripsi -->
                    <li class="nav-item">
                        <a href="{{ route('bimbingans-mhs.index')}}" class="nav-link">Bimbingan Skripsi</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item ">
            <!-- Menu dropdown untuk Revisi -->
            <a class="nav-link" data-bs-toggle="collapse" href="#revisi" role="button"  aria-controls="revisi">
                <i class="link-icon" data-feather="inbox"></i>
                <span class="link-title">Revisi</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="revisi">
                <ul class="nav sub-menu">
                    <!-- Sub-menu untuk Sidang Proposal Skripsi -->
                    <li class="nav-item">
                        <a href="{{ route('revisi_sp.index') }}" class="nav-link">Sidang Proposal Skripsi</a>
                    </li>
                    <!-- Sub-menu untuk Sidang Laporan Skripsi -->
                    <li class="nav-item">
                        <a href="{{ route('revisi_sk.index')}}" class="nav-link">Sidang Laporan Skripsi</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">Lain - lain</li>
        <li class="nav-item ">
            <!-- Menu dropdown untuk item Lain-lain -->
            <a class="nav-link" data-bs-toggle="collapse" href="#lainlain" role="button"  aria-controls="lainlain">
                <i class="link-icon" data-feather="mail"></i>
                <span class="link-title">Lain - lain</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="lainlain">
                <ul class="nav sub-menu">
                    <!-- Sub-menu untuk FAQ -->
                    <li class="nav-item">
                        <a href="{{ route('faq')}}" class="nav-link">FAQ</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    @elseif(Auth::user()->role_id == 3)
    <!-- Menu Dashboard untuk Koordinator -->
    <li class="nav-item">
        <a href="{{ auth()->user()->role_id === 2 ? url('/dosen') : (auth()->user()->role_id === 3 ? url('/koordinator') : url('/dashboard')) }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
    </li>
    <!-- Kategori Pengajuan & Surat -->
    <li class="nav-item nav-category">Pengajuan & Surat</li>
        <li class="nav-item ">
            <!-- Menu Proposal & Skripsi -->
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
            </ul>
        </div>
    </li>

    <!-- Kategori Jadwal & Berita Acara -->
    <li class="nav-item nav-category">Jadwal & Berita Acara</li>
    <li class="nav-item">
        <!-- Menu Penjadwalan -->
        <a href="{{ route('penjadwalan-koordinator.index') }}" class="nav-link">
            <i class="link-icon" data-feather="calendar"></i>
            <span class="link-title">Penjadwalan</span>
        </a>
    </li>
      <li class="nav-item ">
        <!-- Menu Berita Acara -->
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

      <!-- Kategori Manajemen -->
      <li class="nav-item nav-category">Manajemen</li>
      <li class="nav-item">
        <!-- Menu Data Pengguna -->
        <a href="{{route('data-pengguna.index')}}" class="nav-link">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">Data Pengguna</span>
        </a>
      </li>
      <li class="nav-item">
        <!-- Menu Ruangan -->
        <a href="{{route('ruangan.index')}}" class="nav-link">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Ruangan</span>
        </a>
      </li>
      <li class="nav-item">
        <!-- Menu Mata Kuliah Pendukung -->
        <a href="{{route('mata-kuliah.index')}}" class="nav-link">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Mata Kuliah Pendukung</span>
        </a>
      </li>
     @elseif(Auth::user()->role_id == 2)
     <!-- Menu Dashboard untuk Dosen -->
     <li class="nav-item">
        <a href="{{ auth()->user()->role_id === 2 ? url('/dosen') : (auth()->user()->role_id === 3 ? url('/koordinator') : url('/dashboard')) }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
    </li>
    <!-- Kategori Bidang Ilmu -->
    <li class="nav-item nav-category">Bidang Ilmu</li>
    <li class="nav-item">
        <!-- Menu Tema Penelitian untuk Dosen -->
        <a href="{{route('dosen-bidang-ilmu.index')}}" class="nav-link">
          <i class="link-icon" data-feather="sidebar"></i>
          <span class="link-title">Tema Penelitian</span>
        </a>
    </li>
    <!-- Kategori Bimbingan & Revisi -->
    <li class="nav-item nav-category">Bimbingan & Revisi</li>
    <li class="nav-item ">
        <!-- Menu Mahasiswa Bimbingan -->
        <a class="nav-link" data-bs-toggle="collapse" href="#bs" role="button"  aria-controls="email">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Mahasiswa Bimbingan</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="bs">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <!-- Sub-menu Proposal Skripsi -->
              <a href="{{ route('bimbingan-dosen.index') }}" class="nav-link">Proposal Skripsi</a>
            </li>
            <li class="nav-item">
              <!-- Sub-menu Laporan Skripsi -->
              <a href="{{ route('bimbingans-dosen.index')}}" class="nav-link">Laporan Skripsi</a>
            </li>
          </ul>
        </div>
    </li>
    <li class="nav-item">
        <!-- Menu Daftar Jadwal untuk Dosen -->
        <a href="{{route('jadwal-menguji.index')}}" class="nav-link">
            <i class="link-icon" data-feather="sidebar"></i>
            <span class="link-title">Daftar Jadwal</span>
        </a>
    </li>
    <li class="nav-item ">
        <!-- Menu Revisi -->
        <a class="nav-link" data-bs-toggle="collapse" href="#rev" role="button"  aria-controls="email">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Revisi</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="rev">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <!-- Sub-menu Sidang Proposal Skripsi -->
              <a href="{{ route('dosen-revisi-sempro.index') }}" class="nav-link">Sidang Proposal Skripsi</a>
            </li>
            <li class="nav-item">
              <!-- Sub-menu Sidang Laporan Skripsi -->
              <a href="{{ route('dosen-revisi-semhas.index')}}" class="nav-link">Sidang Laporan Skripsi</a>
            </li>
          </ul>
        </div>
    </li>
    <!-- Kategori Berita Acara -->
    <li class="nav-item nav-category">Berita Acara</li>
    <li class="nav-item">
        <!-- Menu Sidang Proposal -->
        <a href="{{route('berita-acara-proposal.index')}}" class="nav-link">
          <i class="link-icon" data-feather="book-open"></i>
          <span class="link-title">Sidang Proposal</span>
        </a>
    </li>
    <li class="nav-item">
        <!-- Menu Sidang Skripsi -->
        <a href="{{route('berita-acara-skripsi.index')}}" class="nav-link">
          <i class="link-icon" data-feather="file-text"></i>
          <span class="link-title">Sidang Skripsi</span>
        </a>
    </li>
    <!-- Kategori Lain-lain -->
    <li class="nav-item nav-category">Lain-lain</li>
    <li class="nav-item">
        <!-- Menu Sekretaris -->
        <a href="{{route('sekretaris-ba.index')}}" class="nav-link">
          <i class="link-icon" data-feather="book-open"></i>
          <span class="link-title">Sekretaris</span>
        </a>
    </li>
    @elseif(Auth::user()->role_id == 4)
    <li class="nav-item">
        <!-- Menu Dashboard untuk Ketua Jurusan -->
        <a href="{{ auth()->user()->role_id === 2 ? url('/dosen') : (auth()->user()->role_id === 3 ? url('/koordinator') : (auth()->user()->role_id === 4 ? url('/ketua_jurusan') : url('/dashboard'))) }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
    </li>
    <!-- Kategori Data -->
    <li class="nav-item nav-category">Data</li>
    <li class="nav-item">
        <!-- Menu Data Mahasiswa -->
        <a href="{{route('data-mhs')}}" class="nav-link">
          <i class="link-icon" data-feather="sidebar"></i>
          <span class="link-title">Mahasiswa</span>
        </a>
    </li>
    <li class="nav-item">
        <!-- Menu Data Dosen -->
        <a href="{{route('data-dsn')}}" class="nav-link">
          <i class="link-icon" data-feather="sidebar"></i>
          <span class="link-title">Dosen</span>
        </a>
    </li>
    <li class="nav-item">
        <!-- Menu Data Bidang Ilmu -->
        <a href="{{route('data-bi')}}" class="nav-link">
          <i class="link-icon" data-feather="sidebar"></i>
          <span class="link-title">Bidang Ilmu</span>
        </a>
    </li>
    <!-- Kategori Jadwal -->
    <li class="nav-item nav-category">Jadwal</li>
    <li class="nav-item">
        <!-- Menu Daftar Jadwal -->
        <a href="{{route('data-jadwal')}}" class="nav-link">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Daftar Jadwal</span>
        </a>
    </li>
      @endif
  </div>
</nav>

