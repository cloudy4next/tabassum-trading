<x-main-layout>

    <x-slot:title>
        {{ $title ?? 'Cloudy4next' }} :: Users
    </x-slot>

    <x-generic.table :columns="$columns" :rows="$data" :filters="$filters" :buttons="$buttons" />

</x-main-layout>
