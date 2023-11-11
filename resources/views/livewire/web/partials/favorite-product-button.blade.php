<div>
    <a href=""
       class="relative">

        @if($count)
            <div
                class="absolute -right-3 -top-3 bg-light rounded-full text-xs  w-6 h-6 flex justify-center items-center">
                {{ $count }}
            </div>
        @endif

        <x-heroicon-o-heart class="w-8 h-8 text-gray-500 hover:text-gray-800"/>
    </a>
</div>
