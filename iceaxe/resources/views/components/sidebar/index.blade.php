@php
    use NativeBL\Admin\MenuBuilder\NativeBLMenu;
    $applicationName = env('APP_NAME', 'Native BL');
    // $menus = app(NativeBLMenu::class)->menu('sidebar');
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    {{-- Sidebar brand logo --}}
    <a href="{{URL('/')}}" class="brand-link">
        <img src="{{asset('img/blx100x100.png')}}" alt="Native BL" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">lal</span>
    </a>

    {{-- Sidebar menu --}}
    <div class="sidebar">

        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- Configured sidebar links --}}
                {{-- @foreach($menus as $item)
                    <x-native::sidebar.item :item="$item"/>
                @endforeach --}}
            </ul>
        </nav>
    </div>

</aside>

