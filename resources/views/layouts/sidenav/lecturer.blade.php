<aside id="sidebar" class="u-sidebar">
    <div class="u-sidebar-inner">
        <header class="u-sidebar-header">
            <a class="u-sidebar-logo" href="index.html">
                <img class="u-sidebar-logo__icon" src="{{ asset('assets/svg/logo-mini.svg') }}" alt="Awesome Icon">
                <img class="u-sidebar-logo__text" src="{{ asset('assets/svg/logo-text-light.svg') }}" alt="Awesome">
            </a>
        </header>

        <nav class="u-sidebar-nav">

            <ul class="u-sidebar-nav-menu u-sidebar-nav-menu--top-level">

                <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link {{ $parent == 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <span class="ti-dashboard u-sidebar-nav-menu__item-icon"></span>
                        <span class="u-sidebar-nav-menu__item-title">Dashboard</span>
                    </a>
                </li>

                <li class="u-sidebar-nav-menu__item {{ $parent == 'presensi' ? 'u-sidebar-nav--opened' : '' }}">
                    <a class="u-sidebar-nav-menu__link" href="#" data-target="#presensiSubmenu">
                        <span class="ti-agenda u-sidebar-nav-menu__item-icon"></span>
                        <span class="u-sidebar-nav-menu__item-title">Presensi</span>
                        <span class="ti-angle-down u-sidebar-nav-menu__item-arrow"></span>
                    </a>

                    <ul id="presensiSubmenu" class="u-sidebar-nav-menu u-sidebar-nav-menu--second-level" style="display: none;">

                        <li class="u-sidebar-nav-menu__item">
                            <a class="u-sidebar-nav-menu__link {{ (!empty($child) && $child == 'buat') ? 'active' : ''}}" href="">
                                <span class="ti-plus u-sidebar-nav-menu__item-icon"></span>
                                <span class="u-sidebar-nav-menu__item-title">Buat baru</span>
                            </a>
                        </li>

                        <li class="u-sidebar-nav-menu__item">
                            <a class="u-sidebar-nav-menu__link {{ (!empty($child) && $child == 'histori') ? 'active' : ''}}" href="{{ route('attendance.get')}}">
                                <span class="ti-time u-sidebar-nav-menu__item-icon"></span>
                                <span class="u-sidebar-nav-menu__item-title">Histori Presensi</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link {{ $parent == 'kursus' ? 'u-sidebar-nav--opened' : '' }}" href="{{ route('course.get') }}">
                        <span class="ti-panel u-sidebar-nav-menu__item-icon"></span>
                        <span class="u-sidebar-nav-menu__item-title">Kursus Saya</span>
                    </a>
                </li>

                <li class="u-sidebar-nav-menu__divider"></li>

                <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link" href="https://htmlstream.com/preview/awesome-dashboard-ui-kit/documentation/" target="_blank">
                        <span class="ti-user u-sidebar-nav-menu__item-icon"></span>
                        <span class="u-sidebar-nav-menu__item-title">Profil</span>
                    </a>
                </li>

                <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link" href="https://htmlstream.com/templates/awesome-dashboard-ui-kit/" target="_blank">
                        <span class="ti-power-off u-sidebar-nav-menu__item-icon"></span>
                        <span class="u-sidebar-nav-menu__item-title">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>