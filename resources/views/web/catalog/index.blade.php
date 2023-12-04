@extends('layouts.app')

@section('title', $category ? $category->name : 'Каталог')

@section('content')
    {{ $category ? Breadcrumbs::render('category', $category) : Breadcrumbs::render('catalog') }}

    <div class="w-full flex gap-4 snap-x overflow-x-auto">
        @foreach($childCategories as $childCategory)
            <div class="scroll-ml-6 snap-start border transition-all dark:border-dark rounded-lg dark:bg-dark/90 dark:hover:bg-white/5 ">
                <a href="{{ route('web.catalog.category', $childCategory->path) }}">
                    <div class="p-3 w-48 ">
                        <img src="{{ $childCategory->getFirstMediaUrl() }}"
                             class="w-full "
                             alt="{{ $childCategory->name }}"
                        >
                        <h4 class="dark:text-white">{{ $childCategory->name }}</h4>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <livewire:web.catalog.paginated-products :categoryId="$category?->id" lazy/>
@endsection
