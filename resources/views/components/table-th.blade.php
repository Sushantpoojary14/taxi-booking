@props(['value'])

<th {{ $attributes->merge(['class' => ' px-4 py-3 title-font tracking-wider font-medium bg-zinc-900 text-white ']) }}>
    {{ $value ?? $slot }}
</th>
