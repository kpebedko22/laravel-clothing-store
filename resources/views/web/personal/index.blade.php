@extends('layouts.app')

@section('title', 'Личный кабинет')

@section('content')
    {{ Breadcrumbs::render('web.personal.index') }}

    <div class="border rounded-lg bg-white dark:bg-dark dark:text-white shadow-lg p-5">
        <h1>{{ 'Личный кабинет' }}</h1>

        <form action="{{ route('web.auth.logout') }}" method="post">
            @csrf
            @method('POST')
            <button type="submit">{{ 'Выйти' }}</button>
        </form>
    </div>
@endsection
