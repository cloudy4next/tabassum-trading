<x-main-layout>

    <x-slot:title>
        {{ $title ?? 'IceAxe' }} :: Product
    </x-slot:title>

    <x-native-cloud::crud-form title='Create Product '/>

</x-main-layout>
