@php
    /** @var Illuminate\Pagination\LengthAwarePaginator $products */
@endphp

<div class="" id="paginatedProducts">

    <div class="mt-5 p-5 bg-white dark:bg-dark rounded shadow-lg">
        <div class="flex">
            {{--            // TODO: make as component or smth --}}
            <div class="relative"
                 x-data="{ isOpen: false }"
                 x-on:click.outside="isOpen = false"
            >
                <div
                    class="flex items-center cursor-pointer text-dark hover:text-black dark:text-white dark:hover:text-light"
                    x-on:click="isOpen = !isOpen"
                    x-bind:class="isOpen ? 'text-light-hover' : ''"
                >
                    <div class="transition-all">
                        {{ App\Enums\Catalog\CatalogSort::tryFrom($sort)?->getLabel() }}
                    </div>

                    <div class="pl-2">
                        <x-heroicon-o-chevron-down class="w-4 h-4 stroke-2 transition-all"
                                                   x-bind:class="isOpen ? 'rotate-180' : 'rotate-0'"
                        />
                    </div>
                </div>

                <div
                    class="absolute bg-white/70 dark:bg-dark/90 backdrop-blur-sm border dark:border-dark rounded-xl shadow-lg p-5 z-20 w-96"
                    x-cloak
                    x-show.important="isOpen"
                >
                    <div class="">
                        @php
                            $sorts = App\Enums\Catalog\CatalogSort::options();
                        @endphp
                        @foreach($sorts as $key => $label)
                            <div
                                class="text-lg cursor-pointer transition-all text-dark dark:text-white hover:text-light-hover dark:hover:text-light"
                                x-on:click="$wire.set('sort', '{{ $key }}')"
                            >{{ $label }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-5  grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" wire:loading.remove>
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

