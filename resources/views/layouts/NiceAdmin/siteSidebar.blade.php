<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="{{ route('welcome') }}">
                <i class="bi bi-grid"></i>
                <span>Welcome</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#system-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>系統管理</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="system-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('users.index') }}">
                        <i class="bi bi-circle"></i><span>用戶管理</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('roles.index') }}">
                        <i class="bi bi-circle"></i><span>角色管理</span>
                    </a>
                </li>
        </li>
    </ul>
    </li><!-- End System Nav -->




</aside><!-- End Sidebar-->
