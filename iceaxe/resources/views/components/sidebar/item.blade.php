@props(['item'])

@inject('sidebarItemHelper', 'NativeBL\Admin\MenuBuilder\SidebarItemHelper')

@if ($sidebarItemHelper->isSubmenu($item))

    {{-- Treeview menu --}}
    <x-native::sidebar.treeview :item="$item"/>

@elseif ($sidebarItemHelper->isLink($item))

    {{-- Link --}}
    <x-native::sidebar.link :item="$item"/>

@endif
