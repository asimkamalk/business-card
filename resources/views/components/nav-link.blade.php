@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold leading-5 text-white bg-gradient-to-r from-indigo-600 to-purple-600 shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium leading-5 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 focus:outline-none focus:text-indigo-600 focus:bg-indigo-50 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
