@php
    $permissions = getPermissionModuleGroup();
@endphp
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ array_key_exists('logo_app_admin', $settings) ? img_src($settings['logo_app_admin'], 'settings') : 'http://via.placeholder.com/500x500?text=Not%2520Found' }}"
                    width="46px" height="46px" alt="">
            </span>
            <span
                class="app-brand-text demo menu-text fw-bolder ms-2">{{ array_key_exists('nama_app_admin', $settings) ? $settings['nama_app_admin'] : 'Startweb' }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item menu-search {{ Route::is('admin.dashboard*') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Data Master</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item menu-search">
                    <a href="#" class="menu-link">
                        <div data-i18n="Without menu">Without menu</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
        </li>
        @if (showModule('user_group', $permissions) || showModule('user', $permissions))
            <li class="menu-item {{ Route::is('admin.users*', 'admin.user_groups*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon tf-icons bx bxs-user-detail'></i>
                    <div data-i18n="User Management">User Management</div>
                </a>
                <ul class="menu-sub">
                    @if (showModule('user_group', $permissions))
                        <li class="menu-item menu-search {{ Route::is('admin.user_groups*') ? 'active' : '' }}">
                            <a href="{{ route('admin.user_groups') }}" class="menu-link">
                                <div data-i18n="User Groups">User Groups</div>
                            </a>
                        </li>
                    @endif
                    @if (showModule('user', $permissions))
                        <li class="menu-item menu-search {{ Route::is('admin.users*') ? 'active' : '' }}">
                            <a href="{{ route('admin.users') }}" class="menu-link">
                                <div data-i18n="Users">Users</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if (showModule('log_system', $permissions) || showModule('statistic', $permissions))
            <li class="menu-item {{ Route::is('admin.logSystems*', 'admin.statistic*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon tf-icons bx bx-server'></i>
                    <div data-i18n="Systems">Systems</div>
                </a>
                <ul class="menu-sub">
                    @if (showModule('log_system', $permissions))
                        <li class="menu-item menu-search {{ Route::is('admin.logSystems*') ? 'active' : '' }}">
                            <a href="{{ route('admin.logSystems') }}" class="menu-link">
                                <div data-i18n="Logs">Logs</div>
                            </a>
                        </li>
                    @endif
                    @if (showModule('statistic', $permissions))
                        <li class="menu-item menu-search {{ Route::is('admin.statistic*') ? 'active' : '' }}">
                            <a href="{{ route('admin.statistic') }}" class="menu-link">
                                <div data-i18n="Track Statistics">Track Statistics</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if (showModule('settings', $permissions) || showModule('module_management', $permissions))
            <li class="menu-item {{ Route::is('admin.settings*', 'admin.module*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon tf-icons bx bx-cog'></i>
                    <div data-i18n="Settings">Settings</div>
                </a>
                <ul class="menu-sub">
                    @if (showModule('settings', $permissions))
                        <li class="menu-item menu-search {{ Route::is('admin.settings*') ? 'active' : '' }}">
                            <a href="{{ route('admin.settings') }}" class="menu-link">
                                <div data-i18n="Menu Settings">Menu Settings</div>
                            </a>
                        </li>
                    @endif
                    @if (showModule('module_management', $permissions))
                        <li class="menu-item menu-search {{ Route::is('admin.module*') ? 'active' : '' }}">
                            <a href="{{ route('admin.module') }}" class="menu-link">
                                <div data-i18n="Modul Management">Modul Management</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

    </ul>
</aside>
