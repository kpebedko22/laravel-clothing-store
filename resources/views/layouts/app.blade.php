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
{{--  dark:bg-[#12100E] dark:bg-gradient-to-r dark:to-[#12100E] dark:from-[#2B4162] --}}
{{--  bg-light/10 bg-gradient-to-r to-light/30 from-light/80 --}}
{{-- background-image: radial-gradient(circle at top,#412ea5,#1f2937,#111827 100%); --}}
<main class="">
    @include('partials.header')

    <div class="container xl:max-w-screen-xl mx-auto px-5">
        @yield('content')
    </div>

    @include('partials.footer')
</main>

@stack('scripts')

</body>

</html>
