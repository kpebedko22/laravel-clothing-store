<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;1,300;1,500&display=swap"
          rel="stylesheet">
    {{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"--}}
    {{--          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"--}}
    {{--          crossorigin="anonymous">--}}
    <link href="{{ asset('font-awesome-4.1.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    {{--    <link rel="stylesheet" href="{{ asset('css/style.css') }}">--}}

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
{{--@if ($_SERVER['REQUEST_URI'] != '/cart')--}}
{{--@endif--}}


{{--@include('partials/footer')--}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{--<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"--}}
{{--        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"--}}
{{--        crossorigin="anonymous"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"--}}
{{--        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"--}}
{{--        crossorigin="anonymous"></script>--}}
{{--<script src="{{ asset('js/ajaxfuncs.js') }}"></script>--}}

@stack('scripts')

</body>

</html>