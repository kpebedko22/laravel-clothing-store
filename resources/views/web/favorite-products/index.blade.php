@extends('layouts.app')

@section('title', 'Избранные товары')

@section('content')
    {{ Breadcrumbs::render('web.favorite_products.index') }}

    @foreach($favoriteProducts as $product)
        <div class="">{{ $product->name }}</div>
    @endforeach
{{--    <livewire:web.catalog.paginated-products :categoryId="$category?->id" lazy/>--}}
@endsection
