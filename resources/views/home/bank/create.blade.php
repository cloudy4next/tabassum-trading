<x-main-layout>

    <x-slot:title>
        {{ $title ?? 'IceAxe' }} :: Bank
    </x-slot:title>

    <x-native-cloud::crud-form title='Create Bank '/>

</x-main-layout>
