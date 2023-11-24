<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;1,300;1,500&display=swap"
          rel="stylesheet">

    <link rel="icon" href="{{ asset('img/favicon/favicon.svg') }}" type="image/svg+xml">

    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/web/app.scss'])
</head>

<body>

<main>
    @include('partials.header')

    <div class="container xl:max-w-screen-xl mx-auto px-5">
        @yield('content')
    </div>

    @include('partials.footer')
</main>

@stack('scripts')

</body>

</html>
