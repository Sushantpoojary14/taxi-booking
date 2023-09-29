@props(['value'])

<select {{ $attributes->merge(['class' => 'w-40 bg-white rounded border border-gray-300 text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out']) }}>
    {{ $value ?? $slot }}
</select>
