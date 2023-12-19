@extends('layouts.app')

@section('title', 'Авторизация')

@section('content')
    {{ Breadcrumbs::render('auth.index') }}

    <div class="border rounded-lg bg-white dark:bg-dark dark:text-white shadow-lg p-5">

        <h1 class="">{{ 'Авторизация' }}</h1>

        <h2 class="mb-4">{{ 'Авторизировавшись, вы сможете управлять своими личными данными, следить за состоянием заказов.' }}</h2>

        <div class="flex mb-4">
            <a href="{{ route('web.auth.oauth.redirect', [App\Enums\Auth\OAuthProvider::Yandex]) }}"
               class="border border-orange-600 text-orange-600 p-3 rounded-lg hover:bg-orange-600 hover:text-white transition-all"
            >
                {{ 'Войти через Яндекс' }}
            </a>
        </div>

        @php /** @var Illuminate\Support\ViewErrorBag $errors */ @endphp
        @if (($bag = $errors->getBag('oauth')) && $bag->isNotEmpty())
            <div class="p-4 mb-4 text-red-500 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400"
                 role="alert">
                <span class="font-medium">{{ $bag->first() }}</span>
            </div>
        @endif

        <livewire:web.auth.login/>
    </div>
@endsection
