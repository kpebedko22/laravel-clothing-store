@extends('layouts.app')

@section('title', $product->name)

@section('content')
    {{ Breadcrumbs::render('product', $product) }}

    <div class="grid grid-cols-2 gap-4">

        <div class="">
            <img src="{{ $product->getFirstMediaUrl() }}"
                 class="w-full"
                 alt="{{ $product->name }}"
            >
        </div>

        <div class="">
            <h1 class="text-2xl">{{ $product->name }}</h1>

            <div class="text-4xl">{{ $product->human_price . ' ₽' }}</div>

            <div class="">
                <span class="uppercase">{{ 'Цвет:' }}</span>
                <span>{{ $product->color->name }}</span>
            </div>

            <div class="">
                <span class="uppercase">{{ 'Размер:' }}</span>
                <span>{{ $product->size->name }}</span>
            </div>

            <div class="flex gap-3">
                <button class="flex items-center justify-center gap-2 w-full bg-light p-5 uppercase">
                    <x-heroicon-o-shopping-bag class="w-6 h-6"/>
                    {{ 'Добавить в корзину' }}
                </button>

                <livewire:web.catalog.product-card-favorite-toggle :productId="$product->id"
                                                                   :isFavorite="false"
                />
            </div>

            <div class="">
                <span class="uppercase">{{ 'Описание:' }}</span>
                <div>{{ $product->desc }}</div>
            </div>
        </div>

    </div>
@endsection
