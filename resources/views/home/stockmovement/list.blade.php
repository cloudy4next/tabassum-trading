<x-main-layout>

    <x-slot:title>
        {{ $title ?? 'IceAxe' }} :: Stockmovement
    </x-slot:title>

    <x-native-cloud::curd-board/>

</x-main-layout>
