<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{-- <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

    <!-- Scripts -->
    <link rel="stylesheet" href="/css/app.css">


</head>

<body>
    <main>
        {{ $slot }}
        <script src="/js/app.js"></script>
        @stack('scripts')

        @if (session('success'))
            <x-utils.toast type="success" message="{{ session('success') }}" />
        @elseif(session('info'))
            <x-utils.toast type="info" message="{{ session('info') }}" />
        @elseif(session('warning'))
            <x-utils.toast type="warning" message="{{ session('warning') }}" />
        @elseif(session('error'))
            <x-utils.toast type="error" message="{{ session('error') }}" />
        @endif
    </main>

</body>

</html>
