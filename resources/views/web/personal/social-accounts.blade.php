@php
    /**
     * @var Illuminate\Support\Collection<string, App\Models\SocialAccount> $socialAccounts
     */
@endphp

@extends('layouts.app')

@section('title', 'Приложения и учётные записи')

@section('content')
    {{ Breadcrumbs::render('web.personal.social_accounts') }}

    <div class="border rounded-lg bg-white dark:bg-dark dark:text-white shadow-lg p-5">
        <h1 class="text-2xl font-bold">{{ 'Приложения и учётные записи' }}</h1>

        <div class="">
            {{ 'Управляйте разрешениями для приложений и подключёнными учётными записями.' }}
        </div>

        <div class="my-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach(App\Enums\Auth\OAuthProvider::cases() as $case)
                @php
                    $socialAccount = $socialAccounts->get($case->value);
                @endphp
                <div class="flex flex-col items-center justify-between relative p-5 border rounded-lg shadow-md">
                    <div class="p-3 mb-1 flex flex-col items-center">
                        <div class="flex mb-2">
                            <x-dynamic-component :component="$case->getIconBlade()" class="w-10 h-10"/>
                        </div>

                        <div class="text-md font-bold">{{ $case->getLabel() }}</div>

                        @if($socialAccount)
                            <div class="">
                                {{ $socialAccount->name }}
                            </div>
                        @endif
                    </div>

                    @if($socialAccount)
                        <form action="{{ route('web.auth.oauth.disconnect', [$case]) }}" method="POST" class="w-full">
                            @method('POST')
                            @csrf

                            <button type="submit" class="social-btn social-btn--disconnect">
                                {{ 'Удалить' }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('web.auth.oauth.redirect', [$case]) }}"
                           class="social-btn social-btn--connect"
                        >{{ 'Подключиться' }}</a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
