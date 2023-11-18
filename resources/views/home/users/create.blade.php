<x-main-layout>
    <x-slot:title>
        {{ $title ?? 'Cloudy4next' }} :: Users
    </x-slot>
    <x-generic.create :column="$column" :route="$route" />
</x-main-layout>
