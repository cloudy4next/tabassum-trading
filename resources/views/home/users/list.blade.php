<x-main-layout>

    <x-slot:title>
        {{ $title ?? 'Cloudy4next' }} :: Users
    </x-slot:title>

    <x-native-cloud::curd-board />

</x-main-layout>
