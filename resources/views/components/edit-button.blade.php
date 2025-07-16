@props(['active' => false])

<a class="{{ $active ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-green-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium bg-gray-800 ml-3"
    aria-current="{{ $active ? 'page' : 'false' }}"
    {{ $attributes }}
>{{ $slot }}</a>
