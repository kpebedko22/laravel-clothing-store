<header class="bg-white border-b">
    <div class="container xl:max-w-screen-xl mx-auto px-5">
        <div class="flex justify-between items-center py-3">
            <div class="flex items-center gap-3">
                <div class="w-32">
                    <a href="{{ route('web.index') }}">
                        <x-web.partials.logo style="width: 100%; height: auto;"/>
                    </a>
                </div>

                <div class="pl-3">
                    <label for="search" class="d-none"></label>
                    <input type="text"
                           id="search"
                           name="search"
                           placeholder="Поиск"
                           class="px-3 py-2 border rounded-lg"
                    >
                </div>
            </div>
            <div class="grid grid-cols-3 divide-x">
                <div class="px-3">
                    <a href="">
                        <x-heroicon-o-user class="w-8 h-8 text-gray-500 hover:text-gray-800"/>
                    </a>
                </div>
                <div class="px-3">
                    <a href="">
                        <x-heroicon-o-heart class="w-8 h-8 text-gray-500 hover:text-gray-800"/>
                    </a>
                </div>
                <div class="px-3">
                    <a href="">
                        <x-heroicon-o-shopping-bag class="w-8 h-8 text-gray-500 hover:text-gray-800"/>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="sticky top-0 bg-light/70 backdrop-blur-sm shadow-md">
    <div class="container xl:max-w-screen-xl mx-auto px-5">
        <ul class="flex justify-start gap-5 py-3">
            @foreach($navigationCategories as $category)
                <li class=" {{ request()->is($category->id) ? '' : '' }}">
                    <a href="{{ route('web.catalog.category', $category->path) }}"
                       class="text-lg font-medium tracking-wide"
                    >
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>