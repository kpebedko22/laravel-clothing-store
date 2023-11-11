@props(['data'])

@php
    /** @var App\DTOs\Web\Products\ProductCardDTO $data */
@endphp

<div class="">
    <div class="border rounded-lg bg-white shadow-lg">

        <div class="relative">
            <div class="absolute right-0 p-2">
                <livewire:web.catalog.product-card-favorite-toggle :productId="$data->getProductId()"
                                                                   :isFavorite="$data->isFavorite()"
                                                                   :key="$data->getProductId()"
                />
            </div>
        </div>

        <a href="{{ route('web.products.show', $data->getProductSlug()) }}"
           class="flex"
        >
            <img src="{{ $data->getFirstMediaUrl() }}"
                 class="w-full "
                 alt="{{ $data->getName() }}"
            >
        </a>


        <div class="p-3">
            <div class="">
                <a href="{{ route('web.catalog.category', $data->getCategoryPath()) }}"
                   class="text-sm text-gray-400 truncate"
                >{{ $data->getCategoryName() }}</a>
            </div>

            <div class="">
                <a href="{{ route('web.products.show', $data->getProductSlug()) }}"
                   class="text-lg text-black"
                >{{ $data->getName() }}</a>
            </div>

            <div class="text-xl text-black font-bold"
            >{{ $data->getPrice() . '₽' }}</div>
        </div>
    </div>
</div>
