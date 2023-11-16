@php
    $segment = request()->segment(1) ?? 'null';
@endphp

<nav class="sidebar js-sidebar" id="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/">
            <span class="align-middle">Admin Laes</span>
        </a>
        <ul class="sidebar-nav">

            <li class="sidebar-header">Pages</li>
            <li class="sidebar-item {{ in_array($segment, ['home', 'settings', 'blank']) ? 'active' : '' }}">
                <a class="sidebar-link" href="/">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li
                class="sidebar-item {{ in_array($segment, ['pages', 'pages-settings', 'pages-blank']) ? 'active' : '' }}">
                <a class="sidebar-link" data-bs-target="#pages" data-bs-toggle="collapse">
                    <i data-feather="file"></i>
                    <span class="align-middle">Pages</span>
                </a>
                <ul class="sidebar-dropdown list-unstyled collapse show" id="pages" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-settings.html">Settings</a>
                    </li>
                    <li class="sidebar-item {{ 'pages-blank' == $segment ? 'active' : '' }}">
                        <a class="sidebar-link" href="pages-blank.html">Blank Page</a>
                    </li>
                </ul>
            </li>
            <li
                class="sidebar-item {{ in_array($segment, ['pages-profile', 'pages-sign-in', 'pages-sign-up', 'pages-reset-password', 'pages-recover-password', 'pages-404', 'pages-500']) ? 'active' : '' }}">
                <a class="sidebar-link" href="pages-profile.html">
                    <i class="align-middle" data-feather="user"></i>
                    <span class="align-middle">Profile</span>
                </a>
            </li>
            <li
                class="sidebar-item {{ in_array($segment, ['pages-sign-in', 'pages-sign-up', 'pages-reset-password', 'pages-recover-password', 'pages-404', 'pages-500']) ? 'active' : '' }}">
                <a class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse">
                    <i data-feather="users"></i>
                    <span class="align-middle">Auth</span>
                </a>
                <ul class="sidebar-dropdown list-unstyled collapse" id="auth" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-sign-in.html">Sign In</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-sign-up.html">Sign Up</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-reset-password.html">Reset Password</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-recover-password.html">Recover Password</a>
                    </li>
                    <li class="sidebar-item {{ in_array($segment, ['pages-404', 'pages-500']) ? 'active' : '' }}">
                        <a class="sidebar-link" href="pages-404.html">404</a>
                    </li>
                    <li class="sidebar-item {{ 'pages-500' == $segment ? 'active' : '' }}">
                        <a class="sidebar-link" href="pages-500.html">500</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-header">Plugins &amp; Addons</li>
            <li
                class="sidebar-item {{ in_array($segment, ['charts-chartjs', 'maps-google', 'components']) ? 'active' : '' }}">
                <a class="sidebar-link" href="charts-chartjs.html">
                    <i class="align-middle" data-feather="bar-chart-2"></i>
                    <span class="align-middle">Charts</span>
                </a>
            </li>
            <li class="sidebar-item {{ 'maps-google' == $segment ? 'active' : '' }}">
                <a class="sidebar-link" href="maps-google.html">
                    <i class="align-middle" data-feather="map"></i>
                    <span class="align-middle">Maps</span>
                </a>
            </li>
            <li class="sidebar-item {{ 'components' == $segment ? 'active' : '' }}">
                <a class="sidebar-link" href="components.html">
                    <i class="align-middle" data-feather="moon"></i>
                    <span class="align-middle">Components</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
