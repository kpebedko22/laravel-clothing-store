@extends('layouts.app')

@section('title', 'Авторизация')

@section('content')
    {{ Breadcrumbs::render('auth.index') }}

    <div class="container md:max-w-screen-sm mx-auto">
        <div class="border rounded-lg bg-white dark:bg-dark dark:text-white shadow-lg p-8">

            <h1 class="text-4xl font-bold mb-4">{{ 'Авторизация' }}</h1>

            <h2 class="mb-4">{{ 'Авторизировавшись, вы сможете управлять своими личными данными, следить за состоянием заказов.' }}</h2>

            <hr>

            @php /** @var Illuminate\Support\ViewErrorBag $errors */ @endphp
            @if (($bag = $errors->getBag('oauth')) && $bag->isNotEmpty())
                <div class="p-4 mb-4 text-red-500 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400"
                     role="alert">
                    <span class="font-medium">{{ $bag->first() }}</span>
                </div>
            @endif

            <div class="my-4">
                <livewire:web.auth.login/>
            </div>

            <div class="oauth-divider">
                <div class="oauth-divider__inner">
                    {{ 'или продолжите через' }}
                </div>
            </div>

            <div class="flex justify-center gap-3">
                @foreach(\App\Enums\Auth\OAuthProvider::cases() as $oAuthCase)
                    <div class="flex my-4">
                        <a href="{{ route('web.auth.oauth.redirect', [$oAuthCase]) }}"
                           class="border border-orange-600 text-orange-600 p-3 rounded-lg hover:bg-orange-600/10 hover:text-white transition-all"
                        >
                            <x-dynamic-component :component="$oAuthCase->getIconBlade()" class="w-10 h-10"/>
                        </a>
                    </div>
                @endforeach
            </div>


        </div>
    </div>
@endsection
