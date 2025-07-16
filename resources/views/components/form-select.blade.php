<select
        {{ $attributes->merge(['class' => "p-4 border rounded-md bg-gray-700 text-white"]) }}
    >
    {{ $slot }}
</select>