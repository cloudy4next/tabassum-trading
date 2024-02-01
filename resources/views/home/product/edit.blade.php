<x-main-layout>
    <x-slot:title>
        {{ $title ?? 'IceAxe' }} :: Product
    </x-slot:title>

    <x-native-cloud::crud-edit-form title='Edit Product ' />
</x-main-layout>
