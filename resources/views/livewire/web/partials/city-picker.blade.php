<div class="relative"
     x-data="{ isOpen: false }"
     x-on:click.outside="isOpen = false"
>
    <div class="flex items-center cursor-pointer hover:text-light-hover"
         x-on:click="isOpen = !isOpen"
    >
        <div class="transition-all"
             x-bind:class="isOpen ? 'text-light-hover' : ''"
        >
            {{ $currentCity }}
        </div>

        <div class="pl-2">
            <x-heroicon-o-chevron-down class="w-4 h-4 stroke-2 transition-all"
                                       x-bind:class="isOpen ? 'text-light-hover rotate-180' : 'rotate-0'"
            />
        </div>
    </div>

    <div class="absolute bg-white border shadow-lg p-5 z-20 w-96"
         x-cloak
         x-show.important="isOpen"
    >
        <div class="text-xl">Выбор города</div>
        <div class="py-2">
            <input type="text"
                   class="w-full py-2 outline-0 border-b text-xl"
                   wire:model.live.debounce.300ms="search"
                   placeholder="Введите название города"
            >
        </div>
        <div class="">
            @foreach($regions as $region)
                <div class="text-base font-light text-gray-400 pt-1">{{ $region['name'] . ':' }}</div>

                <div class="grid grid-cols-2">
                    @foreach($region['cities'] as $cityAlias => $cityName)
                        <div class="text-lg cursor-pointer transition-all hover:text-light-hover"
                             wire:click="cityPicked('{{ $cityAlias }}')"
                        >{{ $cityName }}</div>
                    @endforeach
                </div>

            @endforeach
        </div>
    </div>
</div>
