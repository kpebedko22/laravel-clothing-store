@extends('layouts.app')

@section('title', 'Авторизация')

@section('content')
    {{ Breadcrumbs::render('auth.index') }}

    <div class="border rounded-lg bg-white dark:bg-dark dark:text-white shadow-lg p-5">

        <h1>{{ 'Авторизация' }}</h1>

        <h2>{{ 'Авторизировавшись, вы сможете управлять своими личными данными, следить за состоянием заказов.' }}</h2>

        <livewire:web.auth.login/>
    </div>
@endsection
