<x-main-layout>
    <x-slot:title>
        {{ $title ?? 'IceAxe' }} :: Users
    </x-slot:title>

    <x-native-cloud::crud-edit-form title='Edit Users' />
</x-main-layout>
