{{-- resources/views/vendor/adminlte/partials/common/head.blade.php --}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('adminlte.title', 'Sistema'))</title>

    {{-- Favicon personalizado --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}">

    {{-- Estilos de AdminLTE --}}
    @yield('adminlte_css_pre')
    @stack('css')
    @yield('adminlte_css')
</head>
