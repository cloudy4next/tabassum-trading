<x-main-layout>
    <x-slot:title>
        {{ $title ?? 'IceAxe' }} :: Company
    </x-slot:title>

    <x-native-cloud::crud-edit-form title='Edit Company ' />
</x-main-layout>
