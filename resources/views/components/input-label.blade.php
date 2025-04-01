@props(['value'])

<label {{ $attributes->merge(['class' => 'block mb-1 text-sm font-semibold text-gray-700 tracking-wide']) }}>
    {{ $value ?? $slot }}
</label>
