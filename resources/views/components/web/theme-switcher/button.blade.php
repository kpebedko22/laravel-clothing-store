@props([
    'icon',
    'theme',
])

@php
    $label = __("web/views/theme-switcher.$theme.label");
@endphp

<button
    aria-label="{{ $label }}"
    type="button"
    x-bind:class="
        theme === @js($theme)
            ? 'bg-gray-50 text-primary-500 dark:bg-white/5 dark:text-primary-400'
            : 'text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400'
    "
    x-on:click="theme = @js($theme)"
    x-tooltip="{
        content: @js($label),
        theme: $store.theme,
    }"
    class="flex justify-center rounded-lg p-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5"
>
    @svg(
        $icon,
        "h-5 w-5",
        array_filter($attributes->getAttributes()),
    )
</button>
