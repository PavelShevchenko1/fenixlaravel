<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ url('index') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/logo-dark.png') }}" alt="" height="20">
            </span>
        </a>

        <a href="{{ url('index') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/logo-light.png') }}" alt="" height="20">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Контент</li>
                <li>
                    <a href="{{ url('/news') }}">
                        <i class="uil-newspaper"></i><span>Новости</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/sorts') }}">
                        <i class="bx bxs-drink"></i><span>Наши сорта</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/stores') }}">
                        <i class="uil uil-map"></i><span>Адреса и телефоны</span>
                    </a>
                </li>
                <li class="menu-title">Система</li>
                <li>
                    <a href="{{ url('/users') }}">
                        <i class="uil-user"></i><span>Пользователи</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/user-groups') }}">
                        <i class="uil-users-alt"></i><span>Группы пользователей</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/notifications') }}">
                        <i class="bx bx-bell"></i><span>Уведомления</span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
