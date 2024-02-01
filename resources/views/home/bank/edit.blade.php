<x-main-layout>
    <x-slot:title>
        {{ $title ?? 'IceAxe' }} :: Bank
    </x-slot:title>

    <x-native-cloud::crud-edit-form title='Edit Bank ' />
</x-main-layout>
