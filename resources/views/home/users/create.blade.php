<x-main-layout>

    <x-slot:title>
        {{ $title ?? 'IceAxe' }} :: Users
    </x-slot:title>

    <x-native-cloud::crud-form title='Create Users'/>

</x-main-layout>
