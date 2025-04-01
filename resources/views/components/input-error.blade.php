@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1 mt-1 px-2 py-1 bg-red-50 border border-red-200 rounded-lg']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center gap-2">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                {{ $message }}
            </li>
        @endforeach
    </ul>
@endif
