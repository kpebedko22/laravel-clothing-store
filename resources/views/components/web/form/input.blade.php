{{--                <div class="flex">--}}
{{--                      <span--}}
{{--                          class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">--}}
{{--                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"--}}
{{--                             fill="currentColor" viewBox="0 0 20 20">--}}
{{--                            <path--}}
{{--                                d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>--}}
{{--                        </svg>--}}
{{--                      </span>--}}

{{--                </div>--}}

@props([
    'name',
    'type' => 'text',
    'inlinePrefix' => false,
    'inlineSuffix' => false,
    'prefix' => null,
    'prefixIcon' => null,
    'suffix' => null,
    'suffixIcon' => null,
    'id' => null,
    'placeholder' => null,
])

@php
    $hasPrefix = $prefixIcon || filled($prefix);
    $hasSuffix = $suffixIcon || filled($suffix);

    $labelClasses = 'whitespace-nowrap text-sm text-gray-500 dark:text-gray-400';
@endphp

<div class="flex">
    @if($hasPrefix)
        <div
            @class([
                'items-center gap-x-3 ps-3',
                'flex' => $hasPrefix,
                'hidden' => ! $hasPrefix,
                'pe-1' => $inlinePrefix && filled($prefix),
                'pe-2' => $inlinePrefix && blank($prefix),
                'border-e border-gray-200 pe-3 ps-3 dark:border-white/10' => ! $inlinePrefix,
            ])
        >
            @if(filled($prefix))
                <span class="{{ $labelClasses }}">
                    {{ $prefix }}
                </span>
            @endif
        </div>
    @endif


    <input type="{{ $type }}"
           name="{{ $name }}"
           id="{{ $id ?? $name }}"
           class="rounded-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
           placeholder="{{ $placeholder }}"
           {{ $attributes }}
    >
    @if($hasSuffix)
        @if (filled($suffix))
            <span class="{{ $labelClasses }}">
                {{ $suffix }}
            </span>
        @endif
    @endif
</div>

