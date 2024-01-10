@php /** @var App\DTOs\Auth\OAuthUserDTO $data */ @endphp

@extends('layouts.app')

@section('title', 'Привязка учётной записи')

@section('content')
    {{ Breadcrumbs::render('auth.oauth') }}

    <div class="container md:max-w-screen-sm mx-auto">
        <div class="border rounded-lg bg-white dark:bg-dark dark:text-white shadow-lg p-8">

            <h1 class="text-4xl font-bold mb-4">{{ 'Привязка учётной записи' }}</h1>

            <h2 class="mb-4">{{ 'Чтобы в дальнейшем вы могли входить с помощью своей учётной записи ' . $data->provider->name .', её нужно привязать к учётной записи ' . config('app.name'). '. Войдите или создайте учётную запись, используя свой электронный адрес.' }}</h2>

            <livewire:web.auth.o-auth-login :data="$data"/>
        </div>
    </div>
@endsection
