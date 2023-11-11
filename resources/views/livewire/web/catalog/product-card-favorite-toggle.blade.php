@props(['isFavorite', 'productId'])

@php
    $classes = array_merge([
         'w-8 h-8 transition-all cursor-pointer' => true,
         'fill-rose-600 text-rose-600 hover:fill-transparent' => $isFavorite === true,
         'fill-transparent hover:text-rose-600' => $isFavorite === false,
    ]);
@endphp

<div class="" wire:click="toggle">
    <x-heroicon-o-heart {{ $attributes->class($classes) }}/>
</div>
