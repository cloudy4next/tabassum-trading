<x-main-layout>

    <x-slot:title>
        {{ $title ?? 'Cloudy4next' }} :: Users
    </x-slot>

    <x-native-cloud::curd-board />

</x-main-layout>
