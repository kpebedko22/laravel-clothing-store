@extends('layouts.app')

@section('title', 'Личные данные')

@section('content')
    {{ Breadcrumbs::render('web.personal.profile') }}

    <div class="border rounded-lg bg-white dark:bg-dark dark:text-white shadow-lg p-5">
        <h1>{{ 'Личные данные' }}</h1>

        <div class="">
            <div class="">ID: {{ auth()->id() }}</div>
            <div class="">Yandex ID: {{ auth()->user()->yandex_id ?? '-' }}</div>
            <div class="">
                <a href="{{ route('web.auth.oauth.redirect', [App\Enums\Auth\OAuthProvider::Yandex]) }}">{{ 'Привязать к Яндекс' }}</a>
            </div>
        </div>

        <div class="my-5 grid grid-cols-3 gap-5">
            <div class="flex flex-col items-center relative p-5 border rounded-lg shadow-md">
                <div class="p-3 flex flex-col">
                    <div class="mb-4 text-md font-bold">{{ 'Яндекс' }}</div>
                </div>
                <a href="{{ route('web.auth.oauth.redirect', [App\Enums\Auth\OAuthProvider::Yandex]) }}"
                   class="p-3 text-sm border rounded-lg w-full text-center uppercase font-semibold"
                >{{ 'Подключиться' }}</a>
            </div>
        </div>
    </div>
@endsection
