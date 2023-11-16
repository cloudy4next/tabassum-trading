<x-main-layout>

    <x-slot:title>
        {{ $title ?? 'Cloudy4next' }} :: Users
    </x-slot>
    <x-generic.table :columns="$columns" :rows="$items" :actionRoute="$actionRoute" />

</x-main-layout>
