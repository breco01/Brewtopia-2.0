@props(['value'])

<label {{ $attributes->merge([
    'class' => 'block font-medium text-sm text-brew-amber dark:text-brew-brown'
]) }}>
    {{ $value ?? $slot }}
</label>
