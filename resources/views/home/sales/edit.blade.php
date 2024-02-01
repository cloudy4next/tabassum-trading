<x-main-layout>
    <x-slot:title>
        {{ $title ?? 'IceAxe' }} :: Sales
    </x-slot:title>

    <x-native-cloud::crud-edit-form title='Edit Sales ' />
</x-main-layout>
