<x-main-layout>
    <x-slot:title>
        {{ $title ?? 'Cloudy4next' }} :: Users
    </x-slot>
    <x-generic.create :form="$form" />
</x-main-layout>
