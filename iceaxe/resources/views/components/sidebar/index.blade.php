@php
    $applicationName = env('APP_NAME', 'IceAxe');
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{ URL('/') }}" class="brand-link">
        <img src="{{ asset('img/tabassum100x100.jpg') }}" alt="IceAxe" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ $applicationName }}</span>
    </a>

    <div class="sidebar">

        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <x-native-cloud::left-sidebar/>
            </ul>
        </nav>
    </div>

</aside>

