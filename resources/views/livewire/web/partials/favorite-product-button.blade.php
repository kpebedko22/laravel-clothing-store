<a href="{{ route('web.favorite_products.index') }}"
   class="relative text-dark dark:text-white hover:text-rose-600 dark:hover:text-rose-600 outline-none focus-visible:text-rose-600 dark:focus-visible:text-rose-600">

    @if($count)
        <div class="absolute -right-3 -top-3 text-dark dark:text-dark bg-light rounded-full text-xs w-6 h-6 flex justify-center items-center">
            {{ $count }}
        </div>
    @endif

    <x-heroicon-o-heart
        class="w-8 h-8 "/>
</a>
