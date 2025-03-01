@props(['active'])

@php
$classes = ($active ?? false)
            ? 'group inline-flex items-center border-b-2 border-indigo-500 px-1 py-4 text-sm font-medium text-indigo-600 space-x-1'
            : 'group inline-flex items-center border-b-2 border-transparent px-1 py-4 text-sm font-medium text-gray-500 space-x-1 hover:border-gray-300 hover:text-gray-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} aria-current="page">
    {{ $slot }}
</a>
