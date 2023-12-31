@props(['data'])

@php
    /** @var App\DTOs\Web\Products\ProductCardDTO $data */
@endphp

<div
    class="border dark:border-dark rounded-lg transition-all shadow-lg min-h-full backdrop-blur-sm bg-white dark:bg-dark">

    <div class="relative">
        <div class="absolute right-0 p-2">
            @php
                $favoriteBtnClasses = array_merge([
                     'w-8 h-8 transition-all cursor-pointer' => true,
                     'fill-rose-600 text-rose-600 hover:fill-transparent' => $data->isFavorite() === true,
                     'text-black dark:text-white fill-transparent hover:text-rose-600 dark:hover:text-rose-600' => $data->isFavorite() === false,
                ]);
            @endphp

            <div class="" wire:click="toggleFavorite">
                <x-heroicon-o-heart {{ $attributes->class($favoriteBtnClasses) }}/>
            </div>
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

    <div class="p-5 lg:p-3 flex flex-col ">
        <div class="">
            <a href="{{ route('web.catalog.category', $data->getCategoryPath()) }}"
               class="text-sm text-gray-400 truncate"
            >{{ $data->getCategoryName() }}</a>
        </div>

        <div class="">
            <a href="{{ route('web.products.show', $data->getProductSlug()) }}"
               class="text-lg text-black dark:text-white"
            >{{ $data->getName() }}</a>
        </div>

        <div class="text-xl text-black dark:text-white font-bold"
        >{{ $data->getPrice() . ' ₽' }}</div>
    </div>
</div>
