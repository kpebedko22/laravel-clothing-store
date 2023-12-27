@extends('layouts.app')

@section('title', 'Личный кабинет')

@section('content')
    {{ Breadcrumbs::render('web.personal.index') }}

    <div class="border rounded-lg bg-white dark:bg-dark dark:text-white shadow-lg p-5">
        <h1>{{ 'Личный кабинет' }}</h1>

        <div class="my-5 grid grid-cols-3 gap-5">
            <a href="{{ route('web.personal.profile') }}"
               class="personal-nav-card"
            >
                <span class="personal-nav-card__title">
                    {{ 'Настройки профиля' }}
                </span>
                <x-heroicon-o-cog-6-tooth class="personal-nav-card__icon"/>
            </a>

            <form action="{{ route('web.auth.logout') }}"
                  method="post"
            >
                @csrf
                @method('POST')
                <button type="submit" class="personal-nav-card">
                    <span class="personal-nav-card__title">{{ 'Выйти' }}</span>
                    <x-heroicon-o-arrow-right-start-on-rectangle class="personal-nav-card__icon"/>
                </button>
            </form>
        </div>
    </div>
@endsection
