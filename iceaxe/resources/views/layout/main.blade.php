<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if (isset($title))
        <title>{{ env('APP_NAME') . ':: ' . $title ?? 'IceAxe' }}</title>
    @else
        <title>{{ env('APP_NAME') }}</title>
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="module">
        window.base_url = "{{ url('/') }}";
        window.csrf_token = "{{ csrf_token() }}";
    </script>

    @vite('resources/js/app.js')

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    {{-- <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('img/tabassum.jpg') }}" alt="tabassum" height="200" width="200">
    </div> --}}


    <div class="wrapper">

        <!-- Navbar -->
        <x-native-cloud::navbar />
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <x-native-cloud::sidebar />

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            @isset($pageHeader)
                                {{ $pageHeader }}
                            @endisset
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            @isset($breadcrumb)
                                {{ $breadcrumb }}
                            @endisset
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            {{ $slot }}
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <x-native-cloud::right-sidebar />
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <x-native-cloud::footer />

    </div>

    @if (session('success'))
        <x-native-cloud::toast type="success" message="{{ session('success') }}" />
    @elseif(session('info'))
        <x-native-cloud::toast type="info" message="{{ session('info') }}" />
    @elseif(session('warning'))
        <x-native-cloud::toast type="warning" message="{{ session('warning') }}" />
    @elseif(session('error'))
        <x-native-cloud::toast type="error" color="sda" message="{{ session('error') }}" />
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-native-cloud::toast type="error" message="{{ $error }}" />
        @endforeach
    @endif
    @stack('scripts')
</body>

</html>
