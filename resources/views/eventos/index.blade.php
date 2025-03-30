<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Eventos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(auth()->user()->isAdmin)
                    <a href="{{route('evento.create')}}" class="p-2 text-sm font-bold transition-colors rounded bg-lime-300 hover:bg-lime-400 text-slate-700">
                        Crear Evento
                    </a>
                    @endif
                    @if(session()->has('message'))
                        <p class="my-4 font-bold text-center text-green-500">
                            {{session('message')}}
                        </p>
                    @endif
                    {{-- listar los eventos --}}
                    <div class="grid grid-cols-1 gap-2 my-4 md:grid-cols-4 sm:grid-cols-2">
                        @forelse ($eventos as $evento)
                            <div class="p-4 bg-white rounded-md shadow-lg">
                                <a href="{{route('evento.show', $evento)}}" class="text-lg font-bold transition-all hover:underline">{{$evento->titulo}}</a>
                                <p>{{$evento->descripcion}}</p>
                                <p>{{$evento->fecha_inicio}}</p>
                                <p>{{$evento->fecha_fin}}</p>
                            </div>
                        @empty
                            <p>No hay eventos para mostrar aun</p>
                        @endforelse

                    </div>
                    {{$eventos->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
