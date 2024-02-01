<x-main-layout>
    <x-slot:title>
        {{ $title ?? 'IceAxe' }} :: Stockmovement
    </x-slot:title>

    <x-native-cloud::crud-edit-form title='Edit Stockmovement ' />
</x-main-layout>
