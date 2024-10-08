<uls class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('image/smk.png') }}" width="50" height="50" alt="">
        </div>
        <div class="sidebar-brand-text mx-2">SMK Negeri 1 Kraksaan</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/dasadmin') }}">
            <i class="fa fa-chart-line"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Memu Admin
    </div>

    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin') }}">
            <i class="fa fa-user"></i>
            <span>Data Admin</span></a>
    </li> --}}

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/guru') }}">
            <i class="fa fa-chalkboard"></i>
            <span>Data Guru</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/siswa') }}">
            <i class="fa fa-users"></i>
            <span>Data Siswa</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/instansi') }}">
            <i class="fa fa-calendar"></i>
            <span>Data Instansi</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/jurusan') }}">
            <i class="fa fa-graduation-cap"></i>
            <span>Jurusan</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/list-training') }}">
            <i class="fa fa-map-marker-alt"></i>
            <span>Ploting Prakerin</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/rekap-nilai') }}">
            <i class="fa fa-signal"></i>
            <span>Rekap Nilai</span></a>
    </li>

    <form method="POST" action="/logout">
        @csrf
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/logout') }}"
                onclick="event.preventDefault();
        this.closest('form').submit();">
                <i class="fa fa-arrow-right"></i>
                <span>Logout</span>
            </a>
        </li>
    </form>

    <hr class="sidebar-divider d-none d-md-block">

</uls>
