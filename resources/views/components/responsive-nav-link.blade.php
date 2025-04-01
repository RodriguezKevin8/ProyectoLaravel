@props(['active'])

@php
$classes = ($active ?? false)
    ? 'block w-full ps-4 pe-5 py-2 border-l-4 border-purple-500 text-start text-base font-semibold text-purple-700 bg-purple-50 hover:bg-purple-100 transition duration-150 ease-in-out'
    : 'block w-full ps-4 pe-5 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
