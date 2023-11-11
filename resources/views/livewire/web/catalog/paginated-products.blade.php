@php
/** @var Illuminate\Pagination\LengthAwarePaginator $products */
    @endphp

<div class="" id="paginatedProducts">

    <div class="my-5 grid grid-cols-4 gap-4" wire:loading.remove>
        @foreach ($products as $product)
            <x-web.catalog.product-card :data="$product" :key="$product->getProductId()"/>
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

