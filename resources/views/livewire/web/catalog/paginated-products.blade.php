@php
    /** @var Illuminate\Pagination\LengthAwarePaginator $products */
@endphp

<div class="" id="paginatedProducts">

    <div class="mt-5 p-5 bg-white rounded shadow-lg">
        <select wire:model.change="sort">
            <option value="" disabled>Сортировка</option>

            <option value="popularity">По популярности</option>
            <option value="newest">По новизне</option>
            <option value="price_asc">Цена по возрастанию</option>
            <option value="price_desc">Цена по убыванию</option>
            <option value="discount_asc">Скидка по возрастанию</option>
            <option value="discount_desc">Скидка по убыванию</option>
        </select>
    </div>

    <div class="my-5 grid grid-cols-4 gap-4" wire:loading.remove>
        @php /** @var App\DTOs\Web\Products\ProductCardDTO $product */ @endphp
        @foreach ($products as $product)
            <livewire:web.catalog.product-card :data="$product" :key="$product->getProductId()"/>
        @endforeach
    </div>

    <div class="" wire:loading.remove>
        {{ $products->links(data: ['scrollTo' => '#paginatedProducts']) }}
    </div>

    <div class="my-5 grid grid-cols-4 gap-4" wire:loading.grid>
        @foreach (range(0, 15) as $index)
            <x-web.skeletons.product-card/>
        @endforeach
    </div>
</div>

