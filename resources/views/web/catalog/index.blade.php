@extends('layouts.app')

@section('title', 'Каталог')

@section('content')
    {{ Breadcrumbs::render('catalog') }}

    <div class="grid grid-cols-4 gap-4">
        @foreach($childCategories as $childCategory)
            <div class="border rounded-lg bg-gray-300">
                <a href="{{ route('web.catalog.category', $childCategory->path) }}">
                    <div class="">
                        <h4>{{ $childCategory->name }}</h4>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-4 gap-4">
        @foreach ($products as $product)
            <x-web.catalog.product-card :product="$product"/>
        @endforeach
    </div>
@endsection
