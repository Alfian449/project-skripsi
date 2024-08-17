<uls class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('image/smk.png') }}" width="50" height="50" alt="">
        </div>
        <div class="sidebar-brand-text mx-2">SMK Negeri 1 Kraksaan</div>
    </a>
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/dassiswa') }}">
            <i class="fa fa-chart-line"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Memu Siswa
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/pilihinstansi') }}">
            <i class="fa fa-pen"></i>
            <span>Magang</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/history') }}">
            {{-- <a class="nav-link" href="{{ route('trainings.show', $history->id) }}"> --}}
            <i class="fa fa-book-open"></i>
            <span>History</span></a>
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
