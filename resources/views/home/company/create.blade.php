<x-main-layout>

    <x-slot:title>
        {{ $title ?? 'IceAxe' }} :: Company
    </x-slot:title>

    <x-native-cloud::crud-form title='Create Company '/>

</x-main-layout>
