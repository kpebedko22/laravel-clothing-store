@props(['data'])

@php
    /** @var App\DTOs\Web\Products\ProductCardDTO $data */

    $product = $data->getProduct()
@endphp

<div class="">
    <div class="border rounded-lg bg-white shadow-lg">

        <div class="relative">
            <div class="absolute right-0 p-2">
                <livewire:web.catalog.product-card-favorite-toggle :productId="$product->id"
                                                                   :isFavorite="$data->isFavorite()"
                />
            </div>
        </div>

        <a href="{{ route('web.products.show', $product->slug) }}"
           class="flex"
        >
            <img src="{{ $product->getFirstMediaUrl() }}"
                 class="w-full "
                 alt="{{ $product->name }}"
            >
            {{--            {{ $product->media->first()?->lazy() }}--}}
        </a>


        <div class="p-3">
            <div class="">
                <a href="{{ route('web.catalog.category', $product->category->path) }}"
                   class="text-sm text-gray-400 truncate"
                >{{ $product->category->name }}</a>
            </div>

            <div class="">
                <a href="{{ route('web.products.show', $product->slug) }}"
                   class="text-lg text-black"
                >{{ $product->name }}</a>
            </div>

            <div class="text-xl text-black font-bold"
            >{{ $product->human_price . '₽' }}</div>
        </div>
    </div>
</div>
