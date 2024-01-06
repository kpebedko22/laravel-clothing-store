<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('img/favicon/favicon.svg') }}" type="image/svg+xml">

    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/web/app.scss'])
</head>

<body>

<div class="flex flex-col min-h-screen">
    @include('partials.header')

    <main class="container xl:max-w-screen-xl mx-auto px-5 flex-grow">
        @yield('content')
    </main>

    @include('partials.footer')
</div>

@stack('scripts')

</body>

</html>
