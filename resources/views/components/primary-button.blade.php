<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center px-6 py-2 bg-brew-amber border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-wide hover:bg-brew-brown focus:outline-none focus:ring-2 focus:ring-brew-amber focus:ring-offset-2 transition ease-in-out duration-150'
]) }}>
    {{ $slot }}
</button>
