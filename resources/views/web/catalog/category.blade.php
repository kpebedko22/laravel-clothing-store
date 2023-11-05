@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <section class="catalog bg-light py-5">
        <div class="container">

            {{ Breadcrumbs::render('category', $category) }}

            <div class="row mb-3">
                <div class="col">
                    <h3>{{ $category->name }}</h3>
                </div>
            </div>
            <div class="row mb-3">
                @foreach($childCategories as $childCategory)
                    <div class="col-3">
                        <a href="{{ route('web.catalog.category', $childCategory->path) }}">
                            <div class="">
                                <h4>{{ $childCategory->name }}</h4>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <x-web.catalog.product-card :item="$product"/>
                @endforeach
            </div>
        </div>
    </section>
@endsection
