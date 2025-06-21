<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <!-- Header Logo / Branding -->
        <div class="m-header d-flex align-items-center justify-content-between px-3 py-2">
            <a href="{{ route('dashboard') }}" class="b-brand d-flex align-items-center text-decoration-none">
                <img src="{{ asset('mantis/dist/assets/images/agendasekolah.png') }}" alt="Logo" class="logo me-2"
                    style="width: 65px; height: 65px;">
                <div class="brand-text">
                    <h5 class="mb-0 fw-bold text-primary">Agenda Sekolah</h5>
                    <small class="text-muted d-block" style="font-size: 0.75rem;">Manajemen Kegiatan</small>
                </div>
            </a>
            <!-- Optional: collapse sidebar button -->
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <!-- Menu untuk semua role -->
                <li class="pc-item">
                    <a href="{{ asset('mantis/dist') }}/dashboard/index.html" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <!-- Menu khusus untuk admin -->
                @if (Auth::check() && Auth::user()->role == 'admin')
                    <li class="pc-item pc-caption">
                        <label>Admin Settings</label>
                        <i class="ti ti-settings"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('dashadmin') }}" class="pc-link"> 
                            <span class="pc-micon"><i class="ti ti-users"></i></span>
                            <span class="pc-mtext">Statistik</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('users.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-users"></i></span>
                            <span class="pc-mtext">Kelola Akun</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('admin.kegiatan') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-users"></i></span>
                            <span class="pc-mtext">Semua Kegiatan Guru</span>
                        </a>
                    </li>
                @endif

                <!-- Menu khusus untuk teacher -->
                @if (Auth::check() && Auth::user()->role == 'guru')
                    <li class="pc-item pc-caption">
                        <label>Teacher Tools</label>
                        <i class="ti ti-book"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('tambah.guru') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-calendar"></i></span>
                            <span class="pc-mtext">Tambah Kegiatan</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('lihat.guru') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-calendar"></i></span>
                            <span class="pc-mtext">Semua Kegiatan</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('pendaftaran.siswa') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-users"></i></span>
                            <span class="pc-mtext">Siswa Mendaftar</span>
                        </a>
                    </li>
                @endif

                <!-- Menu khusus untuk student -->
                @if (Auth::check() && Auth::user()->role == 'siswa')
                    <li class="pc-item pc-caption">
                        <label>Student Resources</label>
                        <i class="ti ti-school"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('daftar.siswa') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-calendar"></i></span>
                            <span class="pc-mtext">Daftar Kegiatan</span>
                        </a>
                    </li>
                @endif

                <!-- Menu untuk semua role -->
                {{-- <li class="pc-item pc-caption">
                    <label>Other</label>
                    <i class="ti ti-brand-chrome"></i>
                </li>
                <li class="pc-item">
                    <a href="{{ asset('mantis/dist') }}/pages/login.html" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-lock"></i></span>
                        <span class="pc-mtext">Login</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ asset('mantis/dist') }}/pages/register.html" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-user-plus"></i></span>
                        <span class="pc-mtext">Register</span>
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->
