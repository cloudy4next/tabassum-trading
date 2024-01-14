<x-main-layout>
    <x-slot:title>
        {{ $title ?? 'Cloudy4next' }} :: Users
    </x-slot>

    <x-native-cloud::crud-edit-form title='Edit Users' />
</x-main-layout>
