<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('images/neskar.png') }}" alt="Logo Neskar" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        @php
            $name = auth()->user()->name ?? 'User';
            $initial = strtoupper(substr($name, 0, 1));
        @endphp
        <div class="d-flex align-items-center justify-content-center bg-secondary text-white rounded-circle elevation-2"
             style="width: 35px; height: 35px; font-weight: bold; font-size: 20px;">
            {{ $initial }}
        </div>
    </div>
    <div class="info">
        <a href="#" class="d-block">{{ $name }}</a>
    </div>
</div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Cari..." aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Master Data -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('guru.index') }}" class="nav-link">
                                <i class="fas fa-chalkboard-teacher nav-icon"></i>
                                <p>Guru</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('mapel.index') }}" class="nav-link">
                                <i class="fas fa-book-open nav-icon"></i>
                                <p>Mata Pelajaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ruangan.index') }}" class="nav-link">
                                <i class="fas fa-door-open nav-icon"></i>
                                <p>Ruangan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                    <a href="{{ route('kelas.index') }}" class="nav-link">
                        <i class="fas fa-school nav-icon"></i>
                        <p>Kelas</p>
                    </a>
                </li>
                        <li class="nav-item">
                    <a href="{{ route('jadwal.index') }}" class="nav-link">
                        <i class="fas fa-calendar-alt nav-icon"></i>
                        <p>Jadwal</p>
                    </a>
                </li>
                    </ul>
                </li>

                <!-- Jadwal -->
                

                <!-- Dashboard Publik (Opsional) -->
                <li class="nav-item">
                    <a href="{{ route('lab.selector') }}" target="_blank" class="nav-link">
                        <i class="nav-icon fas fa-tv"></i>
                        <p>Display</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>