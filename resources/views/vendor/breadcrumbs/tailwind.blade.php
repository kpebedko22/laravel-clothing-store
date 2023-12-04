@unless ($breadcrumbs->isEmpty())
    <nav class="container mx-auto">
        <ol class="py-4 rounded flex flex-wrap items-center text-md ">
            @foreach ($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                    <li>
                        <a href="{{ $breadcrumb->url }}"
                           class="text-gray-700 dark:text-white hover:text-gray-900 focus:text-gray-900">
                            {{ $breadcrumb->title }}
                        </a>
                    </li>
                @else
                    <li class="text-gray-700 dark:text-white">
                        {{ $breadcrumb->title }}
                    </li>
                @endif

                @unless($loop->last)
                    <li class="text-gray-700 dark:text-white px-2">
                        <x-heroicon-o-chevron-right class="w-6 h-6 text-gray-700 dark:text-white"/>
                    </li>
                @endif

            @endforeach
        </ol>
    </nav>
@endunless
