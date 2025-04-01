<a {{ $attributes->merge([
    'class' => 'block w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white rounded-lg hover:bg-indigo-100 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition-all duration-200'
]) }}>
    {{ $slot }}
</a>
