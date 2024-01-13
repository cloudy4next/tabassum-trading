<x-main-layout>

    <x-slot:title>
        {{ $title ?? 'Cloudy4next' }} :: Users
    </x-slot>

    <x-native-cloud::crud-form title='Create Users'/>

</x-main-layout>
