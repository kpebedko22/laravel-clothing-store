@extends('layouts.app')

@section('title', $category->name)

@section('content')
    {{ Breadcrumbs::render('category', $category) }}

    <div class="grid grid-cols-4 gap-4">
        @foreach($childCategories as $childCategory)
            <div class="border rounded-lg">
                <a href="{{ route('web.catalog.category', $childCategory->path) }}">
                    <div class="p-3">
                        <img src="{{ $childCategory->getFirstMediaUrl() }}"
                             class="w-full "
                             alt="{{ $childCategory->name }}"
                        >
                        <h4>{{ $childCategory->name }}</h4>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="mt-5 grid grid-cols-4 gap-4">
        @foreach ($products as $product)
            <x-web.catalog.product-card :product="$product"/>
        @endforeach
    </div>
@endsection
