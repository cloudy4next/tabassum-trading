<x-main-layout>
    <x-slot:title>
        {{ $title ?? 'Cloudy4next' }} :: Users
    </x-slot>
    <x-generic.edit :form="$form" />
</x-main-layout>
