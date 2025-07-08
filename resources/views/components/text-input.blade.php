@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => '
        border-brew-amber
        dark:border-brew-brown
        bg-white
        dark:bg-brew-beige
        text-brew-text
        dark:text-brew-text
        focus:border-brew-brown
        focus:ring-brew-amber
        dark:focus:border-brew-brown
        dark:focus:ring-brew-amber
        rounded-md
        shadow-sm
        placeholder:text-gray-400
    '
]) !!}>
