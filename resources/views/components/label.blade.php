@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium  dark:text-white text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
