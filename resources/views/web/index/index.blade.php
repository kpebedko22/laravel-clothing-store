@extends('layouts.app')

@section('title', 'Главная')

@section('content')

    <!-- Banner -->
    <div class="banner bg-url('{{ asset('img/header.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-message">
                        <h1>Магазин одежды</h1>
                        <h3>Мужская и женская одежда</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Banner -->

    <div class="py-3">
        <h3>Популярные товары</h3>
        <div class="grid grid-cols-4 gap-4">
            @foreach($popularProducts as $product)
                <x-web.catalog.product-card :data="$product"/>
            @endforeach
        </div>
    </div>

    <div class="py-3">
        <div class="grid grid-cols-3 gap-3">
            <div class="p-3 bg-white border rounded-lg shadow-lg flex flex-col items-center">
                <x-heroicon-o-truck class="w-12 h-12"/>
                <h4 class="font-bold text-lg">Безопасная доставка</h4>
                <p class="text-center">Курьером на дом и бесконтактно в постамат</p>
            </div>

            <div class="p-3 bg-white border rounded-lg shadow-lg flex flex-col items-center">
                <x-heroicon-o-arrow-uturn-left class="w-12 h-12"/>
                <h4 class="font-bold text-lg">Легкий возврат</h4>
                <p class="text-center">Возвращайте товары в течение 30 дней после покупки</p>
            </div>

            <div class="p-3 bg-white border rounded-lg shadow-lg flex flex-col items-center">
                <x-heroicon-o-banknotes class="w-12 h-12"/>
                <h4 class="font-bold text-lg">Удобная оплата</h4>
                <p class="text-center">Наличными или банковской картой</p>
            </div>
        </div>
    </div>
@endsection
