<x-main-layout>

    <x-slot:title>
        {{ $title ?? 'IceAxe' }} :: Stockmovement
    </x-slot:title>

    <x-native-cloud::crud-form title='Create Stockmovement '/>

</x-main-layout>
