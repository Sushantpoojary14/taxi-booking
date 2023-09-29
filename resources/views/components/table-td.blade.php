@props(["value"])

<th {{ $attributes->merge(['class' =>  'px-4 py-3 ']) }}>
    {{ $value ?? $slot }}
</th>
