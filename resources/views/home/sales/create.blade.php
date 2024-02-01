<x-main-layout>

    <x-slot:title>
        {{ $title ?? 'IceAxe' }} :: Sales
    </x-slot:title>

    <x-native-cloud::crud-form title='Create Sales '/>

</x-main-layout>
