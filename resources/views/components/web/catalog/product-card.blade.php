<div class="">
    <div class="border rounded-lg bg-white shadow-lg">
        <a href="{{ route('web.products.show', $product->slug) }}"
           class="flex p-2"
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
