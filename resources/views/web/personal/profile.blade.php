@extends('layouts.app')

@section('title', 'Личные данные')

@section('content')
    {{ Breadcrumbs::render('web.personal.profile') }}

    <div class="border rounded-lg bg-white dark:bg-dark dark:text-white shadow-lg p-5">
        <h1>{{ 'Личные данные' }}</h1>

        <div class="">
            <div class="">ID: {{ auth()->id() }}</div>
        </div>
    </div>
@endsection
