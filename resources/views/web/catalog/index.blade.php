@extends('layouts.app')

@section('title', 'Каталог')

@section('content')
    <section class="catalog bg-light py-5">
        <div class="container">

            {{ Breadcrumbs::render('catalog') }}

            <div class="row mb-3">
                <div class="col">
                    <h3>Все товары</h3>
                </div>
            </div>
            <div class="row">
                @foreach ($items as $item)
                    <x-web.catalog.product-card :item="$item"/>
                @endforeach
            </div>
        </div>
    </section>
@endsection
