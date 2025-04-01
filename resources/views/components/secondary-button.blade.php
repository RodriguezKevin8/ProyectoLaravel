<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'inline-flex items-center px-5 py-2.5 bg-gradient-to-br from-indigo-500 to-purple-600 text-white font-semibold text-sm rounded-xl shadow-md hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 transition duration-150 ease-in-out'
]) }}>
    {{ $slot }}
</button>
